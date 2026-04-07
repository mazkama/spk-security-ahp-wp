<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="100" alt="Laravel Logo">
</p>

# 🛡️ SPK Security Personnel Selection System (v1.0)

[![Laravel 10](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![AHP + WP](https://img.shields.io/badge/Methodology-AHP_%2B_WP-blue.svg)](#metodologi-hybrid)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

**SPK Security** is a professional Decision Support System (DSS) designed to automate the recruitment and selection process for security personnel. By combining the **Analytical Hierarchy Process (AHP)** for precision weighting and the **Weighted Product (WP)** for objective ranking, the system ensures a transparent and data-driven selection process.

---

## ✨ Features

- 🛰️ **Premium Dashboard**: A state-of-the-art interface with real-time stats and mission-control style period management.
- 📅 **Periodic Management**: Organize recruitment waves into distinct periods with active/inactive status and result locking.
- ⚖️ **AHP-Based Weighting**: Determine criterion importance using pairwise comparisons with consistency ratio validation.
- 👥 **Candidate Tracking**: Comprehensive database of applicants mapped to specific recruitment waves.
- 📊 **WP Ranking**: Automated calculation of candidate scores using weighted product vectors for absolute objectivity.
- 📱 **Mobile First**: Fully responsive UI/UX designed for seamless operation across desktop, tablet, and mobile devices.

---

## 🔬 Metodologi Hybrid

The system utilizes a dual-engine mathematical approach:

### 1. AHP (Analytical Hierarchy Process)
Used to derive the **Global Priority Weight** of each criterion. Experts perform pairwise comparisons to determine the relative importance of criteria such as *Physical Fitness*, *Integrity*, *Experience*, and *Certification*.

### 2. WP (Weighted Product)
The ranking engine. It calculates the **Preference Vector (V)** for each candidate by normalizing performance scores against the AHP-derived weights. This eliminates bias and highlights the strongest performers across all metrics.

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL 8.0+

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd spk-security-v1
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   Update your `.env` file with your database credentials:
   ```env
   DB_DATABASE=spk_security
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Serve the Application**
   ```bash
   npm run dev
   php artisan serve
   ```

---

## 📂 Documentation

Detailed technical documentation is available in the `/docs` directory:
- 🗺️ [System Flow & Logic](./docs/flow.md)
- 🗄️ [Database Architecture](./docs/database.md)
- 🧪 [Testing & Results](./docs/pengujian.md)
- 📝 [Project Summary](./docs/ringkasan.md)

---

## 📄 License

The SPK Security System is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
