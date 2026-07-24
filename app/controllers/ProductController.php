<?php
class ProductController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->requireAuth();
    }

    public function index() {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name, u.name as unit_name, 
                COALESCE(i.quantity, 0) as stock_qty
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                LEFT JOIN brands b ON p.brand_id = b.id 
                LEFT JOIN units u ON p.unit_id = u.id
                LEFT JOIN (SELECT product_id, SUM(quantity) as quantity FROM inventory GROUP BY product_id) i ON p.id = i.product_id";
        $where = [];
        $params = [];
        $search = $_GET['search'] ?? '';
        $catId = $_GET['category_id'] ?? '';
        $brandId = $_GET['brand_id'] ?? '';

        if (!empty($search)) {
            $where[] = "(p.name LIKE ? OR p.sku LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        if (!empty($catId)) {
            $where[] = "p.category_id = ?";
            $params[] = $catId;
        }
        if (!empty($brandId)) {
            $where[] = "p.brand_id = ?";
            $params[] = $brandId;
        }
        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }
        $result = $this->paginate($sql, $params);
        extract($result);
        $categories = $this->db->fetchAll("SELECT * FROM categories WHERE status='active'");
        $brands = $this->db->fetchAll("SELECT * FROM brands WHERE status='active'");
        $this->render('products/index', compact('data', 'pagination', 'search', 'categories', 'brands'));
    }

    public function create() {
        $categories = $this->db->fetchAll("SELECT * FROM categories WHERE status='active'");
        $brands = $this->db->fetchAll("SELECT * FROM brands WHERE status='active'");
        $units = $this->db->fetchAll("SELECT * FROM units");
        $suppliers = $this->db->fetchAll("SELECT * FROM suppliers WHERE status='active'");
        $this->render('products/form', compact('categories', 'brands', 'units', 'suppliers'));
    }

    public function store() {
        $this->validateCSRF();
        $data = $this->getPost();
        $errors = $this->validateRequired($data, ['name', 'sku', 'category_id', 'unit_id', 'purchase_price', 'selling_price']);
        if (!empty($errors)) {
            Session::setFlash('error', implode(', ', $errors));
            Helper::redirect(APP_URL . '/products/create');
        }
        $slug = Helper::slugify($data['name']) . '-' . time();
        $image = 'default.png';
        if (!empty($_FILES['image']['name'])) {
            $upload = $this->uploadImage($_FILES['image']);
            if ($upload['success']) $image = $upload['filename'];
        }
        $this->db->insert(
            "INSERT INTO products (category_id, brand_id, unit_id, supplier_id, sku, barcode, name, slug, image, description, purchase_price, selling_price, tax, discount, minimum_stock, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$data['category_id'], $data['brand_id'] ?: null, $data['unit_id'], $data['supplier_id'] ?: null, $data['sku'], $data['barcode'] ?: Helper::generateBarcode(), $data['name'], $slug, $image, $data['description'] ?? '', $data['purchase_price'], $data['selling_price'], $data['tax'] ?? 0, $data['discount'] ?? 0, $data['minimum_stock'] ?? 10, $data['status'] ?? 'active']
        );
        $this->logActivity('Products', 'Create');
        $this->checkLowStock();
        Session::setFlash('success', 'Product created successfully');
        Helper::redirect(APP_URL . '/products');
    }

    public function edit($id) {
        $product = $this->db->fetch("SELECT * FROM products WHERE id = ?", [$id]);
        if (!$product) { Helper::redirect(APP_URL . '/products'); }
        $categories = $this->db->fetchAll("SELECT * FROM categories WHERE status='active'");
        $brands = $this->db->fetchAll("SELECT * FROM brands WHERE status='active'");
        $units = $this->db->fetchAll("SELECT * FROM units");
        $suppliers = $this->db->fetchAll("SELECT * FROM suppliers WHERE status='active'");
        $this->render('products/form', compact('product', 'categories', 'brands', 'units', 'suppliers'));
    }

    public function update($id) {
        $this->validateCSRF();
        $data = $this->getPost();
        $product = $this->db->fetch("SELECT * FROM products WHERE id = ?", [$id]);
        $image = $product->image;
        if (!empty($_FILES['image']['name'])) {
            $upload = $this->uploadImage($_FILES['image']);
            if ($upload['success']) {
                $this->deleteImage($product->image);
                $image = $upload['filename'];
            }
        }
        $slug = Helper::slugify($data['name']) . '-' . $id;
        $this->db->update(
            "UPDATE products SET category_id=?, brand_id=?, unit_id=?, supplier_id=?, sku=?, barcode=?, name=?, slug=?, image=?, description=?, purchase_price=?, selling_price=?, tax=?, discount=?, minimum_stock=?, status=? WHERE id=?",
            [$data['category_id'], $data['brand_id'] ?: null, $data['unit_id'], $data['supplier_id'] ?: null, $data['sku'], $data['barcode'], $data['name'], $slug, $image, $data['description'] ?? '', $data['purchase_price'], $data['selling_price'], $data['tax'] ?? 0, $data['discount'] ?? 0, $data['minimum_stock'] ?? 10, $data['status'] ?? 'active', $id]
        );
        $this->logActivity('Products', 'Update', $id);
        Session::setFlash('success', 'Product updated successfully');
        Helper::redirect(APP_URL . '/products');
    }

    public function show($id) {
        $product = $this->db->fetch(
            "SELECT p.*, c.name as category_name, b.name as brand_name, u.name as unit_name, s.company_name as supplier_name
             FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id 
             LEFT JOIN brands b ON p.brand_id = b.id 
             LEFT JOIN units u ON p.unit_id = u.id 
             LEFT JOIN suppliers s ON p.supplier_id = s.id 
             WHERE p.id = ?", [$id]
        );
        $inventory = $this->db->fetchAll(
            "SELECT i.*, w.name as warehouse_name FROM inventory i JOIN warehouses w ON i.warehouse_id=w.id WHERE i.product_id=?", [$id]
        );
        $images = $this->db->fetchAll("SELECT * FROM product_images WHERE product_id=?", [$id]);
        $this->render('products/view', compact('product', 'inventory', 'images'));
    }

    public function delete($id) {
        $this->validateCSRF();
        $product = $this->db->fetch("SELECT * FROM products WHERE id=?", [$id]);
        if ($product) {
            $this->deleteImage($product->image);
            $this->db->delete("DELETE FROM products WHERE id=?", [$id]);
            $this->logActivity('Products', 'Delete', $id);
            Session::setFlash('success', 'Product deleted successfully');
        }
        Helper::redirect(APP_URL . '/products');
    }

    public function exportCsv() {
        $products = $this->db->fetchAll(
            "SELECT p.*, c.name as category_name, b.name as brand_name FROM products p 
             LEFT JOIN categories c ON p.category_id=c.id LEFT JOIN brands b ON p.brand_id=b.id"
        );
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=products.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['SKU', 'Name', 'Category', 'Brand', 'Purchase Price', 'Selling Price', 'Stock']);
        foreach ($products as $p) {
            fputcsv($output, [$p->sku, $p->name, $p->category_name, $p->brand_name, $p->purchase_price, $p->selling_price]);
        }
        fclose($output);
        exit;
    }

    public function exportJson() {
        $products = $this->db->fetchAll("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id=c.id");
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=products.json');
        echo json_encode($products, JSON_PRETTY_PRINT);
        exit;
    }
}
