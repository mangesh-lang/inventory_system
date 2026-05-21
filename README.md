# Enterprise Multi-Level Inventory System (PHP + MySQL)

Hierarchy: Admin -> Supplier -> Distributor -> Shop.

No AJAX used. All modules use normal PHP form submit and GET/POST pages.

## Login
- Admin: admin@gmail.com / admin123
- Supplier: supplier@gmail.com / 123456
- Distributor: distributor@gmail.com / 123456
- Shop: shop@gmail.com / 123456

## Setup
1. Copy folder to `C:\xampp\htdocs\enterprise_inventory_system`
2. Create database `enterprise_inventory_system`
3. Import `database/enterprise_inventory_system.sql`
4. Open `http://localhost/enterprise_inventory_system/login.php`

## Included Modules
- Multi-role auth
- Admin supplier approval
- User management
- Categories/products
- Barcode number support and barcode print page
- Warehouses
- Purchase orders
- Stock transfer automation
- Shop sales billing
- GST calculations
- HTML print invoice / Save as PDF
- Reports and chart analytics using Chart.js
- Notifications
- Audit logs
- Role-based sidebar and route protection


## Password Storage
This version uses plain text passwords as requested for easy college/demo setup. For production, use password_hash() and password_verify().
