<?php
class CategoryController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $s = $_GET['search'] ?? ''; $w = $s !== '' ? "WHERE c.name LIKE ?" : ''; $p = $s !== '' ? ["%$s%"] : [];
        $result = $this->paginate("SELECT c.*, (SELECT COUNT(*) FROM products WHERE category_id=c.id) as product_count FROM categories c $w", $p);
        extract($result);
        $this->render('categories/index', compact('data', 'pagination', 'search'));
    }
    public function create() {
        $categories = $this->db->fetchAll("SELECT * FROM categories WHERE status='active'");
        $this->render('categories/form', compact('categories'));
    }
    public function store() {
        $this->validateCSRF();
        $data = $this->getPost();
        $slug = Helper::slugify($data['name']);
        $image = 'default.png';
        if (!empty($_FILES['image']['name'])) { $u = $this->uploadImage($_FILES['image']); if ($u['success']) $image = $u['filename']; }
        $this->db->insert("INSERT INTO categories (parent_id, name, slug, image, description, status) VALUES (?, ?, ?, ?, ?, ?)",
            [$data['parent_id'] ?: null, $data['name'], $slug, $image, $data['description'] ?? '', $data['status'] ?? 'active']);
        $this->logActivity('Categories', 'Create');
        Session::setFlash('success', 'Category created successfully');
        Helper::redirect(APP_URL . '/categories');
    }
    public function edit($id) {
        $category = $this->db->fetch("SELECT * FROM categories WHERE id=?", [$id]);
        $categories = $this->db->fetchAll("SELECT * FROM categories WHERE status='active' AND id != ?", [$id]);
        $this->render('categories/form', compact('category', 'categories'));
    }
    public function update($id) {
        $this->validateCSRF();
        $data = $this->getPost();
        $cat = $this->db->fetch("SELECT * FROM categories WHERE id=?", [$id]);
        $image = $cat->image;
        if (!empty($_FILES['image']['name'])) { $u = $this->uploadImage($_FILES['image']); if ($u['success']) { $this->deleteImage($cat->image); $image = $u['filename']; } }
        $this->db->update("UPDATE categories SET parent_id=?, name=?, slug=?, image=?, description=?, status=? WHERE id=?",
            [$data['parent_id'] ?: null, $data['name'], Helper::slugify($data['name']), $image, $data['description'] ?? '', $data['status'] ?? 'active', $id]);
        $this->logActivity('Categories', 'Update', $id);
        Session::setFlash('success', 'Category updated successfully');
        Helper::redirect(APP_URL . '/categories');
    }
    public function delete($id) {
        $this->validateCSRF();
        $cat = $this->db->fetch("SELECT * FROM categories WHERE id=?", [$id]);
        if ($cat) { $this->deleteImage($cat->image); $this->db->delete("DELETE FROM categories WHERE id=?", [$id]); }
        $this->logActivity('Categories', 'Delete', $id);
        Session::setFlash('success', 'Category deleted');
        Helper::redirect(APP_URL . '/categories');
    }
}
