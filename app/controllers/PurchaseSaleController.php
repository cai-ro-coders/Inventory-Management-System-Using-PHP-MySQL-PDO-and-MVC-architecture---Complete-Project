<?php
class PurchaseController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $where = []; $params = [];
        $supplier_id = $_GET['supplier_id'] ?? ''; $status = $_GET['status'] ?? ''; $payment_status = $_GET['payment_status'] ?? ''; $search = $_GET['search'] ?? '';
        if ($supplier_id !== '') { $where[] = "po.supplier_id = ?"; $params[] = $supplier_id; }
        if ($status !== '') { $where[] = "po.status = ?"; $params[] = $status; }
        if ($payment_status !== '') { $where[] = "po.payment_status = ?"; $params[] = $payment_status; }
        if ($search !== '') { $where[] = "(po.invoice_no LIKE ? OR s.company_name LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; }
        $sql = "SELECT po.*, s.company_name, w.name as warehouse_name FROM purchase_orders po JOIN suppliers s ON po.supplier_id=s.id JOIN warehouses w ON po.warehouse_id=w.id";
        if (!empty($where)) $sql .= " WHERE " . implode(" AND ", $where);
        $result = $this->paginate($sql, $params);
        extract($result);
        $suppliers = $this->db->fetchAll("SELECT * FROM suppliers WHERE status='active'");
        $this->render('purchases/index', compact('data', 'pagination', 'search', 'suppliers'));
    }
    public function create() {
        $suppliers = $this->db->fetchAll("SELECT * FROM suppliers WHERE status='active'");
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name FROM products p JOIN units u ON p.unit_id=u.id WHERE p.status='active'");
        $this->render('purchases/form', compact('suppliers', 'warehouses', 'products'));
    }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $invNo = Helper::generateInvoiceNo('PO-');
        $items = json_decode($data['items'] ?? '[]', true);
        $subtotal = array_sum(array_column($items, 'total'));
        $tax = round($subtotal * (float)($data['tax_rate'] ?? TAX_RATE) / 100, 2);
        $discount = (float)($data['discount'] ?? 0);
        $shipping = (float)($data['shipping_cost'] ?? 0);
        $total = $subtotal + $tax - $discount + $shipping;
        $paid = (float)($data['paid_amount'] ?? 0);
        $paymentStatus = $paid >= $total ? 'Paid' : ($paid > 0 ? 'Partial' : 'Unpaid');
        $poId = $this->db->insert(
            "INSERT INTO purchase_orders (supplier_id, warehouse_id, user_id, invoice_no, purchase_date, subtotal, tax, discount, shipping_cost, total, paid_amount, due_amount, payment_status, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$data['supplier_id'], $data['warehouse_id'], Session::userId(), $invNo, $data['purchase_date'], $subtotal, $tax, $discount, $shipping, $total, $paid, $total - $paid, $paymentStatus, $data['status'] ?? 'pending', $data['notes'] ?? '']
        );
        foreach ($items as $item) {
            $prodTotal = $item['quantity'] * $item['price'];
            $this->db->insert("INSERT INTO purchase_items (purchase_order_id, product_id, quantity, purchase_price, total) VALUES (?, ?, ?, ?, ?)", [$poId, $item['product_id'], $item['quantity'], $item['price'], $prodTotal]);
            // Update inventory
            $inv = $this->db->fetch("SELECT * FROM inventory WHERE product_id=? AND warehouse_id=?", [$item['product_id'], $data['warehouse_id']]);
            if ($inv) {
                $this->db->update("UPDATE inventory SET quantity=quantity+?, available_quantity=available_quantity+? WHERE product_id=? AND warehouse_id=?", [$item['quantity'], $item['quantity'], $item['product_id'], $data['warehouse_id']]);
            } else {
                $this->db->insert("INSERT INTO inventory (product_id, warehouse_id, quantity, available_quantity) VALUES (?, ?, ?, ?)", [$item['product_id'], $data['warehouse_id'], $item['quantity'], $item['quantity']]);
            }
            $this->db->insert("INSERT INTO stock_movements (product_id, warehouse_id, user_id, reference_type, reference_id, movement_type, quantity, remarks) VALUES (?, ?, ?, 'purchase', ?, 'purchase', ?, ?)", [$item['product_id'], $data['warehouse_id'], Session::userId(), $poId, $item['quantity'], 'Purchase order #' . $invNo]);
        }
        $this->logActivity('Purchases', 'Create', $poId);
        Session::setFlash('success', 'Purchase order created');
        Helper::redirect(APP_URL . '/purchases');
    }
    public function edit($id) {
        $purchase = $this->db->fetch("SELECT * FROM purchase_orders WHERE id=?", [$id]);
        $items = $this->db->fetchAll("SELECT pi.*, p.name, p.image, pi.purchase_price as price FROM purchase_items pi JOIN products p ON pi.product_id=p.id WHERE pi.purchase_order_id=?", [$id]);
        $suppliers = $this->db->fetchAll("SELECT * FROM suppliers WHERE status='active'");
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name FROM products p JOIN units u ON p.unit_id=u.id WHERE p.status='active'");
        $this->render('purchases/form', compact('purchase', 'items', 'suppliers', 'warehouses', 'products'));
    }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $items = json_decode($data['items'] ?? '[]', true);
        $subtotal = array_sum(array_column($items, 'total'));
        $tax = round($subtotal * (float)($data['tax_rate'] ?? TAX_RATE) / 100, 2);
        $discount = (float)($data['discount'] ?? 0);
        $shipping = (float)($data['shipping_cost'] ?? 0);
        $total = $subtotal + $tax - $discount + $shipping;
        $paid = (float)($data['paid_amount'] ?? 0);
        $paymentStatus = $paid >= $total ? 'Paid' : ($paid > 0 ? 'Partial' : 'Unpaid');
        $this->db->update(
            "UPDATE purchase_orders SET supplier_id=?, warehouse_id=?, purchase_date=?, subtotal=?, tax=?, discount=?, shipping_cost=?, total=?, paid_amount=?, due_amount=?, payment_status=?, status=?, notes=? WHERE id=?",
            [$data['supplier_id'], $data['warehouse_id'], $data['purchase_date'], $subtotal, $tax, $discount, $shipping, $total, $paid, $total - $paid, $paymentStatus, $data['status'] ?? 'pending', $data['notes'] ?? '', $id]
        );
        $this->db->delete("DELETE FROM purchase_items WHERE purchase_order_id=?", [$id]);
        foreach ($items as $item) {
            $prodTotal = $item['quantity'] * $item['price'];
            $this->db->insert("INSERT INTO purchase_items (purchase_order_id, product_id, quantity, purchase_price, total) VALUES (?, ?, ?, ?, ?)", [$id, $item['product_id'], $item['quantity'], $item['price'], $prodTotal]);
        }
        $this->logActivity('Purchases', 'Update', $id);
        Session::setFlash('success', 'Purchase updated');
        Helper::redirect(APP_URL . '/purchases');
    }
    public function delete($id) {
        $this->validateCSRF();
        $this->db->delete("DELETE FROM purchase_orders WHERE id=?", [$id]);
        Session::setFlash('success', 'Purchase deleted');
        Helper::redirect(APP_URL . '/purchases');
    }
    public function show($id) {
        $purchase = $this->db->fetch("SELECT po.*, s.company_name, s.contact_person, w.name as warehouse_name, u.first_name, u.last_name FROM purchase_orders po JOIN suppliers s ON po.supplier_id=s.id JOIN warehouses w ON po.warehouse_id=w.id JOIN users u ON po.user_id=u.id WHERE po.id=?", [$id]);
        $items = $this->db->fetchAll("SELECT pi.*, p.name, p.image, u.short_name as unit_name FROM purchase_items pi JOIN products p ON pi.product_id=p.id JOIN units u ON p.unit_id=u.id WHERE pi.purchase_order_id=?", [$id]);
        $this->render('purchases/view', compact('purchase', 'items'));
    }
    public function invoice($id) {
        $purchase = $this->db->fetch("SELECT po.*, s.company_name, s.contact_person, s.address as supplier_address, s.phone as supplier_phone, s.email as supplier_email, w.name as warehouse_name, u.first_name, u.last_name FROM purchase_orders po JOIN suppliers s ON po.supplier_id=s.id JOIN warehouses w ON po.warehouse_id=w.id JOIN users u ON po.user_id=u.id WHERE po.id=?", [$id]);
        $items = $this->db->fetchAll("SELECT pi.*, p.name, p.sku, u.short_name as unit_name FROM purchase_items pi JOIN products p ON pi.product_id=p.id JOIN units u ON p.unit_id=u.id WHERE pi.purchase_order_id=?", [$id]);
        $this->render('purchases/invoice', compact('purchase', 'items'));
    }
}

class SaleController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $where = []; $params = [];
        $customer_id = $_GET['customer_id'] ?? ''; $status = $_GET['status'] ?? ''; $payment_status = $_GET['payment_status'] ?? ''; $search = $_GET['search'] ?? '';
        if ($customer_id !== '') { $where[] = "so.customer_id = ?"; $params[] = $customer_id; }
        if ($status !== '') { $where[] = "so.status = ?"; $params[] = $status; }
        if ($payment_status !== '') { $where[] = "so.payment_status = ?"; $params[] = $payment_status; }
        if ($search !== '') { $where[] = "(so.invoice_no LIKE ? OR c.first_name LIKE ? OR c.last_name LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; $params[] = "%$search%"; }
        $sql = "SELECT so.*, c.first_name, c.last_name, w.name as warehouse_name FROM sales_orders so JOIN customers c ON so.customer_id=c.id JOIN warehouses w ON so.warehouse_id=w.id";
        if (!empty($where)) $sql .= " WHERE " . implode(" AND ", $where);
        $result = $this->paginate($sql, $params);
        extract($result);
        $customers = $this->db->fetchAll("SELECT * FROM customers WHERE status='active'");
        $this->render('sales/index', compact('data', 'pagination', 'search', 'customers'));
    }
    public function create() {
        $customers = $this->db->fetchAll("SELECT * FROM customers WHERE status='active'");
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name, COALESCE(i.quantity, 0) as stock FROM products p JOIN units u ON p.unit_id=u.id LEFT JOIN (SELECT product_id, SUM(quantity) as quantity FROM inventory GROUP BY product_id) i ON p.id=i.product_id WHERE p.status='active'");
        $this->render('sales/form', compact('customers', 'warehouses', 'products'));
    }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $invNo = Helper::generateInvoiceNo('SALE-');
        $items = json_decode($data['items'] ?? '[]', true);
        $subtotal = array_sum(array_column($items, 'total'));
        $tax = round($subtotal * (float)($data['tax_rate'] ?? TAX_RATE) / 100, 2);
        $discount = (float)($data['discount'] ?? 0);
        $shipping = (float)($data['shipping_cost'] ?? 0);
        $total = $subtotal + $tax - $discount + $shipping;
        $paid = (float)($data['paid_amount'] ?? $total);
        $paymentStatus = $paid >= $total ? 'Paid' : ($paid > 0 ? 'Partial' : 'Unpaid');
        $customerId = $data['customer_id'] !== '' ? (int)$data['customer_id'] : 1;
        $soId = $this->db->insert(
            "INSERT INTO sales_orders (customer_id, warehouse_id, user_id, invoice_no, sale_date, subtotal, tax, discount, shipping_cost, total, paid_amount, due_amount, payment_status, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$customerId, $data['warehouse_id'], Session::userId(), $invNo, $data['sale_date'], $subtotal, $tax, $discount, $shipping, $total, $paid, $total - $paid, $paymentStatus, $data['status'] ?? 'completed', $data['notes'] ?? '']
        );
        foreach ($items as $item) {
            $prodTotal = $item['quantity'] * $item['price'];
            $this->db->insert("INSERT INTO sales_items (sales_order_id, product_id, quantity, selling_price, total) VALUES (?, ?, ?, ?, ?)", [$soId, $item['product_id'], $item['quantity'], $item['price'], $prodTotal]);
            $this->db->update("UPDATE inventory SET quantity=quantity-?, available_quantity=available_quantity-? WHERE product_id=? AND warehouse_id=?", [$item['quantity'], $item['quantity'], $item['product_id'], $data['warehouse_id']]);
            $this->db->insert("INSERT INTO stock_movements (product_id, warehouse_id, user_id, reference_type, reference_id, movement_type, quantity, remarks) VALUES (?, ?, ?, 'sale', ?, 'sale', ?, ?)", [$item['product_id'], $data['warehouse_id'], Session::userId(), $soId, -$item['quantity'], 'Sale #' . $invNo]);
        }
        $this->logActivity('Sales', 'Create', $soId);
        Session::setFlash('success', 'Sale created successfully');
        Helper::redirect(APP_URL . '/sales');
    }
    public function edit($id) {
        $sale = $this->db->fetch("SELECT * FROM sales_orders WHERE id=?", [$id]);
        if (!$sale) { Session::setFlash('error', 'Sale not found'); Helper::redirect(APP_URL . '/sales'); }
        $sale->tax_rate = $sale->subtotal > 0 ? round($sale->tax / $sale->subtotal * 100, 2) : TAX_RATE;
        $items = $this->db->fetchAll("SELECT si.*, p.name, p.image, u.short_name as unit_name, si.selling_price as price FROM sales_items si JOIN products p ON si.product_id=p.id JOIN units u ON p.unit_id=u.id WHERE si.sales_order_id=?", [$id]);
        $customers = $this->db->fetchAll("SELECT * FROM customers WHERE status='active'");
        $warehouses = $this->db->fetchAll("SELECT * FROM warehouses WHERE status='active'");
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name, COALESCE(i.quantity, 0) as stock FROM products p JOIN units u ON p.unit_id=u.id LEFT JOIN (SELECT product_id, SUM(quantity) as quantity FROM inventory GROUP BY product_id) i ON p.id=i.product_id WHERE p.status='active'");
        $this->render('sales/form', compact('sale', 'items', 'customers', 'warehouses', 'products'));
    }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $items = json_decode($data['items'] ?? '[]', true);
        $subtotal = array_sum(array_column($items, 'total'));
        $tax = round($subtotal * (float)($data['tax_rate'] ?? TAX_RATE) / 100, 2);
        $discount = (float)($data['discount'] ?? 0);
        $shipping = (float)($data['shipping_cost'] ?? 0);
        $total = $subtotal + $tax - $discount + $shipping;
        $paid = (float)($data['paid_amount'] ?? $total);
        $paymentStatus = $paid >= $total ? 'Paid' : ($paid > 0 ? 'Partial' : 'Unpaid');
        $this->db->update(
            "UPDATE sales_orders SET customer_id=?, warehouse_id=?, sale_date=?, subtotal=?, tax=?, discount=?, shipping_cost=?, total=?, paid_amount=?, due_amount=?, payment_status=?, status=?, notes=? WHERE id=?",
            [$data['customer_id'], $data['warehouse_id'], $data['sale_date'], $subtotal, $tax, $discount, $shipping, $total, $paid, $total - $paid, $paymentStatus, $data['status'] ?? 'completed', $data['notes'] ?? '', $id]
        );
        $this->db->delete("DELETE FROM sales_items WHERE sales_order_id=?", [$id]);
        foreach ($items as $item) {
            $prodTotal = $item['quantity'] * $item['price'];
            $this->db->insert("INSERT INTO sales_items (sales_order_id, product_id, quantity, selling_price, total) VALUES (?, ?, ?, ?, ?)", [$id, $item['product_id'], $item['quantity'], $item['price'], $prodTotal]);
        }
        $this->logActivity('Sales', 'Update', $id);
        Session::setFlash('success', 'Sale updated');
        Helper::redirect(APP_URL . '/sales');
    }
    public function show($id) {
        $sale = $this->db->fetch("SELECT so.*, c.first_name, c.last_name, c.company, c.phone as customer_phone, c.email as customer_email, c.address as customer_address, w.name as warehouse_name, u.first_name as user_first, u.last_name as user_last FROM sales_orders so JOIN customers c ON so.customer_id=c.id JOIN warehouses w ON so.warehouse_id=w.id JOIN users u ON so.user_id=u.id WHERE so.id=?", [$id]);
        $items = $this->db->fetchAll("SELECT si.*, p.name, p.image, u.short_name as unit_name FROM sales_items si JOIN products p ON si.product_id=p.id JOIN units u ON p.unit_id=u.id WHERE si.sales_order_id=?", [$id]);
        $this->render('sales/view', compact('sale', 'items'));
    }
    public function delete($id) {
        $this->validateCSRF();
        $this->db->delete("DELETE FROM sales_orders WHERE id=?", [$id]);
        Session::setFlash('success', 'Sale deleted'); Helper::redirect(APP_URL . '/sales');
    }
    public function invoice($id) {
        $sale = $this->db->fetch("SELECT so.*, c.first_name, c.last_name, c.company, c.phone as customer_phone, c.email as customer_email, c.address as customer_address, w.name as warehouse_name, u.first_name as user_first, u.last_name as user_last FROM sales_orders so JOIN customers c ON so.customer_id=c.id JOIN warehouses w ON so.warehouse_id=w.id JOIN users u ON so.user_id=u.id WHERE so.id=?", [$id]);
        $items = $this->db->fetchAll("SELECT si.*, p.name, p.sku, u.short_name as unit_name FROM sales_items si JOIN products p ON si.product_id=p.id JOIN units u ON p.unit_id=u.id WHERE si.sales_order_id=?", [$id]);
        $this->render('sales/invoice', compact('sale', 'items'));
    }
    public function pos() {
        $categories = $this->db->fetchAll("SELECT * FROM categories WHERE status='active'");
        $products = $this->db->fetchAll("SELECT p.*, u.short_name as unit_name, COALESCE(i.quantity, 0) as stock FROM products p JOIN units u ON p.unit_id=u.id LEFT JOIN (SELECT product_id, SUM(quantity) as quantity FROM inventory GROUP BY product_id) i ON p.id=i.product_id WHERE p.status='active'");
        $customers = $this->db->fetchAll("SELECT * FROM customers WHERE status='active'");
        $this->render('sales/pos', compact('categories', 'products', 'customers'));
    }
}
