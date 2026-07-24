<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border: none; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden; }
        .login-header { background: linear-gradient(135deg, #667eea, #764ba2); padding: 2rem; text-align: center; color: white; }
        .login-body { padding: 2.5rem; }
        .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25); }
        .btn-login { background: linear-gradient(135deg, #667eea, #764ba2); border: none; padding: 0.75rem; font-weight: 600; }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card">
                    <div class="login-header">
                        <i class="bi bi-box-seam" style="font-size: 2.5rem;"></i>
                        <h4 class="mt-2">Reset Password</h4>
                        <p class="mb-0 opacity-75">Enter your new password</p>
                    </div>
                    <div class="login-body">
                        <?php if ($flash = \Session::getFlash('error')): ?>
                        <div class="alert alert-danger"><?= $flash ?></div>
                        <?php endif; ?>
                        <form method="POST" action="<?= APP_URL ?>/reset-password">
                            <input type="hidden" name="token" value="<?= $token ?? '' ?>">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" required placeholder="Enter new password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" name="confirm_password" class="form-control" required placeholder="Confirm new password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-login">
                                <i class="bi bi-check-lg me-2"></i> Reset Password
                            </button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="<?= APP_URL ?>/login" class="text-decoration-none"><i class="bi bi-arrow-left me-1"></i> Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
