<?php
class InventoryController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    
    public function index() {
        $where = []; $having = []; $params = [];
        $search = $_GET['search'] ?? ''; $warehouse_id = $_GET['warehouse_id'] ?? ''; $status = $_GET['status'] ?? '';
        if ($search !== '') { $where[] = "(p.name LIKE ? OR p.sku LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; }
        if ($warehouse_id !== '') { $where[] = "i.warehouse_id = ?"; $params[] = $warehouse_id; }
        $totalQtyExpr = "COALESCE(SUM(i.quantity), 0)";
        if ($status === 'out') { $having[] = "$totalQtyExpr <= 0"; }
        if ($status === 'low') { $having[] = "$totalQtyExpr > 0 AND $totalQtyExpr <= p.minimum_stock"; }
        if ($status === 'available') { $having[] = "$totalQtyExpr > p.minimum_stock"; }
        $sql = "SELECT p.id as product_id, p.name as product_name, p.sku, p.image, p.minimum_stock, p.selling_price, 
                COALESCE(SUM(i.quantity), 0) as total_qty, COALESCE(SUM(i.available_quantity), 0) as available_qty,
                GROUP_CONCAT(DISTINCT w.name SEPARATOR ', ') as warehouses
                FROM products p 
                LEFT JOIN inventory i ON p.id = i.product_id 
                LEFT JOIN warehouses w ON i.warehouse_id = w.id";
        if (!empty($where)) $sql .= " WHERE " . implode(" AND ", $where);
        $sql .= " GROUP BY p.id";
        if (!empty($having)) $sql .= " HAVING " . implode(" AND ", $having);
        $result = $this->paginate($sql, $params);
        extract($result);
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $this->render('inventory/index', compact('data', 'pagination', 'search', 'warehouses'));
    }

    public function stockIn() {
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name FROM products p JOIN units u ON p.unit_id=u.id WHERE p.status='active'");
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $this->render('inventory/stock-in', compact('products', 'warehouses'));
    }

    public function stockInStore() {
        $this->validateCSRF(); $data = $this->getPost();
        $inv = $this->db->fetch("SELECT * FROM inventory WHERE product_id=? AND warehouse_id=?", [$data['product_id'], $data['warehouse_id']]);
        if ($inv) {
            $this->db->update("UPDATE inventory SET quantity=quantity+?, available_quantity=available_quantity+? WHERE product_id=? AND warehouse_id=?", [$data['quantity'], $data['quantity'], $data['product_id'], $data['warehouse_id']]);
        } else {
            $this->db->insert("INSERT INTO inventory (product_id, warehouse_id, quantity, available_quantity) VALUES (?, ?, ?, ?)", [$data['product_id'], $data['warehouse_id'], $data['quantity'], $data['quantity']]);
        }
        $this->db->insert("INSERT INTO stock_movements (product_id, warehouse_id, user_id, reference_type, movement_type, quantity, remarks) VALUES (?, ?, ?, 'adjustment', 'purchase', ?, ?)", [$data['product_id'], $data['warehouse_id'], Session::userId(), $data['quantity'], $data['remarks'] ?? 'Stock In']);
        $this->logActivity('Inventory', 'Stock In'); Session::setFlash('success', 'Stock added'); Helper::redirect(APP_URL . '/inventory');
    }

    public function stockOut() {
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name FROM products p JOIN units u ON p.unit_id=u.id WHERE p.status='active'");
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $this->render('inventory/stock-out', compact('products', 'warehouses'));
    }

    public function stockOutStore() {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->update("UPDATE inventory SET quantity=quantity-?, available_quantity=available_quantity-? WHERE product_id=? AND warehouse_id=?", [$data['quantity'], $data['quantity'], $data['product_id'], $data['warehouse_id']]);
        $this->db->insert("INSERT INTO stock_movements (product_id, warehouse_id, user_id, reference_type, movement_type, quantity, remarks) VALUES (?, ?, ?, 'adjustment', 'sale', ?, ?)", [$data['product_id'], $data['warehouse_id'], Session::userId(), -$data['quantity'], $data['remarks'] ?? 'Stock Out']);
        $this->logActivity('Inventory', 'Stock Out'); Session::setFlash('success', 'Stock removed'); Helper::redirect(APP_URL . '/inventory');
    }

    public function adjustment() {
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name, COALESCE(i.quantity, 0) as current_stock FROM products p JOIN units u ON p.unit_id=u.id LEFT JOIN (SELECT product_id, SUM(quantity) as quantity FROM inventory GROUP BY product_id) i ON p.id=i.product_id WHERE p.status='active'");
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $inventory = $this->db->fetchAll("SELECT product_id, warehouse_id, quantity FROM inventory");
        $stockMap = [];
        foreach ($inventory as $inv) {
            $stockMap[$inv->product_id][$inv->warehouse_id] = (int)$inv->quantity;
        }
        $this->render('inventory/adjustment', compact('products', 'warehouses', 'stockMap'));
    }

    public function adjustmentStore() {
        $this->validateCSRF(); $data = $this->getPost();
        $adjId = $this->db->insert("INSERT INTO stock_adjustments (warehouse_id, user_id, adjustment_date, reason, remarks) VALUES (?, ?, CURDATE(), ?, ?)", [$data['warehouse_id'], Session::userId(), $data['reason'] ?? '', $data['remarks'] ?? '']);
        $items = $data['items'] ?? [];
        foreach ($items as $item) {
            $inv = $this->db->fetch("SELECT * FROM inventory WHERE product_id=? AND warehouse_id=?", [$item['product_id'], $data['warehouse_id']]);
            $oldQty = $inv ? $inv->quantity : 0;
            $diff = $item['new_qty'] - $oldQty;
            $this->db->insert("INSERT INTO stock_adjustment_items (stock_adjustment_id, product_id, old_quantity, new_quantity, difference) VALUES (?, ?, ?, ?, ?)", [$adjId, $item['product_id'], $oldQty, $item['new_qty'], $diff]);
            if ($inv) {
                $this->db->update("UPDATE inventory SET quantity=?, available_quantity=? WHERE product_id=? AND warehouse_id=?", [$item['new_qty'], $item['new_qty'], $item['product_id'], $data['warehouse_id']]);
            } else {
                $this->db->insert("INSERT INTO inventory (product_id, warehouse_id, quantity, available_quantity) VALUES (?, ?, ?, ?)", [$item['product_id'], $data['warehouse_id'], $item['new_qty'], $item['new_qty']]);
            }
            $this->db->insert("INSERT INTO stock_movements (product_id, warehouse_id, user_id, reference_type, reference_id, movement_type, quantity, remarks) VALUES (?, ?, ?, 'adjustment', ?, 'adjustment', ?, ?)", [$item['product_id'], $data['warehouse_id'], Session::userId(), $adjId, $diff, 'Stock adjustment']);
        }
        $this->logActivity('Inventory', 'Adjustment', $adjId);
        Session::setFlash('success', 'Stock adjustment completed'); Helper::redirect(APP_URL . '/inventory');
    }

    public function transfers() {
        $where = []; $params = [];
        $search = $_GET['search'] ?? ''; $status = $_GET['status'] ?? '';
        if ($search !== '') { $where[] = "(t.transfer_no LIKE ? OR fw.name LIKE ? OR tw.name LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; $params[] = "%$search%"; }
        if ($status !== '') { $where[] = "t.status = ?"; $params[] = $status; }
        $sql = "SELECT t.*, fw.name as from_warehouse, tw.name as to_warehouse, (SELECT COUNT(*) FROM transfer_items WHERE transfer_id=t.id) as total_items FROM transfers t JOIN warehouses fw ON t.from_warehouse_id=fw.id JOIN warehouses tw ON t.to_warehouse_id=tw.id";
        if (!empty($where)) $sql .= " WHERE " . implode(" AND ", $where);
        $result = $this->paginate($sql, $params);
        extract($result);
        $this->render('inventory/transfers', compact('data', 'pagination', 'search'));
    }

    public function transferView($id) {
        $transfer = $this->db->fetch("SELECT t.*, fw.name as from_warehouse, tw.name as to_warehouse FROM transfers t JOIN warehouses fw ON t.from_warehouse_id=fw.id JOIN warehouses tw ON t.to_warehouse_id=tw.id WHERE t.id=?", [$id]);
        if (!$transfer) { http_response_code(404); require APP_ROOT . '/app/views/errors/404.php'; return; }
        $items = $this->db->fetchAll("SELECT ti.*, p.name as product_name, p.sku, u.short_name as unit_name FROM transfer_items ti JOIN products p ON ti.product_id=p.id JOIN units u ON p.unit_id=u.id WHERE ti.transfer_id=?", [$id]);
        $this->render('inventory/transfer-view', compact('transfer', 'items'));
    }

    public function transferEdit($id) {
        $transfer = $this->db->fetch("SELECT * FROM transfers WHERE id=?", [$id]);
        if (!$transfer) { http_response_code(404); require APP_ROOT . '/app/views/errors/404.php'; return; }
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name FROM products p JOIN units u ON p.unit_id=u.id WHERE p.status='active'");
        $items = $this->db->fetchAll("SELECT ti.*, p.name as product_name FROM transfer_items ti JOIN products p ON ti.product_id=p.id WHERE ti.transfer_id=?", [$id]);
        $inventory = $this->db->fetchAll("SELECT product_id, warehouse_id, quantity FROM inventory");
        $stockMap = [];
        foreach ($inventory as $inv) {
            $stockMap[$inv->product_id][$inv->warehouse_id] = (int)$inv->quantity;
        }
        $this->render('inventory/transfer-form', compact('transfer', 'warehouses', 'products', 'items', 'stockMap'));
    }

    public function transferUpdate($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->update("UPDATE transfers SET from_warehouse_id=?, to_warehouse_id=?, transfer_date=?, notes=? WHERE id=?", [$data['from_warehouse_id'], $data['to_warehouse_id'], $data['transfer_date'], $data['notes'] ?? '', $id]);
        $this->db->delete("DELETE FROM transfer_items WHERE transfer_id=?", [$id]);
        $items = json_decode($data['items'] ?? '[]', true);
        foreach ($items as $item) {
            $this->db->insert("INSERT INTO transfer_items (transfer_id, product_id, quantity) VALUES (?, ?, ?)", [$id, $item['product_id'], $item['quantity']]);
        }
        $this->logActivity('Inventory', 'Transfer Updated', $id);
        Session::setFlash('success', 'Transfer updated');
        Helper::redirect(APP_URL . '/inventory/transfers');
    }

    public function transferDelete($id) {
        $this->validateCSRF();
        $this->db->delete("DELETE FROM transfers WHERE id=?", [$id]);
        $this->logActivity('Inventory', 'Transfer Deleted', $id);
        Session::setFlash('success', 'Transfer deleted');
        Helper::redirect(APP_URL . '/inventory/transfers');
    }

    public function transferCreate() {
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name FROM products p JOIN units u ON p.unit_id=u.id WHERE p.status='active'");
        $inventory = $this->db->fetchAll("SELECT product_id, warehouse_id, quantity FROM inventory");
        $stockMap = [];
        foreach ($inventory as $inv) {
            $stockMap[$inv->product_id][$inv->warehouse_id] = (int)$inv->quantity;
        }
        $this->render('inventory/transfer-form', compact('warehouses', 'products', 'stockMap'));
    }

    public function transferStore() {
        $this->validateCSRF(); $data = $this->getPost();
        $transferNo = 'TRF-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        $items = json_decode($data['items'] ?? '[]', true);
        $trfId = $this->db->insert("INSERT INTO transfers (from_warehouse_id, to_warehouse_id, transfer_no, transfer_date, status, notes) VALUES (?, ?, ?, ?, ?, ?)", [$data['from_warehouse_id'], $data['to_warehouse_id'], $transferNo, $data['transfer_date'], 'completed', $data['notes'] ?? '']);
        foreach ($items as $item) {
            $this->db->insert("INSERT INTO transfer_items (transfer_id, product_id, quantity) VALUES (?, ?, ?)", [$trfId, $item['product_id'], $item['quantity']]);
            $this->db->update("UPDATE inventory SET quantity=quantity-?, available_quantity=available_quantity-? WHERE product_id=? AND warehouse_id=?", [$item['quantity'], $item['quantity'], $item['product_id'], $data['from_warehouse_id']]);
            $inv = $this->db->fetch("SELECT * FROM inventory WHERE product_id=? AND warehouse_id=?", [$item['product_id'], $data['to_warehouse_id']]);
            if ($inv) {
                $this->db->update("UPDATE inventory SET quantity=quantity+?, available_quantity=available_quantity+? WHERE product_id=? AND warehouse_id=?", [$item['quantity'], $item['quantity'], $item['product_id'], $data['to_warehouse_id']]);
            } else {
                $this->db->insert("INSERT INTO inventory (product_id, warehouse_id, quantity, available_quantity) VALUES (?, ?, ?, ?)", [$item['product_id'], $data['to_warehouse_id'], $item['quantity'], $item['quantity']]);
            }
            $this->db->insert("INSERT INTO stock_movements (product_id, warehouse_id, user_id, reference_type, reference_id, movement_type, quantity, remarks) VALUES (?, ?, ?, 'transfer', ?, 'transfer_out', ?, ?)", [$item['product_id'], $data['from_warehouse_id'], Session::userId(), $trfId, -$item['quantity'], 'Transfer to #' . $transferNo]);
            $this->db->insert("INSERT INTO stock_movements (product_id, warehouse_id, user_id, reference_type, reference_id, movement_type, quantity, remarks) VALUES (?, ?, ?, 'transfer', ?, 'transfer_in', ?, ?)", [$item['product_id'], $data['to_warehouse_id'], Session::userId(), $trfId, $item['quantity'], 'Transfer from #' . $transferNo]);
        }
        $this->logActivity('Inventory', 'Transfer', $trfId);
        Session::setFlash('success', 'Stock transfer completed'); Helper::redirect(APP_URL . '/inventory/transfers');
    }
}

class ExpenseController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $w = []; $p = [];
        $s = $_GET['search'] ?? '';
        if ($s !== '') { $w[] = "(e.title LIKE ? OR ec.name LIKE ?)"; $p[] = "%$s%"; $p[] = "%$s%"; }
        $cat = $_GET['category_id'] ?? '';
        if ($cat !== '') { $w[] = "e.expense_category_id = ?"; $p[] = $cat; }
        $from = $_GET['from'] ?? '';
        if ($from !== '') { $w[] = "e.expense_date >= ?"; $p[] = $from; }
        $to = $_GET['to'] ?? '';
        if ($to !== '') { $w[] = "e.expense_date <= ?"; $p[] = $to; }
        $where = $w ? 'WHERE ' . implode(' AND ', $w) : '';
        $result = $this->paginate("SELECT e.*, ec.name as category_name FROM expenses e JOIN expense_categories ec ON e.expense_category_id=ec.id $where", $p);
        $categories = $this->db->fetchAll("SELECT * FROM expense_categories");
        extract($result); $this->render('expenses/index', compact('data', 'pagination', 'search', 'categories'));
    }
    public function create() {
        $categories = $this->db->fetchAll("SELECT * FROM expense_categories");
        $this->render('expenses/form', compact('categories'));
    }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->insert("INSERT INTO expenses (expense_category_id, user_id, title, amount, expense_date, notes) VALUES (?, ?, ?, ?, ?, ?)", [$data['expense_category_id'], Session::userId(), $data['title'], $data['amount'], $data['expense_date'], $data['notes'] ?? '']);
        $this->logActivity('Expenses', 'Create'); Session::setFlash('success', 'Expense added'); Helper::redirect(APP_URL . '/expenses');
    }
    public function edit($id) { $expense = $this->db->fetch("SELECT * FROM expenses WHERE id=?", [$id]); $categories = $this->db->fetchAll("SELECT * FROM expense_categories"); $this->render('expenses/form', compact('expense', 'categories')); }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->update("UPDATE expenses SET expense_category_id=?, title=?, amount=?, expense_date=?, notes=? WHERE id=?", [$data['expense_category_id'], $data['title'], $data['amount'], $data['expense_date'], $data['notes'] ?? '', $id]);
        Session::setFlash('success', 'Expense updated'); Helper::redirect(APP_URL . '/expenses');
    }
    public function delete($id) { $this->db->delete("DELETE FROM expenses WHERE id=?", [$id]); Session::setFlash('success', 'Expense deleted'); Helper::redirect(APP_URL . '/expenses'); }
    public function categories() {
        $s = $_GET['search'] ?? ''; $w = $s !== '' ? "WHERE ec.name LIKE ?" : ''; $p = $s !== '' ? ["%$s%"] : [];
        $result = $this->paginate("SELECT ec.*, (SELECT COUNT(*) FROM expenses WHERE expense_category_id=ec.id) as expense_count FROM expense_categories ec $w", $p);
        extract($result); $this->render('expenses/categories', compact('data', 'pagination', 'search'));
    }
    public function categoriesStore() {
        $this->validateCSRF(); $data = $this->getPost();
        $id = $data['id'] ?? '';
        if ($id) {
            $this->db->update("UPDATE expense_categories SET name=?, description=? WHERE id=?", [$data['name'], $data['description'] ?? '', $id]);
        } else {
            $this->db->insert("INSERT INTO expense_categories (name, description) VALUES (?, ?)", [$data['name'], $data['description'] ?? '']);
        }
        Session::setFlash('success', 'Category saved'); Helper::redirect(APP_URL . '/expenses/categories');
    }
    public function categoriesDelete($id) {
        $this->validateCSRF();
        $this->db->delete("DELETE FROM expense_categories WHERE id=?", [$id]);
        Session::setFlash('success', 'Category deleted'); Helper::redirect(APP_URL . '/expenses/categories');
    }
}

class ReportController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() { $this->render('reports/index'); }
    public function sales() {
        $daily = $this->db->fetchAll("SELECT DATE(sale_date) as date, COUNT(*) as count, SUM(total) as total FROM sales_orders WHERE status='completed' GROUP BY DATE(sale_date) ORDER BY date DESC LIMIT 30");
        $monthly = $this->db->fetchAll("SELECT DATE_FORMAT(sale_date, '%Y-%m') as month, COUNT(*) as count, SUM(total) as total FROM sales_orders WHERE status='completed' GROUP BY DATE_FORMAT(sale_date, '%Y-%m') ORDER BY month DESC LIMIT 12");
        $yearly = $this->db->fetchAll("SELECT YEAR(sale_date) as year, COUNT(*) as count, SUM(total) as total FROM sales_orders WHERE status='completed' GROUP BY YEAR(sale_date) ORDER BY year DESC");
        $this->render('reports/sales', compact('daily', 'monthly', 'yearly'));
    }
    public function purchases() {
        $daily = $this->db->fetchAll("SELECT DATE(purchase_date) as date, COUNT(*) as count, SUM(total) as total FROM purchase_orders WHERE status IN ('completed','approved') GROUP BY DATE(purchase_date) ORDER BY date DESC LIMIT 30");
        $monthly = $this->db->fetchAll("SELECT DATE_FORMAT(purchase_date, '%Y-%m') as month, COUNT(*) as count, SUM(total) as total FROM purchase_orders WHERE status IN ('completed','approved') GROUP BY DATE_FORMAT(purchase_date, '%Y-%m') ORDER BY month DESC LIMIT 12");
        $this->render('reports/purchases', compact('daily', 'monthly'));
    }
    public function inventory() {
        $products = $this->db->fetchAll("SELECT p.*, COALESCE(SUM(i.quantity),0) as stock, COALESCE(SUM(i.quantity * p.purchase_price),0) as stock_value FROM products p LEFT JOIN inventory i ON p.id=i.product_id GROUP BY p.id");
        $movements = $this->db->fetchAll("SELECT sm.*, p.name as product_name, w.name as warehouse_name FROM stock_movements sm JOIN products p ON sm.product_id=p.id JOIN warehouses w ON sm.warehouse_id=w.id ORDER BY sm.id DESC LIMIT 50");
        $totalProducts = count($products);
        $totalStock = array_sum(array_column($products, 'stock'));
        $lowStock = count(array_filter($products, fn($p) => $p->stock > 0 && $p->stock <= $p->minimum_stock));
        $outOfStock = count(array_filter($products, fn($p) => $p->stock <= 0));
        $this->render('reports/inventory', compact('products', 'movements', 'totalProducts', 'totalStock', 'lowStock', 'outOfStock'));
    }
    public function financial() {
        $year = $_GET['year'] ?? date('Y');
        $revenue = $this->db->fetch("SELECT COALESCE(SUM(total),0) as total FROM sales_orders WHERE status='completed' AND MONTH(sale_date)=MONTH(CURDATE()) AND YEAR(sale_date)=YEAR(CURDATE())");
        $expenses = $this->db->fetch("SELECT COALESCE(SUM(amount),0) as total FROM expenses WHERE MONTH(expense_date)=MONTH(CURDATE()) AND YEAR(expense_date)=YEAR(CURDATE())");
        $purchases = $this->db->fetch("SELECT COALESCE(SUM(total),0) as total FROM purchase_orders WHERE status IN ('completed','approved') AND MONTH(purchase_date)=MONTH(CURDATE()) AND YEAR(purchase_date)=YEAR(CURDATE())");
        $monthlyRev = $this->db->fetchAll("SELECT DATE_FORMAT(sale_date, '%Y-%m') as month, SUM(total) as total FROM sales_orders WHERE status='completed' GROUP BY DATE_FORMAT(sale_date, '%Y-%m') ORDER BY month DESC LIMIT 6");
        $monthlyExp = $this->db->fetchAll("SELECT DATE_FORMAT(expense_date, '%Y-%m') as month, SUM(amount) as total FROM expenses GROUP BY DATE_FORMAT(expense_date, '%Y-%m') ORDER BY month DESC LIMIT 6");

        $totalRevenue = (float)($revenue->total ?? 0);
        $totalExpenses = (float)($expenses->total ?? 0);
        $netProfit = $totalRevenue - $totalExpenses;
        $profitMargin = $totalRevenue > 0 ? round(($netProfit / $totalRevenue) * 100, 1) : 0;
        $selectedYear = $year;

        $monthlyMap = [];
        foreach ($monthlyRev as $r) { $monthlyMap[$r->month] = (object)['month' => $r->month, 'revenue' => (float)$r->total, 'expenses' => 0]; }
        foreach ($monthlyExp as $e) {
            if (isset($monthlyMap[$e->month])) { $monthlyMap[$e->month]->expenses = (float)$e->total; }
            else { $monthlyMap[$e->month] = (object)['month' => $e->month, 'revenue' => 0, 'expenses' => (float)$e->total]; }
        }
        $monthlySummary = array_values($monthlyMap);
        usort($monthlySummary, fn($a, $b) => strcmp($a->month, $b->month));

        $expenseBreakdown = $this->db->fetchAll("SELECT ec.name, COALESCE(SUM(e.amount),0) as total FROM expense_categories ec LEFT JOIN expenses e ON ec.id=e.expense_category_id AND MONTH(e.expense_date)=MONTH(CURDATE()) AND YEAR(e.expense_date)=YEAR(CURDATE()) GROUP BY ec.id, ec.name");

        $this->render('reports/financial', compact('totalRevenue', 'totalExpenses', 'netProfit', 'profitMargin', 'monthlySummary', 'selectedYear', 'expenseBreakdown'));
    }
    public function customers() {
        $data = $this->db->fetchAll("SELECT c.*, COALESCE(SUM(so.total),0) as total_sales, COUNT(so.id) as sale_count FROM customers c LEFT JOIN sales_orders so ON c.id=so.customer_id AND so.status='completed' GROUP BY c.id ORDER BY total_sales DESC");
        $this->render('reports/customers', compact('data'));
    }
    public function suppliers() {
        $data = $this->db->fetchAll("SELECT s.*, COALESCE(SUM(po.total),0) as total_purchases, COUNT(po.id) as purchase_count FROM suppliers s LEFT JOIN purchase_orders po ON s.id=po.supplier_id AND po.status IN ('completed','approved') GROUP BY s.id ORDER BY total_purchases DESC");
        $this->render('reports/suppliers', compact('data'));
    }
}
