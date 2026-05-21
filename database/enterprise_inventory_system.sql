CREATE DATABASE IF NOT EXISTS enterprise_inventory_system;
USE enterprise_inventory_system;
DROP TABLE IF EXISTS audit_logs, notifications, sale_items, sales, stock_transfers, purchase_items, purchases, stock, warehouses, products, categories, users;
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), email VARCHAR(120) UNIQUE, password VARCHAR(255), role ENUM('admin','supplier','distributor','shop') NOT NULL, parent_id INT DEFAULT NULL, status ENUM('pending','active','blocked') DEFAULT 'active', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE categories(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), created_by INT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE products(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(150), sku VARCHAR(80), barcode VARCHAR(80), category_id INT, description TEXT, purchase_price DECIMAL(10,2), sale_price DECIMAL(10,2), gst_percent DECIMAL(5,2) DEFAULT 18, created_by INT, supplier_id INT, status ENUM('active','inactive') DEFAULT 'active', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE warehouses(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120), location VARCHAR(200), owner_id INT, owner_role VARCHAR(30), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE stock(id INT AUTO_INCREMENT PRIMARY KEY, product_id INT, warehouse_id INT, owner_id INT, owner_role VARCHAR(30), quantity INT DEFAULT 0, reorder_level INT DEFAULT 5, UNIQUE KEY uniq_stock(product_id, warehouse_id, owner_id));
CREATE TABLE purchases(id INT AUTO_INCREMENT PRIMARY KEY, supplier_user_id INT, purchase_no VARCHAR(80), total DECIMAL(10,2), gst_total DECIMAL(10,2), grand_total DECIMAL(10,2), status VARCHAR(30) DEFAULT 'completed', created_by INT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE purchase_items(id INT AUTO_INCREMENT PRIMARY KEY, purchase_id INT, product_id INT, qty INT, rate DECIMAL(10,2), gst_percent DECIMAL(5,2), line_total DECIMAL(10,2));
CREATE TABLE stock_transfers(id INT AUTO_INCREMENT PRIMARY KEY, from_user_id INT, to_user_id INT, product_id INT, from_warehouse_id INT, to_warehouse_id INT, qty INT, status ENUM('sent','received') DEFAULT 'received', note TEXT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE sales(id INT AUTO_INCREMENT PRIMARY KEY, invoice_no VARCHAR(80), shop_id INT, customer_name VARCHAR(120), customer_phone VARCHAR(20), subtotal DECIMAL(10,2), gst_total DECIMAL(10,2), grand_total DECIMAL(10,2), payment_status VARCHAR(30) DEFAULT 'paid', created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE sale_items(id INT AUTO_INCREMENT PRIMARY KEY, sale_id INT, product_id INT, qty INT, rate DECIMAL(10,2), gst_percent DECIMAL(5,2), line_total DECIMAL(10,2));
CREATE TABLE notifications(id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, title VARCHAR(150), message TEXT, is_read TINYINT DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE audit_logs(id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, action VARCHAR(120), details TEXT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
INSERT INTO users(name,email,password,role,parent_id,status) VALUES
('Admin','admin@gmail.com','admin123','admin',NULL,'active'),
('ABC Supplier','supplier@gmail.com','123456','supplier',1,'active'),
('North Distributor','distributor@gmail.com','123456','distributor',2,'active'),
('City Shop','shop@gmail.com','123456','shop',3,'active');
INSERT INTO categories(name,created_by) VALUES('Electronics',1),('Grocery',1),('Stationery',1);
INSERT INTO warehouses(name,location,owner_id,owner_role) VALUES('Main Admin Warehouse','Head Office',1,'admin'),('Supplier Warehouse','Industrial Area',2,'supplier'),('Distributor Warehouse','North Zone',3,'distributor'),('Shop Store Room','Market Road',4,'shop');
INSERT INTO products(name,sku,barcode,category_id,description,purchase_price,sale_price,gst_percent,created_by,supplier_id) VALUES('Wireless Mouse','WM-100','890100001001',1,'Fast wireless mouse',250,499,18,2,2),('USB Keyboard','KB-200','890100001002',1,'Classic keyboard',350,799,18,2,2),('Notebook Pack','NB-300','890100001003',3,'Pack of notebooks',80,150,12,2,2);
INSERT INTO stock(product_id,warehouse_id,owner_id,owner_role,quantity,reorder_level) VALUES(1,2,2,'supplier',100,10),(2,2,2,'supplier',80,10),(3,2,2,'supplier',150,20),(1,3,3,'distributor',30,5),(2,3,3,'distributor',25,5),(1,4,4,'shop',10,3),(3,4,4,'shop',20,5);
