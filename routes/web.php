<?php
require_once __DIR__ . '/../app/helpers/Router.php';
require_once __DIR__ . '/../app/helpers/Session.php';
require_once __DIR__ . '/../app/helpers/Helper.php';

$router = new Router();

// Auth routes
$router->get('login', ['AuthController', 'loginForm']);
$router->post('login', ['AuthController', 'login']);
$router->get('logout', ['AuthController', 'logout']);
$router->get('forgot-password', ['AuthController', 'forgotPasswordForm']);
$router->post('forgot-password', ['AuthController', 'forgotPassword']);
$router->get('reset-password/{token}', ['AuthController', 'resetPasswordForm']);
$router->post('reset-password', ['AuthController', 'resetPassword']);

// Authenticated routes
$router->get('dashboard', ['DashboardController', 'index']);

// Products
$router->get('products', ['ProductController', 'index']);
$router->get('products/create', ['ProductController', 'create']);
$router->post('products/store', ['ProductController', 'store']);
$router->get('products/edit/{id}', ['ProductController', 'edit']);
$router->post('products/update/{id}', ['ProductController', 'update']);
$router->get('products/view/{id}', ['ProductController', 'show']);
$router->post('products/delete/{id}', ['ProductController', 'delete']);
$router->get('products/export/csv', ['ProductController', 'exportCsv']);
$router->get('products/export/json', ['ProductController', 'exportJson']);

// Categories
$router->get('categories', ['CategoryController', 'index']);
$router->get('categories/create', ['CategoryController', 'create']);
$router->post('categories/store', ['CategoryController', 'store']);
$router->get('categories/edit/{id}', ['CategoryController', 'edit']);
$router->post('categories/update/{id}', ['CategoryController', 'update']);
$router->post('categories/delete/{id}', ['CategoryController', 'delete']);

// Brands
$router->get('brands', ['BrandController', 'index']);
$router->get('brands/create', ['BrandController', 'create']);
$router->post('brands/store', ['BrandController', 'store']);
$router->get('brands/edit/{id}', ['BrandController', 'edit']);
$router->post('brands/update/{id}', ['BrandController', 'update']);
$router->post('brands/delete/{id}', ['BrandController', 'delete']);

// Units
$router->get('units', ['UnitController', 'index']);
$router->get('units/create', ['UnitController', 'create']);
$router->post('units/store', ['UnitController', 'store']);
$router->get('units/edit/{id}', ['UnitController', 'edit']);
$router->post('units/update/{id}', ['UnitController', 'update']);
$router->post('units/delete/{id}', ['UnitController', 'delete']);

// Suppliers
$router->get('suppliers', ['SupplierController', 'index']);
$router->get('suppliers/create', ['SupplierController', 'create']);
$router->post('suppliers/store', ['SupplierController', 'store']);
$router->get('suppliers/edit/{id}', ['SupplierController', 'edit']);
$router->post('suppliers/update/{id}', ['SupplierController', 'update']);
$router->post('suppliers/delete/{id}', ['SupplierController', 'delete']);
$router->get('suppliers/view/{id}', ['SupplierController', 'show']);

// Customers
$router->get('customers', ['CustomerController', 'index']);
$router->get('customers/create', ['CustomerController', 'create']);
$router->post('customers/store', ['CustomerController', 'store']);
$router->get('customers/edit/{id}', ['CustomerController', 'edit']);
$router->post('customers/update/{id}', ['CustomerController', 'update']);
$router->post('customers/delete/{id}', ['CustomerController', 'delete']);
$router->get('customers/view/{id}', ['CustomerController', 'show']);

// Purchases
$router->get('purchases', ['PurchaseController', 'index']);
$router->get('purchases/create', ['PurchaseController', 'create']);
$router->post('purchases/store', ['PurchaseController', 'store']);
$router->get('purchases/edit/{id}', ['PurchaseController', 'edit']);
$router->post('purchases/update/{id}', ['PurchaseController', 'update']);
$router->post('purchases/delete/{id}', ['PurchaseController', 'delete']);
$router->get('purchases/view/{id}', ['PurchaseController', 'show']);
$router->get('purchases/invoice/{id}', ['PurchaseController', 'invoice']);

// Sales
$router->get('sales', ['SaleController', 'index']);
$router->get('sales/create', ['SaleController', 'create']);
$router->post('sales/store', ['SaleController', 'store']);
$router->get('sales/edit/{id}', ['SaleController', 'edit']);
$router->post('sales/update/{id}', ['SaleController', 'update']);
$router->post('sales/delete/{id}', ['SaleController', 'delete']);
$router->get('sales/view/{id}', ['SaleController', 'show']);
$router->get('sales/invoice/{id}', ['SaleController', 'invoice']);
$router->get('pos', ['SaleController', 'pos']);

// Inventory
$router->get('inventory', ['InventoryController', 'index']);
$router->get('inventory/stock-in', ['InventoryController', 'stockIn']);
$router->post('inventory/stock-in/store', ['InventoryController', 'stockInStore']);
$router->get('inventory/stock-out', ['InventoryController', 'stockOut']);
$router->post('inventory/stock-out/store', ['InventoryController', 'stockOutStore']);
$router->get('inventory/adjustment', ['InventoryController', 'adjustment']);
$router->post('inventory/adjustment/store', ['InventoryController', 'adjustmentStore']);
$router->get('inventory/transfers', ['InventoryController', 'transfers']);
$router->get('inventory/transfers/create', ['InventoryController', 'transferCreate']);
$router->post('inventory/transfers/store', ['InventoryController', 'transferStore']);
$router->get('inventory/transfers/view/{id}', ['InventoryController', 'transferView']);
$router->get('inventory/transfers/edit/{id}', ['InventoryController', 'transferEdit']);
$router->post('inventory/transfers/update/{id}', ['InventoryController', 'transferUpdate']);
$router->post('inventory/transfers/delete/{id}', ['InventoryController', 'transferDelete']);

// Warehouses
$router->get('warehouses', ['WarehouseController', 'index']);
$router->get('warehouses/create', ['WarehouseController', 'create']);
$router->post('warehouses/store', ['WarehouseController', 'store']);
$router->get('warehouses/edit/{id}', ['WarehouseController', 'edit']);
$router->post('warehouses/update/{id}', ['WarehouseController', 'update']);
$router->post('warehouses/delete/{id}', ['WarehouseController', 'delete']);

// Expenses
$router->get('expenses', ['ExpenseController', 'index']);
$router->get('expenses/create', ['ExpenseController', 'create']);
$router->post('expenses/store', ['ExpenseController', 'store']);
$router->get('expenses/edit/{id}', ['ExpenseController', 'edit']);
$router->post('expenses/update/{id}', ['ExpenseController', 'update']);
$router->post('expenses/delete/{id}', ['ExpenseController', 'delete']);
$router->get('expense-categories', ['ExpenseController', 'categories']);
$router->get('expenses/categories', ['ExpenseController', 'categories']);
$router->post('expenses/categories/store', ['ExpenseController', 'categoriesStore']);
$router->post('expenses/categories/delete/{id}', ['ExpenseController', 'categoriesDelete']);

// Reports
$router->get('reports', ['ReportController', 'index']);
$router->get('reports/sales', ['ReportController', 'sales']);
$router->get('reports/purchases', ['ReportController', 'purchases']);
$router->get('reports/inventory', ['ReportController', 'inventory']);
$router->get('reports/financial', ['ReportController', 'financial']);
$router->get('reports/customers', ['ReportController', 'customers']);
$router->get('reports/suppliers', ['ReportController', 'suppliers']);

// Users & Roles
$router->get('users', ['UserController', 'index']);
$router->get('users/create', ['UserController', 'create']);
$router->post('users/store', ['UserController', 'store']);
$router->get('users/edit/{id}', ['UserController', 'edit']);
$router->post('users/update/{id}', ['UserController', 'update']);
$router->post('users/delete/{id}', ['UserController', 'delete']);
$router->get('profile', ['UserController', 'profile']);
$router->post('profile/update', ['UserController', 'updateProfile']);
$router->post('profile/change-password', ['UserController', 'changePassword']);

$router->get('roles', ['RoleController', 'index']);
$router->get('roles/create', ['RoleController', 'create']);
$router->post('roles/store', ['RoleController', 'store']);
$router->get('roles/edit/{id}', ['RoleController', 'edit']);
$router->post('roles/update/{id}', ['RoleController', 'update']);
$router->post('roles/delete/{id}', ['RoleController', 'delete']);

// Notifications
$router->get('notifications', ['NotificationController', 'index']);
$router->post('notifications/read/{id}', ['NotificationController', 'markRead']);
$router->post('notifications/mark-all-read', ['NotificationController', 'markAllRead']);
$router->post('notifications/delete/{id}', ['NotificationController', 'delete']);

// Settings
$router->get('settings', ['SettingController', 'index']);
$router->post('settings/update', ['SettingController', 'update']);
$router->get('settings/backup', ['SettingController', 'backup']);

// Activity Logs
$router->get('activity-logs', ['ActivityLogController', 'index']);

// AJAX routes
$router->get('api/products', ['ApiController', 'products']);
$router->get('api/categories', ['ApiController', 'categories']);
$router->get('api/suppliers', ['ApiController', 'suppliers']);
$router->get('api/customers', ['ApiController', 'customers']);
$router->get('api/chart-data', ['ApiController', 'chartData']);

// Search
$router->get('search', ['SearchController', 'index']);

return $router;
