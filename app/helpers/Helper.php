<?php
class Helper {
    public static function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function csrfField() {
        return '<input type="hidden" name="csrf_token" value="' . self::generateCSRFToken() . '">';
    }

    public static function escape($input) {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    public static function sanitize($input) {
        if (is_array($input)) {
            return array_map([self::class, 'sanitize'], $input);
        }
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public static function escapeJS($string) {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $string);
    }

    public static function slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }

    public static function formatDate($date, $format = 'M d, Y') {
        return $date ? date($format, strtotime($date)) : '-';
    }

    public static function formatDateTime($datetime, $format = 'M d, Y h:i A') {
        return $datetime ? date($format, strtotime($datetime)) : '-';
    }

    public static function formatMoney($amount) {
        return CURRENCY . ' ' . number_format((float)($amount ?? 0), 2);
    }

    public static function timeAgo($datetime) {
        $time = strtotime($datetime);
        $diff = time() - $time;
        $intervals = [
            31536000 => 'year', 2592000 => 'month', 604800 => 'week',
            86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second'
        ];
        foreach ($intervals as $seconds => $label) {
            $count = floor($diff / $seconds);
            if ($count > 0) {
                return $count . ' ' . $label . ($count > 1 ? 's' : '') . ' ago';
            }
        }
        return 'just now';
    }

    public static function truncate($text, $length = 100) {
        if (strlen($text) <= $length) return $text;
        return substr($text, 0, $length) . '...';
    }

    public static function uploadFile($file, $path = null) {
        $target_dir = $path ?: UPLOAD_PATH;
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'csv'];
        if (!in_array($ext, $allowed)) {
            return ['success' => false, 'message' => 'File type not allowed'];
        }
        $filename = uniqid() . '_' . time() . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $target_dir . $filename)) {
            return ['success' => true, 'filename' => $filename];
        }
        return ['success' => false, 'message' => 'Upload failed'];
    }

    public static function deleteFile($filename, $path = null) {
        $file = ($path ?: UPLOAD_PATH) . $filename;
        if (file_exists($file) && $filename !== 'default.png') {
            unlink($file);
        }
    }

    public static function getStatusBadge($status) {
        $badges = [
            'active' => 'success', 'inactive' => 'secondary',
            'pending' => 'warning', 'completed' => 'success',
            'cancelled' => 'danger', 'Paid' => 'success',
            'Unpaid' => 'danger', 'Partial' => 'warning',
        ];
        $class = $badges[$status] ?? 'primary';
        return '<span class="badge bg-' . $class . '">' . ucfirst($status) . '</span>';
    }

    public static function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    public static function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function jsonResponse($data, $code = 200) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function generateInvoiceNo($prefix = null) {
        $prefix = $prefix ?: INVOICE_PREFIX;
        return $prefix . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }

    public static function generateBarcode() {
        return 'BR' . date('Ymd') . strtoupper(substr(uniqid(), -8));
    }

    public static function generateQRCode($data) {
        return 'data:image/png;base64,' . base64_encode($data);
    }

    public static function paginate($total, $page, $limit, $url) {
        $pages = ceil($total / $limit);
        $prev = $page > 1 ? $page - 1 : 1;
        $next = $page < $pages ? $page + 1 : $pages;
        return compact('total', 'page', 'limit', 'pages', 'prev', 'next', 'url');
    }
}
