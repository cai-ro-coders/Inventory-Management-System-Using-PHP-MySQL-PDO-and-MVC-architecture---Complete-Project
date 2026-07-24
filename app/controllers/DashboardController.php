<?php
class DashboardController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->requireAuth();
    }

    public function index() {
        $totalProducts = $this->db->count("SELECT COUNT(*) FROM products WHERE status='active'");
        $totalCategories = $this->db->count("SELECT COUNT(*) FROM categories WHERE status='active'");
        $totalSuppliers = $this->db->count("SELECT COUNT(*) FROM suppliers WHERE status='active'");
        $totalCustomers = $this->db->count("SELECT COUNT(*) FROM customers WHERE status='active'");
        $totalWarehouses = $this->db->count("SELECT COUNT(*) FROM warehouses WHERE status='active'");
        
        $todaySales = $this->db->fetch("SELECT COALESCE(SUM(total),0) as total FROM sales_orders WHERE DATE(sale_date) = CURDATE() AND status='completed'");
        $monthSales = $this->db->fetch("SELECT COALESCE(SUM(total),0) as total FROM sales_orders WHERE MONTH(sale_date)=MONTH(CURDATE()) AND YEAR(sale_date)=YEAR(CURDATE()) AND status='completed'");
        $todayPurchases = $this->db->fetch("SELECT COALESCE(SUM(total),0) as total FROM purchase_orders WHERE DATE(purchase_date) = CURDATE() AND status='completed'");
        $monthPurchases = $this->db->fetch("SELECT COALESCE(SUM(total),0) as total FROM purchase_orders WHERE MONTH(purchase_date)=MONTH(CURDATE()) AND YEAR(purchase_date)=YEAR(CURDATE()) AND status='completed'");
        
        $lowStock = $this->db->count("SELECT COUNT(*) FROM products p JOIN inventory i ON p.id=i.product_id WHERE i.quantity <= p.minimum_stock AND i.quantity > 0");
        $outOfStock = $this->db->count("SELECT COUNT(*) FROM products p JOIN inventory i ON p.id=i.product_id WHERE i.quantity <= 0");
        
        $recentSales = $this->db->fetchAll(
            "SELECT so.*, c.first_name, c.last_name FROM sales_orders so JOIN customers c ON so.customer_id=c.id ORDER BY so.id DESC LIMIT 5"
        );
        $recentPurchases = $this->db->fetchAll(
            "SELECT po.*, s.company_name FROM purchase_orders po JOIN suppliers s ON po.supplier_id=s.id ORDER BY po.id DESC LIMIT 5"
        );
        $topProducts = $this->db->fetchAll(
            "SELECT p.name, SUM(si.quantity) as total_qty, SUM(si.total) as total_sales 
             FROM sales_items si JOIN products p ON si.product_id=p.id 
             GROUP BY si.product_id ORDER BY total_sales DESC LIMIT 5"
        );
        $lowStockProducts = $this->db->fetchAll(
            "SELECT p.*, i.quantity, i.available_quantity FROM products p 
             JOIN inventory i ON p.id=i.product_id WHERE i.quantity <= p.minimum_stock ORDER BY i.quantity ASC LIMIT 5"
        );
        $latestNotifications = $this->db->fetchAll(
            "SELECT * FROM notifications WHERE user_id=? ORDER BY id DESC LIMIT 5", [Session::userId()]
        );

        $this->render('dashboard/index', compact(
            'totalProducts', 'totalCategories', 'totalSuppliers', 'totalCustomers', 'totalWarehouses',
            'todaySales', 'monthSales', 'todayPurchases', 'monthPurchases', 'lowStock', 'outOfStock',
            'recentSales', 'recentPurchases', 'topProducts', 'lowStockProducts', 'latestNotifications'
        ));
    }
}
