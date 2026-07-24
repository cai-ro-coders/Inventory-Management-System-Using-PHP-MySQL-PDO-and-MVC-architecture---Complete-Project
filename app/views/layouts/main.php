<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? APP_NAME ?> - <?= APP_NAME ?></title>
    <link rel="shortcut icon" href="<?= APP_URL ?>/assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">
    <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <?php if (Session::isLoggedIn()): ?>
    <div class="d-flex" id="wrapper">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="<?= APP_URL ?>/dashboard" class="text-decoration-none">
                    <h5 class="text-white mb-0"><i class="bi bi-box-seam me-2"></i><?= APP_NAME ?></h5>
                </a>
            </div>
            <div class="sidebar-user">
                <img src="<?= APP_URL ?>/assets/uploads/<?= Session::get('user_avatar', 'default.png') ?>" alt="Avatar" class="rounded-circle me-2" width="35" height="35">
                <div>
                    <small class="text-light d-block"><?= Session::get('user_name') ?></small>
                    <small class="text-muted"><?= Session::get('user_email') ?></small>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="<?= APP_URL ?>/dashboard" class="nav-link <?= strpos($content, 'dashboard') !== false ? 'active' : '' ?>">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#productsMenu" data-bs-toggle="collapse" class="nav-link">
                            <i class="bi bi-box me-2"></i> Products <i class="bi bi-chevron-down ms-auto float-end"></i>
                        </a>
                        <div class="collapse <?= strpos($content, 'product') !== false || strpos($content, 'categor') !== false || strpos($content, 'brand') !== false || strpos($content, 'unit') !== false ? 'show' : '' ?>" id="productsMenu">
                            <ul class="nav flex-column ms-3">
                                <li><a href="<?= APP_URL ?>/products" class="nav-link"><i class="bi bi-box-seam me-2"></i> Products</a></li>
                                <li><a href="<?= APP_URL ?>/categories" class="nav-link"><i class="bi bi-tags me-2"></i> Categories</a></li>
                                <li><a href="<?= APP_URL ?>/brands" class="nav-link"><i class="bi bi-bookmark me-2"></i> Brands</a></li>
                                <li><a href="<?= APP_URL ?>/units" class="nav-link"><i class="bi bi-rulers me-2"></i> Units</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#purchasesMenu" data-bs-toggle="collapse" class="nav-link">
                            <i class="bi bi-cart-plus me-2"></i> Purchases <i class="bi bi-chevron-down ms-auto float-end"></i>
                        </a>
                        <div class="collapse <?= strpos($content, 'purchase') !== false ? 'show' : '' ?>" id="purchasesMenu">
                            <ul class="nav flex-column ms-3">
                                <li><a href="<?= APP_URL ?>/purchases" class="nav-link"><i class="bi bi-receipt me-2"></i> Purchases</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#salesMenu" data-bs-toggle="collapse" class="nav-link">
                            <i class="bi bi-cart me-2"></i> Sales <i class="bi bi-chevron-down ms-auto float-end"></i>
                        </a>
                        <div class="collapse <?= strpos($content, 'sale') !== false || strpos($content, 'pos') !== false ? 'show' : '' ?>" id="salesMenu">
                            <ul class="nav flex-column ms-3">
                                <li><a href="<?= APP_URL ?>/pos" class="nav-link"><i class="bi bi-shop me-2"></i> POS</a></li>
                                <li><a href="<?= APP_URL ?>/sales" class="nav-link"><i class="bi bi-receipt me-2"></i> Sales</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#inventoryMenu" data-bs-toggle="collapse" class="nav-link">
                            <i class="bi bi-archive me-2"></i> Inventory <i class="bi bi-chevron-down ms-auto float-end"></i>
                        </a>
                        <div class="collapse <?= strpos($content, 'inventory') !== false ? 'show' : '' ?>" id="inventoryMenu">
                            <ul class="nav flex-column ms-3">
                                <li><a href="<?= APP_URL ?>/inventory" class="nav-link"><i class="bi bi-list-check me-2"></i> Current Stock</a></li>
                                <li><a href="<?= APP_URL ?>/inventory/stock-in" class="nav-link"><i class="bi bi-box-arrow-in-right me-2"></i> Stock In</a></li>
                                <li><a href="<?= APP_URL ?>/inventory/stock-out" class="nav-link"><i class="bi bi-box-arrow-right me-2"></i> Stock Out</a></li>
                                <li><a href="<?= APP_URL ?>/inventory/adjustment" class="nav-link"><i class="bi bi-sliders me-2"></i> Adjustment</a></li>
                                <li><a href="<?= APP_URL ?>/inventory/transfers" class="nav-link"><i class="bi bi-arrow-left-right me-2"></i> Transfers</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= APP_URL ?>/warehouses" class="nav-link <?= strpos($content, 'warehouse') !== false ? 'active' : '' ?>">
                            <i class="bi bi-building me-2"></i> Warehouses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= APP_URL ?>/suppliers" class="nav-link <?= strpos($content, 'supplier') !== false ? 'active' : '' ?>">
                            <i class="bi bi-truck me-2"></i> Suppliers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= APP_URL ?>/customers" class="nav-link <?= strpos($content, 'customer') !== false ? 'active' : '' ?>">
                            <i class="bi bi-people me-2"></i> Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= APP_URL ?>/expenses" class="nav-link <?= strpos($content, 'expense') !== false ? 'active' : '' ?>">
                            <i class="bi bi-cash-stack me-2"></i> Expenses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#reportsMenu" data-bs-toggle="collapse" class="nav-link">
                            <i class="bi bi-graph-up me-2"></i> Reports <i class="bi bi-chevron-down ms-auto float-end"></i>
                        </a>
                        <div class="collapse <?= strpos($content, 'report') !== false ? 'show' : '' ?>" id="reportsMenu">
                            <ul class="nav flex-column ms-3">
                                <li><a href="<?= APP_URL ?>/reports/sales" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Sales Reports</a></li>
                                <li><a href="<?= APP_URL ?>/reports/purchases" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Purchase Reports</a></li>
                                <li><a href="<?= APP_URL ?>/reports/inventory" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Inventory Reports</a></li>
                                <li><a href="<?= APP_URL ?>/reports/financial" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Financial Reports</a></li>
                                <li><a href="<?= APP_URL ?>/reports/customers" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Customer Reports</a></li>
                                <li><a href="<?= APP_URL ?>/reports/suppliers" class="nav-link"><i class="bi bi-bar-chart me-2"></i> Supplier Reports</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= APP_URL ?>/notifications" class="nav-link <?= strpos($content, 'notification') !== false ? 'active' : '' ?>">
                            <i class="bi bi-bell me-2"></i> Notifications
                            <?php
                            $unread = $this->db->count("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0", [Session::userId()]);
                            if ($unread > 0): ?>
                            <span class="badge bg-danger ms-auto float-end"><?= $unread ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#usersMenu" data-bs-toggle="collapse" class="nav-link">
                            <i class="bi bi-gear me-2"></i> User Management <i class="bi bi-chevron-down ms-auto float-end"></i>
                        </a>
                        <div class="collapse <?= strpos($content, 'user') !== false || strpos($content, 'role') !== false ? 'show' : '' ?>" id="usersMenu">
                            <ul class="nav flex-column ms-3">
                                <li><a href="<?= APP_URL ?>/users" class="nav-link"><i class="bi bi-people me-2"></i> Users</a></li>
                                <li><a href="<?= APP_URL ?>/roles" class="nav-link"><i class="bi bi-shield me-2"></i> Roles</a></li>
                                <li><a href="<?= APP_URL ?>/activity-logs" class="nav-link"><i class="bi bi-activity me-2"></i> Activity Logs</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= APP_URL ?>/settings" class="nav-link <?= strpos($content, 'setting') !== false ? 'active' : '' ?>">
                            <i class="bi bi-gear-wide me-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-3 py-2">
                <div class="container-fluid">
                    <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <form class="d-none d-md-flex me-auto" action="<?= APP_URL ?>/search" method="GET">
                        <div class="input-group input-group-sm" style="max-width: 300px;">
                            <input type="text" name="q" class="form-control" placeholder="Search..." id="globalSearch">
                            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-bell fs-5"></i>
                                <?php if ($unread > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;"><?= $unread ?></span>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <?php
                                $notifs = $this->db->fetchAll("SELECT * FROM notifications WHERE user_id = ? ORDER BY id DESC LIMIT 5", [Session::userId()]);
                                foreach ($notifs as $n): ?>
                                <li><a class="dropdown-item <?= !$n->is_read ? 'fw-bold' : '' ?>" href="#"><?= Helper::truncate($n->title, 40) ?><br><small class="text-muted"><?= Helper::timeAgo($n->created_at) ?></small></a></li>
                                <?php endforeach; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="<?= APP_URL ?>/notifications">View All</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                                <img src="<?= APP_URL ?>/assets/uploads/<?= Session::get('user_avatar', 'default.png') ?>" class="rounded-circle me-2" width="30" height="30" alt="">
                                <span class="d-none d-md-inline"><?= Session::get('user_name') ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/profile"><i class="bi bi-person me-2"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="<?= APP_URL ?>/settings"><i class="bi bi-gear me-2"></i> Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= APP_URL ?>/logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4 py-3">
                <?php if ($flash = Session::getFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade show"><?= $flash ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                <?php endif; ?>
                <?php if ($flash = Session::getFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?= $flash ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                <?php endif; ?>
                <?php if ($flash = Session::getFlash('info')): ?>
                <div class="alert alert-info alert-dismissible fade show"><?= $flash ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                <?php endif; ?>
                <?php require_once APP_ROOT . '/app/views/' . $content . '.php'; ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php require_once APP_ROOT . '/app/views/' . $content . '.php'; ?>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= APP_URL ?>/assets/js/script.js"></script>
    <?php if (isset($extra_js)): foreach ((array)$extra_js as $js): ?>
    <script src="<?= APP_URL ?>/assets/js/<?= $js ?>.js"></script>
    <?php endforeach; endif; ?>
</body>
</html>
