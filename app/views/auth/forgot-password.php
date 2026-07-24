<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - <?= APP_NAME ?></title>
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
                        <h4 class="mt-2">Forgot Password</h4>
                        <p class="mb-0 opacity-75">Enter your email to reset password</p>
                    </div>
                    <div class="login-body">
                        <?php if ($flash = \Session::getFlash('success')): ?>
                        <div class="alert alert-success"><?= $flash ?></div>
                        <?php endif; ?>
                        <?php if ($flash = \Session::getFlash('error')): ?>
                        <div class="alert alert-danger"><?= $flash ?></div>
                        <?php endif; ?>
                        <form method="POST" action="<?= APP_URL ?>/forgot-password">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-login">
                                <i class="bi bi-send me-2"></i> Send Reset Link
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
