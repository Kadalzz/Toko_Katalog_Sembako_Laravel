<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Sembako Online - Belanja Kebutuhan Sehari-hari')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
        }

        /* Top Bar */
        .top-bar {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            color: white;
            padding: 0.5rem 0;
            text-align: center;
            font-size: 0.9rem;
        }

        /* Navigation */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-main {
            padding: 1.25rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .navbar-brand {
            color: #2e7d32;
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            white-space: nowrap;
        }

        .navbar-search {
            flex: 1;
            max-width: 600px;
        }

        .navbar-search form {
            position: relative;
        }

        .navbar-search input {
            width: 100%;
            padding: 0.85rem 1.25rem;
            border: 2px solid #e0e0e0;
            border-radius: 30px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .navbar-search input:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        .navbar-actions {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .navbar-actions a {
            color: #2e7d32;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .navbar-actions a span {
            font-size: 1.5rem;
        }

        .navbar-actions a:hover {
            color: #1b5e20;
        }

        .navbar-menu {
            background: #f5f5f5;
            border-top: 1px solid #e0e0e0;
        }

        .navbar-nav {
            padding: 0.85rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .navbar-nav ul {
            display: flex;
            list-style: none;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            color: #2e7d32;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Hero Banner */
        .hero-banner {
            position: relative;
            height: 450px;
            margin: 2rem 0;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
        }

        .hero-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateY(-50%);
            color: white;
            z-index: 2;
            max-width: 500px;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            opacity: 0.95;
        }

        .hero-btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: white;
            color: #2e7d32;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        /* Featured Grid */
        .featured-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin: 3rem 0;
        }

        .featured-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .featured-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .featured-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .featured-card-content {
            padding: 1.5rem;
            text-align: center;
        }

        .featured-card-content h3 {
            color: #2e7d32;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .featured-btn {
            display: inline-block;
            padding: 0.65rem 1.75rem;
            background: #2e7d32;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .featured-btn:hover {
            background: #1b5e20;
        }

        /* Category Icons */
        .category-section {
            margin: 4rem 0;
        }

        .category-section h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1.5rem;
        }

        .category-item {
            background: white;
            padding: 2rem 1rem;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .category-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            background: #f8f8f8;
        }

        .category-icon {
            font-size: 3rem;
            margin-bottom: 0.75rem;
        }

        .category-name {
            font-weight: 500;
            font-size: 0.95rem;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-image-placeholder {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .product-body {
            padding: 1.25rem;
        }

        .product-category {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .product-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            color: #333;
            min-height: 50px;
        }

        .product-price {
            color: #2e7d32;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }

        .product-stock {
            margin-bottom: 1rem;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: #2e7d32;
            color: white;
        }

        .btn-primary:hover {
            background: #1b5e20;
        }

        .btn-success {
            background: #2e7d32;
            color: white;
        }

        .btn-success:hover {
            background: #1b5e20;
        }

        .btn-block {
            width: 100%;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }

        /* Form Controls */
        .form-control, .form-select {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .error-message {
            color: #c62828;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .is-invalid {
            border-color: #c62828 !important;
        }

        /* Search Filter */
        .search-filter {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .search-filter form {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 1rem;
            align-items: center;
        }

        /* Badge */
        .badge {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-warning {
            background: #fff3e0;
            color: #ef6c00;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 3rem;
            margin-bottom: 2rem;
        }

        .pagination nav {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .pagination a, .pagination span {
            padding: 0.65rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 45px;
            font-weight: 500;
        }

        .pagination a:hover {
            background: #e8f5e9;
            border-color: #2e7d32;
            color: #2e7d32;
        }

        .pagination svg {
            width: 16px;
            height: 16px;
        }

        .pagination .disabled span {
            color: #ccc;
            cursor: not-allowed;
            background: #f5f5f5;
        }

        .pagination span[aria-current="page"] {
            background: #2e7d32;
            color: white;
            border-color: #2e7d32;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #999;
        }

        .empty-state-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
        }

        /* Footer */
        .footer {
            background: #1b5e20;
            color: white;
            text-align: center;
            padding: 2.5rem 2rem;
            margin-top: 4rem;
        }

        .footer p {
            margin-bottom: 0.5rem;
        }

        .footer a {
            color: white;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .category-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 992px) {
            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }

            .navbar-search {
                max-width: 100%;
            }

            .featured-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .category-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-nav ul {
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }

            .featured-grid, .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-banner {
                height: 350px;
            }

            .hero-content {
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                width: 90%;
            }

            .hero-content h1 {
                font-size: 1.8rem;
            }

            .search-filter form {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .featured-grid, .product-grid, .category-grid {
                grid-template-columns: 1fr;
            }

            .navbar-actions {
                gap: 1rem;
            }

            .container {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        📞 Hubungi Kami: 082142388292 | 📧 Email: info@tokosembako.com | 🚚 Gratis Ongkir untuk Pembelian di Atas Rp 100.000
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-main">
            <div class="navbar-container">
                <a href="{{ route('public.index') }}" class="navbar-brand">
                    🛒 Toko Sembako Online
                </a>
                
                <div class="navbar-search">
                    <form method="GET" action="{{ route('public.index') }}">
                        <input type="text" name="search" placeholder="🔍 Cari produk kebutuhan sehari-hari..." value="{{ request('search') }}">
                    </form>
                </div>

                <div class="navbar-actions">
                    <a href="{{ route('login') }}">
                        <span>👤</span>
                        Login Admin
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-menu">
            <div class="navbar-nav">
                <ul>
                    <li><a href="{{ route('public.index') }}" class="nav-link">🏠 Beranda</a></li>
                    <li><a href="#produk" class="nav-link">🛍️ Semua Produk</a></li>
                    <li><a href="#kategori" class="nav-link">📦 Kategori</a></li>
                    <li><a href="#kontak" class="nav-link">📞 Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer id="kontak" class="footer">
        <p><strong>Toko Sembako Online</strong> - Belanja Kebutuhan Sehari-hari Jadi Lebih Mudah</p>
        <p>📍 Alamat: Jalan Kusuma 815B | 📞 Telp: 082142388292</p>
        <p style="margin-top: 1rem; opacity: 0.8;">&copy; {{ date('Y') }} Toko Sembako Online Richard. All Rights Reserved.</p>
    </footer>
</body>
</html>
