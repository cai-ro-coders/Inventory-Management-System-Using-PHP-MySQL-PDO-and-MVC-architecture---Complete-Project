<?php
class Session {
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        session_destroy();
    }

    public static function setFlash($key, $message) {
        $_SESSION['flash'][$key] = $message;
    }

    public static function getFlash($key) {
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }
        return null;
    }

    public static function hasFlash($key) {
        return isset($_SESSION['flash'][$key]);
    }

    public static function setUser($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_role'] = $user->role_id;
        $_SESSION['user_name'] = $user->first_name . ' ' . $user->last_name;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_avatar'] = $user->avatar ?? 'default.png';
        $_SESSION['logged_in'] = true;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function userId() {
        return $_SESSION['user_id'] ?? 0;
    }

    public static function userRole() {
        return $_SESSION['user_role'] ?? 0;
    }
}
