<?php
require_once APP_ROOT . '/config/database.php';
require_once APP_ROOT . '/app/helpers/Session.php';
require_once APP_ROOT . '/app/helpers/Helper.php';

class Controller {
    protected $db;
    protected $data = [];

    public function __construct() {
        $this->db = Database::getInstance();
        Session::init();
    }

    protected function view($view, $data = []) {
        extract($data);
        $viewFile = APP_ROOT . '/app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View not found: " . $view);
        }
    }

    protected function render($view, $data = []) {
        $data['page_title'] = $data['page_title'] ?? 'Dashboard';
        $data['content'] = $view;
        extract($data);
        require_once APP_ROOT . '/app/views/layouts/main.php';
    }

    protected function model($model) {
        $modelFile = APP_ROOT . '/app/models/' . $model . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        }
        die("Model not found: " . $model);
    }

    protected function getPost() {
        return $_POST;
    }

    protected function getGet() {
        return $_GET;
    }

    protected function validateRequired($data, $fields) {
        $errors = [];
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
            }
        }
        return $errors;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function requireAuth() {
        if (!Session::isLoggedIn()) {
            Session::setFlash('error', 'Please login to continue');
            Helper::redirect(APP_URL . '/login');
        }
    }

    protected function requireRole($roleId) {
        if (Session::userRole() != $roleId) {
            Session::setFlash('error', 'Access denied');
            Helper::redirect(APP_URL . '/dashboard');
        }
    }

    protected function requirePermission($permission) {
        $userId = Session::userId();
        $sql = "SELECT p.name FROM permissions p 
                JOIN role_permissions rp ON p.id = rp.permission_id 
                JOIN users u ON u.role_id = rp.role_id 
                WHERE u.id = ? AND p.name = ?";
        $result = $this->db->fetch($sql, [$userId, $permission]);
        if (!$result) {
            Session::setFlash('error', 'You do not have permission to perform this action');
            Helper::redirect(APP_URL . '/dashboard');
        }
    }

    protected function getInput($key, $default = '') {
        return Helper::sanitize($_POST[$key] ?? $_GET[$key] ?? $default);
    }

    protected function csrfToken() {
        return Helper::generateCSRFToken();
    }

    protected function validateCSRF() {
        $token = $_POST['csrf_token'] ?? '';
        if (!Helper::validateCSRFToken($token)) {
            if (Helper::isAjax()) {
                Helper::jsonResponse(['error' => 'Invalid CSRF token'], 403);
            }
            Session::setFlash('error', 'Invalid security token');
            Helper::redirect(APP_URL . '/dashboard');
        }
    }

    protected function paginate($sql, $params = [], $limit = 10) {
        $page = max(1, (int)($_GET['page'] ?? 1));
        $offset = ($page - 1) * $limit;
        $countSql = "SELECT COUNT(*) as total FROM (" . $sql . ") as t";
        $total = $this->db->fetch($countSql, $params)->total;
        $sql .= " LIMIT $limit OFFSET $offset";
        $data = $this->db->fetchAll($sql, $params);
        $search = $_GET['search'] ?? '';
        $pagination = Helper::paginate($total, $page, $limit, $_SERVER['REQUEST_URI']);
        return compact('data', 'pagination', 'search');
    }

    protected function uploadImage($file, $path = null) {
        return Helper::uploadFile($file, $path);
    }

    protected function deleteImage($filename, $path = null) {
        Helper::deleteFile($filename, $path);
    }

    protected function logActivity($module, $action, $recordId = null) {
        $userId = Session::userId();
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $this->db->insert(
            "INSERT INTO audit_logs (user_id, module, action, record_id, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?)",
            [$userId, $module, $action, $recordId, $ip, $ua]
        );
    }

    protected function createNotification($userId, $title, $message) {
        $this->db->insert(
            "INSERT INTO notifications (user_id, title, message) VALUES (?, ?, ?)",
            [$userId, $title, $message]
        );
    }

    protected function checkLowStock() {
        $products = $this->db->fetchAll(
            "SELECT p.id, p.name, i.quantity, p.minimum_stock FROM products p 
             LEFT JOIN inventory i ON p.id = i.product_id 
             WHERE i.quantity <= p.minimum_stock AND p.status = 'active'"
        );
        foreach ($products as $product) {
            $this->createNotification(
                Session::userId(),
                'Low Stock Alert',
                "Product '{$product->name}' has only {$product->quantity} units remaining (min: {$product->minimum_stock})"
            );
        }
    }
}
