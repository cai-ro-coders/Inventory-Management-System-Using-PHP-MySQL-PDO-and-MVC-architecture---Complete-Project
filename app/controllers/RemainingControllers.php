<?php
class UserController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $s = $_GET['search'] ?? ''; $w = $s !== '' ? "WHERE u.first_name LIKE ? OR u.last_name LIKE ? OR u.username LIKE ? OR u.email LIKE ?" : ''; $p = $s !== '' ? ["%$s%", "%$s%", "%$s%", "%$s%"] : [];
        $result = $this->paginate("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id=r.id $w", $p);
        extract($result); $this->render('users/index', compact('data', 'pagination', 'search'));
    }
    public function create() { $roles = $this->db->fetchAll("SELECT * FROM roles"); $this->render('users/form', compact('roles')); }
    public function store() {
        $this->validateCSRF(); $d = $this->getPost();
        $pw = password_hash($d['password'], PASSWORD_DEFAULT);
        $avatar = 'default.png';
        if (!empty($_FILES['avatar']['name'])) { $u = $this->uploadImage($_FILES['avatar']); if ($u['success']) $avatar = $u['filename']; }
        $this->db->insert("INSERT INTO users (role_id, first_name, last_name, username, email, password, phone, avatar, address, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$d['role_id'], $d['first_name'], $d['last_name'], $d['username'], $d['email'], $pw, $d['phone'] ?? '', $avatar, $d['address'] ?? '', $d['status'] ?? 'active']);
        $this->logActivity('Users', 'Create'); Session::setFlash('success', 'User created'); Helper::redirect(APP_URL . '/users');
    }
    public function edit($id) { $user = $this->db->fetch("SELECT * FROM users WHERE id=?", [$id]); $roles = $this->db->fetchAll("SELECT * FROM roles"); $this->render('users/form', compact('user', 'roles')); }
    public function update($id) {
        $this->validateCSRF(); $d = $this->getPost(); $user = $this->db->fetch("SELECT * FROM users WHERE id=?", [$id]); $avatar = $user->avatar;
        if (!empty($_FILES['avatar']['name'])) { $u = $this->uploadImage($_FILES['avatar']); if ($u['success']) { $this->deleteImage($user->avatar); $avatar = $u['filename']; } }
        $pw = !empty($d['password']) ? password_hash($d['password'], PASSWORD_DEFAULT) : $user->password;
        $this->db->update("UPDATE users SET role_id=?, first_name=?, last_name=?, username=?, email=?, password=?, phone=?, avatar=?, address=?, status=? WHERE id=?",
            [$d['role_id'], $d['first_name'], $d['last_name'], $d['username'], $d['email'], $pw, $d['phone'] ?? '', $avatar, $d['address'] ?? '', $d['status'] ?? 'active', $id]);
        $this->logActivity('Users', 'Update', $id); Session::setFlash('success', 'User updated'); Helper::redirect(APP_URL . '/users');
    }
    public function delete($id) { $this->db->delete("DELETE FROM users WHERE id=?", [$id]); Session::setFlash('success', 'User deleted'); Helper::redirect(APP_URL . '/users'); }
    public function profile() { $user = $this->db->fetch("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id=?", [Session::userId()]); $this->render('users/profile', compact('user')); }
    public function updateProfile() {
        $this->validateCSRF(); $d = $this->getPost(); $id = Session::userId(); $user = $this->db->fetch("SELECT * FROM users WHERE id=?", [$id]); $avatar = $user->avatar;
        if (!empty($_FILES['avatar']['name'])) { $u = $this->uploadImage($_FILES['avatar']); if ($u['success']) { $this->deleteImage($user->avatar); $avatar = $u['filename']; } }
        $this->db->update("UPDATE users SET first_name=?, last_name=?, username=?, email=?, phone=?, address=?, avatar=? WHERE id=?", [$d['first_name'], $d['last_name'], $d['username'], $d['email'], $d['phone'] ?? '', $d['address'] ?? '', $avatar, $id]);
        Session::set('user_name', $d['first_name'] . ' ' . $d['last_name']); Session::setFlash('success', 'Profile updated'); Helper::redirect(APP_URL . '/profile');
    }
    public function changePassword() {
        $this->validateCSRF(); $d = $this->getPost(); $id = Session::userId(); $user = $this->db->fetch("SELECT * FROM users WHERE id=?", [$id]);
        if (!password_verify($d['current_password'], $user->password)) { Session::setFlash('error', 'Current password is incorrect'); Helper::redirect(APP_URL . '/profile'); }
        if ($d['new_password'] !== $d['confirm_password']) { Session::setFlash('error', 'Passwords do not match'); Helper::redirect(APP_URL . '/profile'); }
        $this->db->update("UPDATE users SET password=? WHERE id=?", [password_hash($d['new_password'], PASSWORD_DEFAULT), $id]);
        Session::setFlash('success', 'Password changed successfully'); Helper::redirect(APP_URL . '/profile');
    }
}

class RoleController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $data = $this->db->fetchAll("SELECT r.*, (SELECT COUNT(*) FROM users WHERE role_id=r.id) as user_count FROM roles r");
        $this->render('roles/index', compact('data'));
    }
    public function create() { $this->render('roles/form'); }
    public function store() {
        $this->validateCSRF(); $d = $this->getPost();
        $this->db->insert("INSERT INTO roles (name, description) VALUES (?, ?)", [$d['name'], $d['description'] ?? '']);
        Session::setFlash('success', 'Role created'); Helper::redirect(APP_URL . '/roles');
    }
    public function edit($id) {
        $role = $this->db->fetch("SELECT * FROM roles WHERE id=?", [$id]);
        $permissions = $this->db->fetchAll("SELECT * FROM permissions ORDER BY module, name");
        $rolePerms = $this->db->fetchAll("SELECT permission_id FROM role_permissions WHERE role_id=?", [$id]);
        $rolePermIds = array_map(function($p) { return $p->permission_id; }, $rolePerms);
        $this->render('roles/form', compact('role', 'permissions', 'rolePermIds'));
    }
    public function update($id) {
        $this->validateCSRF(); $d = $this->getPost();
        $this->db->update("UPDATE roles SET name=?, description=? WHERE id=?", [$d['name'], $d['description'] ?? '', $id]);
        $this->db->delete("DELETE FROM role_permissions WHERE role_id=?", [$id]);
        $perms = $d['permissions'] ?? [];
        foreach ($perms as $permId) { $this->db->insert("INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)", [$id, $permId]); }
        Session::setFlash('success', 'Role updated'); Helper::redirect(APP_URL . '/roles');
    }
    public function delete($id) { $this->db->delete("DELETE FROM roles WHERE id=?", [$id]); Session::setFlash('success', 'Role deleted'); Helper::redirect(APP_URL . '/roles'); }
}

class NotificationController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $notifications = $this->db->fetchAll("SELECT * FROM notifications WHERE user_id=? ORDER BY id DESC", [Session::userId()]);
        $this->render('notifications/index', compact('notifications'));
    }
    public function markRead($id) {
        $this->db->update("UPDATE notifications SET is_read=1 WHERE id=? AND user_id=?", [$id, Session::userId()]);
        Helper::redirect(APP_URL . '/notifications');
    }
    public function markAllRead() {
        $this->validateCSRF();
        $this->db->update("UPDATE notifications SET is_read=1 WHERE user_id=? AND is_read=0", [Session::userId()]);
        Session::setFlash('success', 'All notifications marked as read');
        Helper::redirect(APP_URL . '/notifications');
    }
    public function delete($id) {
        $this->validateCSRF();
        $this->db->delete("DELETE FROM notifications WHERE id=? AND user_id=?", [$id, Session::userId()]);
        Session::setFlash('success', 'Notification deleted');
        Helper::redirect(APP_URL . '/notifications');
    }
}

class SettingController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $settings = $this->db->fetch("SELECT * FROM settings WHERE id=1");
        $this->render('settings/index', compact('settings'));
    }
    public function update() {
        $this->validateCSRF(); $d = $this->getPost();
        $logo = $this->db->fetch("SELECT company_logo FROM settings WHERE id=1")->company_logo ?? 'logo.png';
        if (!empty($_FILES['company_logo']['name'])) { $u = $this->uploadImage($_FILES['company_logo']); if ($u['success']) $logo = $u['filename']; }
        $invLogo = $logo;
        if (!empty($_FILES['invoice_logo']['name'])) { $u = $this->uploadImage($_FILES['invoice_logo']); if ($u['success']) $invLogo = $u['filename']; }
        $exists = $this->db->count("SELECT COUNT(*) FROM settings");
        if ($exists) {
            $this->db->update("UPDATE settings SET company_name=?, company_logo=?, email=?, phone=?, address=?, currency=?, tax_rate=?, timezone=?, invoice_prefix=?, low_stock_limit=? WHERE id=1",
                [$d['company_name'], $logo, $d['email'], $d['phone'], $d['address'], $d['currency'] ?? CURRENCY, $d['tax_rate'] ?? TAX_RATE, $d['timezone'] ?? TIMEZONE, $d['invoice_prefix'] ?? INVOICE_PREFIX, $d['low_stock_limit'] ?? LOW_STOCK_LIMIT]);
        } else {
            $this->db->insert("INSERT INTO settings (company_name, company_logo, email, phone, address, currency, tax_rate, timezone, invoice_prefix, low_stock_limit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [$d['company_name'], $logo, $d['email'], $d['phone'], $d['address'], $d['currency'] ?? CURRENCY, $d['tax_rate'] ?? TAX_RATE, $d['timezone'] ?? TIMEZONE, $d['invoice_prefix'] ?? INVOICE_PREFIX, $d['low_stock_limit'] ?? LOW_STOCK_LIMIT]);
        }
        Session::setFlash('success', 'Settings updated'); Helper::redirect(APP_URL . '/settings');
    }
    public function backup() {
        $backupFile = 'backup_' . date('Ymd_His') . '.sql';
        $command = sprintf('mysqldump -u%s %s > %s', DB_USER, DB_NAME, UPLOAD_PATH . $backupFile);
        exec($command);
        $this->logActivity('Settings', 'Backup');
        Session::setFlash('success', 'Database backup created: ' . $backupFile);
        Helper::redirect(APP_URL . '/settings');
    }
}

class ActivityLogController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $s = $_GET['search'] ?? ''; $w = $s !== '' ? "WHERE al.module LIKE ? OR al.action LIKE ? OR u.first_name LIKE ? OR u.last_name LIKE ?" : ''; $p = $s !== '' ? ["%$s%", "%$s%", "%$s%", "%$s%"] : [];
        $result = $this->paginate("SELECT al.*, u.first_name, u.last_name, u.username FROM audit_logs al LEFT JOIN users u ON al.user_id=u.id $w ORDER BY al.id DESC", $p);
        extract($result); $this->render('settings/activity-logs', compact('data', 'pagination', 'search'));
    }
}

class ApiController extends Controller {
    public function __construct() { parent::__construct(); Session::init(); }
    public function products() {
        $products = $this->db->fetchAll("SELECT p.id, p.name, p.sku, p.selling_price as price, p.image, COALESCE(i.quantity,0) as stock FROM products p LEFT JOIN (SELECT product_id, SUM(quantity) as quantity FROM inventory GROUP BY product_id) i ON p.id=i.product_id WHERE p.status='active'");
        Helper::jsonResponse($products);
    }
    public function categories() { Helper::jsonResponse($this->db->fetchAll("SELECT * FROM categories WHERE status='active'")); }
    public function suppliers() { Helper::jsonResponse($this->db->fetchAll("SELECT * FROM suppliers WHERE status='active'")); }
    public function customers() { Helper::jsonResponse($this->db->fetchAll("SELECT * FROM customers WHERE status='active'")); }
    public function chartData() {
        $salesData = $this->db->fetchAll("SELECT DATE_FORMAT(sale_date, '%Y-%m-%d') as date, SUM(total) as total FROM sales_orders WHERE status='completed' AND sale_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY DATE(sale_date) ORDER BY date");
        $purchaseData = $this->db->fetchAll("SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') as date, SUM(total) as total FROM purchase_orders WHERE status IN ('completed','approved') AND purchase_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY DATE(purchase_date) ORDER BY date");
        $categoryData = $this->db->fetchAll("SELECT c.name, COUNT(p.id) as count FROM categories c JOIN products p ON c.id=p.category_id GROUP BY c.id");
        Helper::jsonResponse(compact('salesData', 'purchaseData', 'categoryData'));
    }
}

class SearchController extends Controller {
    public function __construct() { parent::__construct(); $this->requireAuth(); }
    public function index() {
        $q = Helper::sanitize($_GET['q'] ?? '');
        $products = $this->db->fetchAll("SELECT p.id, p.name, p.sku, p.selling_price, p.status, c.name as category_name, COALESCE(SUM(inv.quantity), 0) as quantity FROM products p LEFT JOIN categories c ON p.category_id = c.id LEFT JOIN inventory inv ON inv.product_id = p.id WHERE p.name LIKE ? OR p.sku LIKE ? GROUP BY p.id LIMIT 10", ["%$q%", "%$q%"]);
        $customers = $this->db->fetchAll("SELECT id, first_name, last_name, email, phone, status FROM customers WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? LIMIT 10", ["%$q%", "%$q%", "%$q%"]);
        $suppliers = $this->db->fetchAll("SELECT id, company_name, contact_person, email, phone, status FROM suppliers WHERE company_name LIKE ? OR contact_person LIKE ? LIMIT 10", ["%$q%", "%$q%"]);
        $this->render('search/index', compact('q', 'products', 'customers', 'suppliers'));
    }
}
