<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?= APP_NAME ?></title>
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
                        <h4 class="mt-2"><?= APP_NAME ?></h4>
                        <p class="mb-0 opacity-75">Sign in to your account</p>
                    </div>
                    <div class="login-body">
                        <?php if ($flash = \Session::getFlash('success')): ?>
                        <div class="alert alert-success"><?= $flash ?></div>
                        <?php endif; ?>
                        <?php if ($flash = \Session::getFlash('error')): ?>
                        <div class="alert alert-danger"><?= $flash ?></div>
                        <?php endif; ?>
                        <form id="loginForm" method="POST" action="<?= APP_URL ?>/login">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="username" class="form-control" required placeholder="Enter username">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" required placeholder="Enter password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="bi bi-eye"></i></button>
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                                <a href="<?= APP_URL ?>/forgot-password" class="text-decoration-none">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                            </button>
                        </form>
                        <div class="text-center mt-3">
                            <small class="text-muted">Demo: admin / admin123</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $('#togglePassword').click(function() {
        var input = $('input[name="password"]');
        var icon = $(this).find('i');
        input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
        icon.toggleClass('bi-eye bi-eye-slash');
    });
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        $form.find('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Signing In...');
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(resp) {
                if (resp.success) {
                    window.location.href = resp.redirect;
                } else {
                    Swal.fire('Error', resp.message || 'Invalid credentials', 'error');
                    $form.find('button[type="submit"]').prop('disabled', false).html('<i class="bi bi-box-arrow-in-right me-2"></i> Sign In');
                }
            },
            error: function() {
                Swal.fire('Error', 'Connection error', 'error');
                $form.find('button[type="submit"]').prop('disabled', false).html('<i class="bi bi-box-arrow-in-right me-2"></i> Sign In');
            }
        });
    });
    </script>
</body>
</html>
