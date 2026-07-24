<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers/Helper.php';

$db = Database::getInstance();

// Roles
$db->insert("INSERT INTO roles (name, description) VALUES ('Admin', 'Full system access')");
$db->insert("INSERT INTO roles (name, description) VALUES ('Manager', 'Management level access')");
$db->insert("INSERT INTO roles (name, description) VALUES ('Staff', 'Limited staff access')");

// Permissions
$permissions = [
    ['users-view', 'Users'], ['users-create', 'Users'], ['users-edit', 'Users'], ['users-delete', 'Users'],
    ['roles-view', 'Roles'], ['roles-create', 'Roles'], ['roles-edit', 'Roles'], ['roles-delete', 'Roles'],
    ['products-view', 'Products'], ['products-create', 'Products'], ['products-edit', 'Products'], ['products-delete', 'Products'],
    ['categories-view', 'Categories'], ['categories-create', 'Categories'], ['categories-edit', 'Categories'], ['categories-delete', 'Categories'],
    ['brands-view', 'Brands'], ['brands-create', 'Brands'], ['brands-edit', 'Brands'], ['brands-delete', 'Brands'],
    ['purchases-view', 'Purchases'], ['purchases-create', 'Purchases'], ['purchases-edit', 'Purchases'], ['purchases-delete', 'Purchases'],
    ['sales-view', 'Sales'], ['sales-create', 'Sales'], ['sales-edit', 'Sales'], ['sales-delete', 'Sales'],
    ['inventory-view', 'Inventory'], ['inventory-adjust', 'Inventory'],
    ['reports-view', 'Reports'], ['settings-view', 'Settings'], ['settings-edit', 'Settings'],
];
foreach ($permissions as $p) {
    $db->insert("INSERT INTO permissions (name, module) VALUES (?, ?)", $p);
}

// Assign all permissions to Admin role (1)
$allPerms = $db->fetchAll("SELECT id FROM permissions");
foreach ($allPerms as $perm) {
    $db->insert("INSERT INTO role_permissions (role_id, permission_id) VALUES (1, ?)", [$perm->id]);
}

// Admin user (password: admin123)
$password = password_hash('admin123', PASSWORD_DEFAULT);
$db->insert("INSERT INTO users (role_id, first_name, last_name, username, email, password, phone) VALUES (1, 'System', 'Admin', 'admin', 'admin@example.com', ?, '09123456789')", [$password]);
$db->insert("INSERT INTO users (role_id, first_name, last_name, username, email, password, phone) VALUES (2, 'John', 'Manager', 'manager', 'manager@example.com', ?, '09123456788')", [$password]);
$db->insert("INSERT INTO users (role_id, first_name, last_name, username, email, password, phone) VALUES (3, 'Jane', 'Staff', 'staff', 'staff@example.com', ?, '09123456787')", [$password]);

// Categories
$categories = [
    ['Electronics', 'electronics'], ['Clothing', 'clothing'], ['Food & Beverages', 'food-beverages'],
    ['Office Supplies', 'office-supplies'], ['Health & Beauty', 'health-beauty'],
    ['Home & Living', 'home-living'], ['Sports & Outdoors', 'sports-outdoors'], ['Automotive', 'automotive'],
    ['Books & Media', 'books-media'], ['Toys & Games', 'toys-games'],
];
foreach ($categories as $c) {
    $db->insert("INSERT INTO categories (name, slug, status) VALUES (?, ?, 'active')", $c);
}

// Brands
$brands = ['Nike', 'Adidas', 'Apple', 'Samsung', 'Sony', 'LG', 'Panasonic', 'Xiaomi', 'Dell', 'HP'];
foreach ($brands as $b) {
    $db->insert("INSERT INTO brands (name, status) VALUES (?, 'active')", [$b]);
}

// Units
$units = [
    ['Piece', 'pc', 'Individual item'], ['Box', 'box', 'Box of items'],
    ['Kilogram', 'kg', 'Weight in kilograms'], ['Gram', 'g', 'Weight in grams'],
    ['Liter', 'L', 'Volume in liters'], ['Meter', 'm', 'Length in meters'],
    ['Pack', 'pack', 'Pack of items'], ['Dozen', 'dz', '12 pieces'],
    ['Set', 'set', 'Set of items'], ['Pair', 'pr', 'Pair of items'],
];
foreach ($units as $u) {
    $db->insert("INSERT INTO units (name, short_name, description) VALUES (?, ?, ?)", $u);
}

// Warehouses
$warehouses = [
    ['Main Warehouse', 'WH-001', '123 Main St', 'Manila', 'Philippines', '028123456', 'Juan Dela Cruz'],
    ['Secondary Warehouse', 'WH-002', '456 Oak Ave', 'Cebu City', 'Philippines', '032123456', 'Maria Santos'],
    ['North Distribution', 'WH-003', '789 Pine Rd', 'Quezon City', 'Philippines', '028654321', 'Pedro Reyes'],
];
foreach ($warehouses as $w) {
    $db->insert("INSERT INTO warehouses (name, code, address, city, country, phone, manager, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'active')", $w);
}

// Suppliers
$suppliers = [
    ['TechSource Inc.', 'Carlos Mendoza', 'carlos@techsource.com', '09171234567', 'Tech City', 'Manila', '123-456-789'],
    ['Global Traders Co.', 'Anna Lopez', 'anna@globaltraders.com', '09181234567', 'Commerce Ave', 'Cebu', '987-654-321'],
    ['Prime Distributors', 'Miguel Torres', 'miguel@primedist.com', '09191234567', 'Trade St', 'Makati', '456-789-123'],
    ['United Supplies', 'Sofia Garcia', 'sofia@unitedsupplies.com', '09201234567', 'Supply Lane', 'Manila', '321-654-987'],
    ['Pacific Goods Inc.', 'Luis Santos', 'luis@pacificgoods.com', '09211234567', 'Pacific Ave', 'Davao', '654-321-789'],
];
foreach ($suppliers as $s) {
    $db->insert("INSERT INTO suppliers (company_name, contact_person, email, phone, address, city, country, tax_number, status) VALUES (?, ?, ?, ?, ?, ?, 'Philippines', ?, 'active')", $s);
}

// Customers
for ($i = 1; $i <= 20; $i++) {
    $first = ['Juan', 'Maria', 'Pedro', 'Ana', 'Jose', 'Elena', 'Carlos', 'Luz', 'Antonio', 'Rosa',
              'Manuel', 'Cristina', 'Francisco', 'Teresa', 'Andres', 'Gloria', 'Ricardo', 'Lourdes', 'Eduardo', 'Carmen'][$i-1];
    $last = ['Dela Cruz', 'Santos', 'Reyes', 'Gonzales', 'Lopez', 'Martinez', 'Hernandez', 'Garcia', 'Rodriguez', 'Perez',
             'Tan', 'Lim', 'Ong', 'Sy', 'Chua', 'Go', 'Co', 'Uy', 'Dizon', 'Romualdez'][$i-1];
    $code = 'CUST-' . str_pad($i, 4, '0', STR_PAD_LEFT);
    $db->insert("INSERT INTO customers (customer_code, first_name, last_name, company, email, phone, address, city, country, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Philippines', 'active')",
        [$code, $first, $last, $last . ' Enterprises', strtolower($first) . '.' . strtolower($last) . '@email.com', '0917' . str_pad($i, 7, '0', STR_PAD_LEFT), $i . ' Customer St', 'Manila']);
}

// Products
for ($i = 1; $i <= 50; $i++) {
    $catId = rand(1, 10);
    $brandId = rand(1, 10);
    $unitId = rand(1, 8);
    $supplierId = rand(1, 5);
    $names = [
        'Wireless Mouse', 'USB-C Hub', 'Laptop Stand', 'Mechanical Keyboard', 'HDMI Cable',
        'Bluetooth Speaker', 'Smart Watch Band', 'Phone Case', 'Screen Protector', 'Power Bank',
        'T-Shirt', 'Denim Jacket', 'Running Shoes', 'Backpack', 'Sunglasses',
        'Coffee Maker', 'Water Bottle', 'Yoga Mat', 'Desk Lamp', 'Notebook Set',
        'Hand Sanitizer', 'Vitamin C', 'Face Mask', 'Shampoo', 'Toothpaste',
        'Throw Pillow', 'Wall Clock', 'Photo Frame', 'Storage Box', 'Area Rug',
        'Basketball', 'Jump Rope', 'Resistance Bands', 'Water Jug', 'Camping Tent',
        'Car Charger', 'Air Freshener', 'Tire Inflator', 'Dash Cam', 'Car Mat',
        'Novel', 'Cookbook', 'Wall Art Print', 'Journal', 'Pen Set',
        'Board Game', 'Puzzle Set', 'Action Figure', 'Building Blocks', 'Remote Car'
    ];
    $name = $names[$i-1];
    $slug = Helper::slugify($name);
    $purchasePrice = round(rand(5000, 50000) / 100, 2);
    $sellingPrice = round($purchasePrice * (1 + rand(10, 40) / 100), 2);
    $sku = 'SKU-' . str_pad($i, 5, '0', STR_PAD_LEFT);
    $db->insert("INSERT INTO products (category_id, brand_id, unit_id, supplier_id, sku, barcode, name, slug, purchase_price, selling_price, minimum_stock, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active')",
        [$catId, $brandId, $unitId, $supplierId, $sku, 'BR' . uniqid(), $name, $slug . '-' . $i, $purchasePrice, $sellingPrice, rand(5, 20)]);
    
    // Inventory for each warehouse
    $prodId = $i;
    foreach ([1, 2, 3] as $whId) {
        $qty = rand(10, 500);
        $db->insert("INSERT INTO inventory (product_id, warehouse_id, quantity, reserved_quantity, available_quantity) VALUES (?, ?, ?, 0, ?)",
            [$prodId, $whId, $qty, $qty]);
    }
}

// Settings
$db->insert("INSERT INTO settings (company_name, email, phone, address, currency, tax_rate, timezone, invoice_prefix, low_stock_limit) VALUES ('Inventory Management System', 'admin@inventorysystem.com', '0281234567', '123 Business Center, Manila, Philippines', '₱', 12.00, 'Asia/Manila', 'INV-', 10)");

// Sample Purchase Orders
for ($i = 1; $i <= 10; $i++) {
    $supplierId = rand(1, 5);
    $warehouseId = rand(1, 3);
    $date = date('Y-m-d', strtotime("-{$i} days"));
    $subtotal = round(rand(5000, 100000) / 100, 2);
    $tax = round($subtotal * 0.12, 2);
    $total = $subtotal + $tax;
    $paid = ($i % 3 == 0) ? $total : round($total * rand(0, 100) / 100, 2);
    $due = round($total - $paid, 2);
    $status = ($i % 3 == 0) ? 'completed' : (($i % 3 == 1) ? 'approved' : 'pending');
    $paymentStatus = ($paid >= $total) ? 'Paid' : (($paid > 0) ? 'Partial' : 'Unpaid');
    
    $invNo = 'PO-' . date('Ymd', strtotime($date)) . '-' . str_pad($i, 4, '0', STR_PAD_LEFT);
    $db->insert("INSERT INTO purchase_orders (supplier_id, warehouse_id, user_id, invoice_no, purchase_date, subtotal, tax, total, paid_amount, due_amount, payment_status, status) VALUES (?, ?, 1, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [$supplierId, $warehouseId, $invNo, $date, $subtotal, $tax, $total, $paid, $due, $paymentStatus, $status]);
    
    // Items for each PO
    for ($j = 1; $j <= rand(2, 5); $j++) {
        $prodId = rand(1, 50);
        $qty = rand(5, 50);
        $price = round(rand(500, 5000) / 100, 2);
        $itemTotal = round($qty * $price, 2);
        $db->insert("INSERT INTO purchase_items (purchase_order_id, product_id, quantity, purchase_price, total) VALUES (?, ?, ?, ?, ?)",
            [$i, $prodId, $qty, $price, $itemTotal]);
    }
}

// Sample Sales Orders
for ($i = 1; $i <= 10; $i++) {
    $customerId = rand(1, 20);
    $warehouseId = rand(1, 3);
    $date = date('Y-m-d', strtotime("-{$i} days"));
    $subtotal = round(rand(2000, 80000) / 100, 2);
    $tax = round($subtotal * 0.12, 2);
    $total = $subtotal + $tax;
    $paid = ($i % 2 == 0) ? $total : round($total * rand(50, 100) / 100, 2);
    $due = round($total - $paid, 2);
    $status = ($i % 4 == 0) ? 'cancelled' : 'completed';
    $paymentStatus = ($paid >= $total) ? 'Paid' : (($paid > 0) ? 'Partial' : 'Unpaid');
    
    $invNo = 'SALE-' . date('Ymd', strtotime($date)) . '-' . str_pad($i, 4, '0', STR_PAD_LEFT);
    $db->insert("INSERT INTO sales_orders (customer_id, warehouse_id, user_id, invoice_no, sale_date, subtotal, tax, total, paid_amount, due_amount, payment_status, status) VALUES (?, ?, 1, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [$customerId, $warehouseId, $invNo, $date, $subtotal, $tax, $total, $paid, $due, $paymentStatus, $status]);
    
    for ($j = 1; $j <= rand(2, 4); $j++) {
        $prodId = rand(1, 50);
        $qty = rand(1, 10);
        $price = round(rand(1000, 10000) / 100, 2);
        $itemTotal = round($qty * $price, 2);
        $db->insert("INSERT INTO sales_items (sales_order_id, product_id, quantity, selling_price, total) VALUES (?, ?, ?, ?, ?)",
            [$i, $prodId, $qty, $price, $itemTotal]);
    }
}

// Expense Categories
$expenseCategories = ['Utilities', 'Rent', 'Salaries', 'Marketing', 'Transportation', 'Maintenance', 'Office Supplies', 'Insurance', 'Taxes', 'Miscellaneous'];
foreach ($expenseCategories as $ec) {
    $db->insert("INSERT INTO expense_categories (name) VALUES (?)", [$ec]);
}

// Sample Expenses
for ($i = 1; $i <= 20; $i++) {
    $catId = rand(1, 10);
    $amount = round(rand(1000, 50000) / 100, 2);
    $date = date('Y-m-d', strtotime("-" . rand(1, 30) . " days"));
    $titles = ['Monthly rent', 'Electric bill', 'Water bill', 'Internet service', 'Office supplies', 'Employee salary', 'Marketing campaign', 'Vehicle fuel', 'Equipment repair', 'Insurance premium'];
    $db->insert("INSERT INTO expenses (expense_category_id, user_id, title, amount, expense_date) VALUES (?, 1, ?, ?, ?)",
        [$catId, $titles[array_rand($titles)], $amount, $date]);
}

echo "Database seeded successfully!\n";
echo "Admin login: admin / admin123\n";
echo "Manager login: manager / admin123\n";
echo "Staff login: staff / admin123\n";
