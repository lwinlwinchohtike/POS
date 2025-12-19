# 🛒 Professional POS & Inventory Management System

[![Laravel](https://img.shields.io/badge/Laravel-5.4-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![AdminLTE](https://img.shields.io/badge/AdminLTE-v4-blue?style=for-the-badge)](https://adminlte.io)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](https://opensource.org/licenses/MIT)

A robust, full-stack Point of Sale (POS) solution designed to bridge the gap between inventory procurement and retail sales. Built with a focus on speed, data integrity, and a clean user experience.

---

## ⭐ Key Highlights
- **Real-time Inventory Tracking:** Automatically logs stock movement (In/Out) with every transaction.
- **Dynamic POS Terminal:** A responsive, barcode-ready interface for rapid checkout.
- **Procurement Workflow:** Integrated Purchase Order system to manage stock from various suppliers.
- **Reporting Engine:** Generate instant insights into sales performance and stock history.

## 🛠️ Technical Stack
- **Backend:** PHP 5.6+ (Laravel 5.4 Framework)
- **Frontend:** AdminLTE Dashboard Template, Bootstrap, jQuery
- **Database:** MySQL (Relational Schema for Orders, Products, and Users)
- **File Management:** Spatie MediaLibrary for optimized image handling.
- **Data Tables:** Server-side processing via Yajra Datatables for handling 10,000+ records smoothly.

---

## 📦 Core Modules

### 1. The POS Terminal
The heart of the application. It features a visual product grid and barcode scanning. 
* **Feature:** Auto-calculation of taxes and change due.
* **UX:** One-click product addition to the cart.

### 2. Inventory Intelligence
Beyond simple counting, this module tracks the **History** of every item.
* **Audit Trail:** Know exactly who sold or purchased what item and at what time.
* **Categorization:** Multi-level categories (e.g., Foods, Drinks, Stationery).

### 3. Supplier & Customer CRM
Manage relationships on both sides of the supply chain.
* **Suppliers:** Track procurement costs and history.
* **Customers:** Identify "Walk-in" vs. regular clients.

---

## 📷 Project Gallery

| Dashboard & Statistics | POS Checkout UI | Product Inventory |
| :---: | :---: | :---: |
| <img src="public/system-images/1.jpg" width="250"> | <img src="public/system-images/2.jpg" width="250"> | <img src="public/system-images/3.jpg" width="250"> |

| Stock Tracking Logs | Sales Reports | User Management |
| :---: | :---: | :---: |
| <img src="public/system-images/4.jpg" width="250"> | <img src="public/system-images/5.jpg" width="250"> | <img src="public/system-images/6.jpg" width="250"> |

| Category Lists | Purchase Reports | Purchase Checkout |
| :---: | :---: | :---: |
| <img src="public/system-images/7.jpg" width="250"> | <img src="public/system-images/8.jpg" width="250"> | <img src="public/system-images/9.jpg" width="250"> |

---

## ⚙️ Installation & Setup

1. **Clone & Install:**
   ```bash
   git clone https://github.com/lwinlwinchohtike/POS.git
   composer install

2. **Configure Env:**
   ```bash
    cp .env.example .env
    php artisan key:generate

3. **Database Setup:**
    ```bash
    php artisan migrate --seed

4. **Symlink Storage:**
    ```bash
    php artisan storage:link