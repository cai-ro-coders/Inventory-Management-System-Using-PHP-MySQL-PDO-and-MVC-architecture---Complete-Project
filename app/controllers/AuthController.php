<?php
class AuthController extends Controller {
    
    public function loginForm() {
        if (Session::isLoggedIn()) {
            Helper::redirect(APP_URL . '/dashboard');
        }
        $this->view('auth/login');
    }

    public function login() {
        $username = Helper::sanitize($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']);
        $isAjax = Helper::isAjax();

        if (empty($username) || empty($password)) {
            if ($isAjax) {
                Helper::jsonResponse(['success' => false, 'message' => 'Please enter username and password']);
            }
            Session::setFlash('error', 'Please enter username and password');
            Helper::redirect(APP_URL . '/login');
        }

        $user = $this->db->fetch(
            "SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE u.username = ? AND u.status = 'active'",
            [$username]
        );

        if ($user && password_verify($password, $user->password)) {
            Session::setUser($user);
            
            $browser = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $os = 'Unknown';
            $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
            $this->db->insert(
                "INSERT INTO login_logs (user_id, login_time, ip_address, browser, operating_system) VALUES (?, NOW(), ?, ?, ?)",
                [$user->id, $ip, $browser, $os]
            );
            
            $this->db->update("UPDATE users SET last_login = NOW() WHERE id = ?", [$user->id]);

            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $this->db->update("UPDATE users SET remember_token = ? WHERE id = ?", [$token, $user->id]);
                setcookie('remember_token', $token, time() + 86400 * 30, '/');
            }

            Session::setFlash('success', 'Welcome back, ' . $user->first_name . '!');
            if ($isAjax) {
                Helper::jsonResponse(['success' => true, 'redirect' => APP_URL . '/dashboard']);
            }
            Helper::redirect(APP_URL . '/dashboard');
        } else {
            if ($isAjax) {
                Helper::jsonResponse(['success' => false, 'message' => 'Invalid credentials']);
            }
            Session::setFlash('error', 'Invalid username or password');
            Helper::redirect(APP_URL . '/login');
        }
    }

    public function logout() {
        if (Session::isLoggedIn()) {
            $userId = Session::userId();
            $this->db->update(
                "UPDATE login_logs SET logout_time = NOW() WHERE user_id = ? AND logout_time IS NULL ORDER BY id DESC LIMIT 1",
                [$userId]
            );
            setcookie('remember_token', '', time() - 3600, '/');
        }
        Session::destroy();
        Helper::redirect(APP_URL . '/login');
    }

    public function forgotPasswordForm() {
        $this->view('auth/forgot-password');
    }

    public function forgotPassword() {
        $email = Helper::sanitize($_POST['email'] ?? '');
        $user = $this->db->fetch("SELECT * FROM users WHERE email = ?", [$email]);
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $this->db->update("UPDATE users SET remember_token = ? WHERE id = ?", [$token, $user->id]);
            // In production, send email with reset link
            Session::setFlash('success', 'Password reset link has been sent to your email');
        } else {
            Session::setFlash('error', 'Email not found');
        }
        Helper::redirect(APP_URL . '/forgot-password');
    }

    public function resetPasswordForm($token) {
        $user = $this->db->fetch("SELECT * FROM users WHERE remember_token = ?", [$token]);
        if (!$user) {
            Session::setFlash('error', 'Invalid or expired reset token');
            Helper::redirect(APP_URL . '/login');
        }
        $this->view('auth/reset-password', ['token' => $token]);
    }

    public function resetPassword() {
        $token = Helper::sanitize($_POST['token'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['password_confirm'] ?? '';

        if ($password !== $confirm) {
            Session::setFlash('error', 'Passwords do not match');
            Helper::redirect(APP_URL . '/reset-password/' . $token);
        }

        $user = $this->db->fetch("SELECT * FROM users WHERE remember_token = ?", [$token]);
        if ($user) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $this->db->update("UPDATE users SET password = ?, remember_token = NULL WHERE id = ?", [$hashed, $user->id]);
            Session::setFlash('success', 'Password has been reset successfully');
            Helper::redirect(APP_URL . '/login');
        } else {
            Session::setFlash('error', 'Invalid reset token');
            Helper::redirect(APP_URL . '/login');
        }
    }
}
