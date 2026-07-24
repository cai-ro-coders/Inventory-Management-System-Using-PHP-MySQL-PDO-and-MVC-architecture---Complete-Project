<?php
class BrandController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() { $s = $_GET['search'] ?? ''; $w = $s !== '' ? "WHERE b.name LIKE ?" : ''; $p = $s !== '' ? ["%$s%"] : []; $data = $this->db->fetchAll("SELECT b.*, (SELECT COUNT(*) FROM products WHERE brand_id=b.id) as product_count FROM brands b $w ORDER BY b.id DESC", $p); $search = $s; $this->render('brands/index', compact('data', 'search')); }
    public function create() { $this->render('brands/form'); }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $logo = 'default.png';
        if (!empty($_FILES['logo']['name'])) { $u = $this->uploadImage($_FILES['logo']); if ($u['success']) $logo = $u['filename']; }
        $this->db->insert("INSERT INTO brands (name, logo, description, status) VALUES (?, ?, ?, ?)", [$data['name'], $logo, $data['description'] ?? '', $data['status'] ?? 'active']);
        $this->logActivity('Brands', 'Create'); Session::setFlash('success', 'Brand created'); Helper::redirect(APP_URL . '/brands');
    }
    public function edit($id) { $brand = $this->db->fetch("SELECT * FROM brands WHERE id=?", [$id]); $this->render('brands/form', compact('brand')); }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost(); $b = $this->db->fetch("SELECT * FROM brands WHERE id=?", [$id]); $logo = $b->logo;
        if (!empty($_FILES['logo']['name'])) { $u = $this->uploadImage($_FILES['logo']); if ($u['success']) { $this->deleteImage($b->logo); $logo = $u['filename']; } }
        $this->db->update("UPDATE brands SET name=?, logo=?, description=?, status=? WHERE id=?", [$data['name'], $logo, $data['description'] ?? '', $data['status'] ?? 'active', $id]);
        $this->logActivity('Brands', 'Update', $id); Session::setFlash('success', 'Brand updated'); Helper::redirect(APP_URL . '/brands');
    }
    public function delete($id) {
        $this->validateCSRF();
        $b = $this->db->fetch("SELECT * FROM brands WHERE id=?", [$id]);
        if ($b) { $this->deleteImage($b->logo); $this->db->delete("DELETE FROM brands WHERE id=?", [$id]); }
        Session::setFlash('success', 'Brand deleted'); Helper::redirect(APP_URL . '/brands');
    }
}

class UnitController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() { $s = $_GET['search'] ?? ''; $w = $s !== '' ? "WHERE u.name LIKE ? OR u.short_name LIKE ?" : ''; $p = $s !== '' ? ["%$s%", "%$s%"] : []; $data = $this->db->fetchAll("SELECT u.*, (SELECT COUNT(*) FROM products WHERE unit_id=u.id) as product_count FROM units u $w ORDER BY u.id DESC", $p); $search = $s; $this->render('units/index', compact('data', 'search')); }
    public function create() { $this->render('units/form'); }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->insert("INSERT INTO units (name, short_name, description) VALUES (?, ?, ?)", [$data['name'], $data['short_name'], $data['description'] ?? '']);
        Session::setFlash('success', 'Unit created'); Helper::redirect(APP_URL . '/units');
    }
    public function edit($id) { $unit = $this->db->fetch("SELECT * FROM units WHERE id=?", [$id]); $this->render('units/form', compact('unit')); }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->update("UPDATE units SET name=?, short_name=?, description=? WHERE id=?", [$data['name'], $data['short_name'], $data['description'] ?? '', $id]);
        Session::setFlash('success', 'Unit updated'); Helper::redirect(APP_URL . '/units');
    }
    public function delete($id) { $this->db->delete("DELETE FROM units WHERE id=?", [$id]); Session::setFlash('success', 'Unit deleted'); Helper::redirect(APP_URL . '/units'); }
}

class SupplierController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() { $s = $_GET['search'] ?? ''; $st = $_GET['status'] ?? ''; $w = []; $p = []; if ($s !== '') { $w[] = "(company_name LIKE ? OR contact_person LIKE ? OR email LIKE ?)"; $p[] = "%$s%"; $p[] = "%$s%"; $p[] = "%$s%"; } if ($st !== '') { $w[] = "status = ?"; $p[] = $st; } $where = !empty($w) ? "WHERE " . implode(" AND ", $w) : ''; $result = $this->paginate("SELECT * FROM suppliers $where", $p); extract($result); $this->render('suppliers/index', compact('data', 'pagination', 'search')); }
    public function create() { $this->render('suppliers/form'); }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->insert("INSERT INTO suppliers (company_name, contact_person, email, phone, address, city, country, tax_number, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$data['company_name'], $data['contact_person'], $data['email'], $data['phone'], $data['address'], $data['city'], $data['country'] ?? 'Philippines', $data['tax_number'], $data['status'] ?? 'active']);
        Session::setFlash('success', 'Supplier created'); Helper::redirect(APP_URL . '/suppliers');
    }
    public function edit($id) { $supplier = $this->db->fetch("SELECT * FROM suppliers WHERE id=?", [$id]); $this->render('suppliers/form', compact('supplier')); }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->update("UPDATE suppliers SET company_name=?, contact_person=?, email=?, phone=?, address=?, city=?, country=?, tax_number=?, status=? WHERE id=?",
            [$data['company_name'], $data['contact_person'], $data['email'], $data['phone'], $data['address'], $data['city'], $data['country'] ?? 'Philippines', $data['tax_number'], $data['status'] ?? 'active', $id]);
        Session::setFlash('success', 'Supplier updated'); Helper::redirect(APP_URL . '/suppliers');
    }
    public function delete($id) { $this->db->delete("DELETE FROM suppliers WHERE id=?", [$id]); Session::setFlash('success', 'Supplier deleted'); Helper::redirect(APP_URL . '/suppliers'); }
    public function show($id) {
        $supplier = $this->db->fetch("SELECT * FROM suppliers WHERE id=?", [$id]);
        $purchases = $this->db->fetchAll("SELECT po.*, (SELECT COUNT(*) FROM purchase_items WHERE purchase_order_id=po.id) as items_count FROM purchase_orders po WHERE po.supplier_id=? ORDER BY po.id DESC LIMIT 10", [$id]);
        $this->render('suppliers/view', compact('supplier', 'purchases'));
    }
}

class CustomerController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() { $s = $_GET['search'] ?? ''; $st = $_GET['status'] ?? ''; $w = []; $p = []; if ($s !== '') { $w[] = "(first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR phone LIKE ?)"; $p[] = "%$s%"; $p[] = "%$s%"; $p[] = "%$s%"; $p[] = "%$s%"; } if ($st !== '') { $w[] = "status = ?"; $p[] = $st; } $where = !empty($w) ? "WHERE " . implode(" AND ", $w) : ''; $result = $this->paginate("SELECT * FROM customers $where", $p); extract($result); $this->render('customers/index', compact('data', 'pagination', 'search')); }
    public function create() { $this->render('customers/form'); }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $code = 'CUST-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $this->db->insert("INSERT INTO customers (customer_code, first_name, last_name, company, email, phone, address, city, country, credit_limit, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$code, $data['first_name'], $data['last_name'], $data['company'], $data['email'], $data['phone'], $data['address'], $data['city'], $data['country'] ?? 'Philippines', $data['credit_limit'] ?? 0, $data['status'] ?? 'active']);
        Session::setFlash('success', 'Customer created'); Helper::redirect(APP_URL . '/customers');
    }
    public function edit($id) { $customer = $this->db->fetch("SELECT * FROM customers WHERE id=?", [$id]); $this->render('customers/form', compact('customer')); }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->update("UPDATE customers SET first_name=?, last_name=?, company=?, email=?, phone=?, address=?, city=?, country=?, credit_limit=?, status=? WHERE id=?",
            [$data['first_name'], $data['last_name'], $data['company'], $data['email'], $data['phone'], $data['address'], $data['city'], $data['country'] ?? 'Philippines', $data['credit_limit'] ?? 0, $data['status'] ?? 'active', $id]);
        Session::setFlash('success', 'Customer updated'); Helper::redirect(APP_URL . '/customers');
    }
    public function delete($id) { $this->db->delete("DELETE FROM customers WHERE id=?", [$id]); Session::setFlash('success', 'Customer deleted'); Helper::redirect(APP_URL . '/customers'); }
    public function show($id) {
        $customer = $this->db->fetch("SELECT * FROM customers WHERE id=?", [$id]);
        $sales = $this->db->fetchAll("SELECT so.*, (SELECT COUNT(*) FROM sales_items WHERE sales_order_id=so.id) as items_count FROM sales_orders so WHERE so.customer_id=? ORDER BY so.id DESC LIMIT 10", [$id]);
        $this->render('customers/view', compact('customer', 'sales'));
    }
}

class WarehouseController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() { $s = $_GET['search'] ?? ''; $w = $s !== '' ? "WHERE w.name LIKE ? OR w.code LIKE ? OR w.city LIKE ?" : ''; $p = $s !== '' ? ["%$s%", "%$s%", "%$s%"] : []; $result = $this->paginate("SELECT w.*, (SELECT COUNT(*) FROM inventory WHERE warehouse_id=w.id) as stock_items FROM warehouses w $w", $p); extract($result); $this->render('warehouses/index', compact('data', 'pagination', 'search')); }
    public function create() { $this->render('warehouses/form'); }
    public function store() {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->insert("INSERT INTO warehouses (name, code, address, city, country, phone, manager, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [$data['name'], $data['code'], $data['address'], $data['city'], $data['country'] ?? 'Philippines', $data['phone'], $data['manager'], $data['status'] ?? 'active']);
        Session::setFlash('success', 'Warehouse created'); Helper::redirect(APP_URL . '/warehouses');
    }
    public function edit($id) { $warehouse = $this->db->fetch("SELECT * FROM warehouses WHERE id=?", [$id]); $this->render('warehouses/form', compact('warehouse')); }
    public function update($id) {
        $this->validateCSRF(); $data = $this->getPost();
        $this->db->update("UPDATE warehouses SET name=?, code=?, address=?, city=?, country=?, phone=?, manager=?, status=? WHERE id=?", [$data['name'], $data['code'], $data['address'], $data['city'], $data['country'] ?? 'Philippines', $data['phone'], $data['manager'], $data['status'] ?? 'active', $id]);
        Session::setFlash('success', 'Warehouse updated'); Helper::redirect(APP_URL . '/warehouses');
    }
    public function delete($id) { $this->db->delete("DELETE FROM warehouses WHERE id=?", [$id]); Session::setFlash('success', 'Warehouse deleted'); Helper::redirect(APP_URL . '/warehouses'); }
}
