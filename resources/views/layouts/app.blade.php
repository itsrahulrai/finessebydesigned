<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) - {{ setting('site_tagline', 'Premium Shopping') }}</title>
    <meta name="description" content="@yield('meta_description', setting('meta_description', ''))">
    <meta name="keywords" content="@yield('meta_keywords', setting('meta_keywords', ''))">

    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', '')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Favicon --}}
    <link rel="icon"
        href="{{ setting('site_favicon') ? asset('storage/' . setting('site_favicon')) : asset('images/favicon.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ base_public_url('assets/css/style.css') }}">
    @stack('styles')
    <style>
        /* ============================================================
           NAVBAR SHADOW & PURE WHITE BACKGROUND
        ============================================================ */
        .navbar.navbar-kkt {
            background: #FFFFFF !important;
            border-bottom: 1px solid #E8EDF2 !important;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.08), 0 1px 4px rgba(0, 0, 0, 0.04) !important;
        }

        /* ============================================================
           LUXURY SPLIT-PANE MEGA DROPDOWN (DESKTOP)
        ============================================================ */
        .nav-item.dropdown-mega {
            position: relative;
        }

        .nav-item.dropdown-mega > .nav-link {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            color: var(--kkt-dark) !important;
        }

        .nav-item.dropdown-mega:hover > .nav-link {
            background: rgba(30, 58, 95, 0.06) !important;
            color: var(--kkt-primary) !important;
            border-radius: 14px;
        }

        .nav-item.dropdown-mega > .nav-link.dropdown-toggle::after {
            display: inline-block;
            transition: transform 0.25s ease;
            margin-left: 6px;
            vertical-align: 0.15em;
        }

        .nav-item.dropdown-mega:hover > .nav-link.dropdown-toggle::after {
            transform: rotate(180deg);
        }

        @media (min-width: 992px) {
            .mega-category-dropdown {
                position: absolute !important;
                top: 100% !important;
                left: 0 !important;
                min-width: 760px;
                max-width: 820px;
                background: #FFFFFF !important;
                border: 1px solid #E2E8F0 !important;
                border-radius: 22px !important;
                padding: 0 !important;
                margin-top: 10px !important;
                box-shadow:
                    0 10px 30px rgba(11, 111, 174, 0.08),
                    0 24px 60px rgba(15, 23, 42, 0.12) !important;
                display: none;
                opacity: 0;
                visibility: hidden;
                transform: translateY(12px);
                transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s ease;
                overflow: hidden;
                z-index: 1050;
            }

            .nav-item.dropdown-mega:hover .mega-category-dropdown,
            .nav-item.dropdown-mega .mega-category-dropdown.show {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
            }

            .mega-desktop-wrapper {
                display: flex !important;
                width: 100%;
            }

            .mega-mobile-wrapper {
                display: none !important;
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {
            .mega-category-dropdown {
                left: -60px !important;
                min-width: 700px !important;
                max-width: 720px !important;
            }
        }

        /* Left Rail: Categories */
        .mega-cat-sidebar {
            width: 250px;
            background: #F8FAFC;
            border-right: 1px solid #E8EDF2;
            padding: 14px 10px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            max-height: 520px;
            overflow-y: auto;
        }

        .mega-cat-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .mega-cat-sidebar::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }

        .mega-sidebar-header {
            padding: 4px 12px 10px 12px;
            border-bottom: 1px solid #E8EDF2;
            margin-bottom: 8px;
        }

        .mega-sidebar-title {
            font-family: 'Poppins', sans-serif;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748B;
        }

        .mega-cat-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .mega-cat-item {
            margin: 0;
        }

        .mega-cat-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 14px;
            border-radius: 12px;
            text-decoration: none;
            color: #1E293B;
            font-family: 'Poppins', sans-serif;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .mega-arrow {
            font-size: 11px;
            color: #94A3B8;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .mega-cat-item:hover .mega-cat-link,
        .mega-cat-item.active .mega-cat-link {
            background: #FFFFFF;
            color: #0B6FAE;
            font-weight: 600;
            border-color: rgba(11, 111, 174, 0.25);
            box-shadow: 0 4px 12px rgba(11, 111, 174, 0.08);
        }

        .mega-cat-item:hover .mega-arrow,
        .mega-cat-item.active .mega-arrow {
            color: #0B6FAE;
            transform: translateX(3px);
        }

        /* Right Panel: Subcategories Showcase */
        .mega-subcat-content {
            flex: 1;
            min-width: 0;
            background: #FFFFFF;
            padding: 22px 26px;
            display: flex;
            flex-direction: column;
            max-height: 520px;
            overflow-y: auto;
        }

        .mega-subcat-panel {
            display: none;
            flex-direction: column;
            height: 100%;
        }

        .mega-subcat-panel.active {
            display: flex !important;
            animation: megaFadeIn 0.22s ease-out;
        }

        @keyframes megaFadeIn {
            from {
                opacity: 0;
                transform: translateX(6px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Panel Header */
        .mega-panel-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding-bottom: 12px;
            border-bottom: 1px solid #E8EDF2;
            margin-bottom: 14px;
        }

        .mega-panel-tag {
            font-family: 'Poppins', sans-serif;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #0B6FAE;
            display: block;
            margin-bottom: 2px;
        }

        .mega-panel-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 21px;
            font-weight: 600;
            color: #151B21;
            margin: 0;
            line-height: 1.2;
        }

        .mega-explore-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 12.5px;
            font-weight: 600;
            color: #0B6FAE;
            text-decoration: none;
            transition: gap 0.2s ease, color 0.2s ease;
        }

        .mega-explore-link:hover {
            color: #09446B;
            gap: 9px;
        }

        /* Panel Body & Subcategories Grid */
        .mega-panel-body {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .mega-subcat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 9px;
        }

        .mega-subcat-card {
            display: flex;
            align-items: center;
            padding: 10px 14px;
            background: #F8FAFC;
            border: 1px solid #E8EDF2;
            border-radius: 12px;
            text-decoration: none;
            color: #1E293B;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .mega-subcat-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #0B6FAE;
            opacity: 0.5;
            margin-right: 10px;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .mega-subcat-name {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mega-subcat-icon {
            font-size: 11px;
            color: #94A3B8;
            margin-left: 6px;
            opacity: 0.5;
            transition: transform 0.2s ease, opacity 0.2s ease, color 0.2s ease;
        }

        .mega-subcat-card:hover {
            background: #F0F7FD;
            border-color: rgba(11, 111, 174, 0.4);
            color: #0B6FAE;
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(11, 111, 174, 0.1);
        }

        .mega-subcat-card:hover .mega-subcat-dot {
            opacity: 1;
            background: #0B6FAE;
            box-shadow: 0 0 6px rgba(11, 111, 174, 0.4);
        }

        .mega-subcat-card:hover .mega-subcat-icon {
            opacity: 1;
            color: #0B6FAE;
            transform: translate(2px, -2px);
        }

        /* Banner strip */
        .mega-banner-strip {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 100%);
            border: 1px solid #BAE6FD;
            border-radius: 14px;
            padding: 10px 16px;
            text-decoration: none;
            transition: all 0.25s ease;
            margin-top: 4px;
        }

        .mega-banner-strip:hover {
            background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%);
            border-color: #7DD3FC;
            box-shadow: 0 6px 18px rgba(11, 111, 174, 0.12);
            transform: translateY(-1px);
        }

        .mega-banner-img-wrap {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            overflow: hidden;
            background: #FFFFFF;
            flex-shrink: 0;
            margin-right: 14px;
            border: 1px solid rgba(11, 111, 174, 0.15);
        }

        .mega-banner-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mega-banner-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .mega-banner-eyebrow {
            font-family: 'Poppins', sans-serif;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #0B6FAE;
        }

        .mega-banner-text {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 500;
            color: #1E293B;
        }

        .mega-banner-arrow {
            color: #0B6FAE;
            font-size: 14px;
            margin-left: 10px;
            transition: transform 0.2s ease;
        }

        .mega-banner-strip:hover .mega-banner-arrow {
            transform: translateX(4px);
        }

        /* Empty State */
        .mega-empty-state {
            padding: 24px;
            text-align: center;
            background: #F8FAFC;
            border-radius: 12px;
        }

        .mega-empty-state p {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: #64748B;
            margin-bottom: 12px;
        }

        .mega-viewall-btn {
            background: var(--kkt-primary) !important;
            color: #FFFFFF !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            border-radius: 10px !important;
            padding: 6px 18px !important;
        }

        /* ============================================================
           MOBILE ACCORDION DROPDOWN (< 992px)
        ============================================================ */
        @media (max-width: 991.98px) {
            .nav-item.dropdown-mega {
                width: 100% !important;
                position: relative !important;
            }

            .nav-item.dropdown-mega > .nav-link.dropdown-toggle {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                width: 100% !important;
                padding: 14px 16px !important;
                border-radius: 14px !important;
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
                cursor: pointer !important;
            }

            .nav-item.dropdown-mega > .nav-link.dropdown-toggle::after {
                display: inline-block !important;
                margin-left: auto !important;
                font-size: 14px;
                transition: transform 0.25s ease;
            }

            .nav-item.dropdown-mega.open > .nav-link.dropdown-toggle::after,
            .nav-item.dropdown-mega > .nav-link[aria-expanded="true"]::after {
                transform: rotate(180deg) !important;
            }

            .mega-category-dropdown {
                position: static !important;
                transform: none !important;
                float: none !important;
                width: 100% !important;
                min-width: 100% !important;
                max-width: 100% !important;
                background: #F8FAFC !important;
                border: 1px solid #E2E8F0 !important;
                border-radius: 16px !important;
                box-shadow: none !important;
                padding: 10px !important;
                margin-top: 8px !important;
                margin-bottom: 8px !important;
                display: none !important;
                opacity: 1 !important;
                visibility: visible !important;
            }

            .nav-item.dropdown-mega.open > .mega-category-dropdown,
            .mega-category-dropdown.show {
                display: block !important;
            }

            .mega-desktop-wrapper {
                display: none !important;
            }

            .mega-mobile-wrapper {
                display: block !important;
            }

            .mobile-all-products-btn {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 11px 16px;
                background: linear-gradient(135deg, #0A4F7D 0%, #0B6FAE 100%);
                color: #FFFFFF !important;
                border-radius: 12px;
                text-decoration: none;
                font-family: 'Poppins', sans-serif;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 10px;
                box-shadow: 0 4px 12px rgba(11, 111, 174, 0.2);
            }

            .mobile-all-products-btn span {
                font-size: 12px;
                opacity: 0.9;
            }

            .mobile-cat-accordion {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .mobile-cat-item {
                background: #FFFFFF;
                border: 1px solid #E8EDF2;
                border-radius: 12px;
                overflow: hidden;
                transition: border-color 0.2s ease;
            }

            .mobile-cat-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 14px;
            }

            .mobile-cat-link {
                font-family: 'Poppins', sans-serif;
                font-size: 14px;
                font-weight: 600;
                color: #1E293B;
                text-decoration: none;
                flex: 1;
            }

            .mobile-subcat-toggle {
                background: #F1F5F9;
                border: none;
                width: 36px;
                height: 36px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #475569;
                font-size: 14px;
                transition: transform 0.25s ease, background 0.2s ease, color 0.2s ease;
                padding: 0;
                cursor: pointer;
                flex-shrink: 0;
            }

            .mobile-subcat-toggle:not(.collapsed) {
                transform: rotate(180deg);
                background: #E0F2FE;
                color: #0B6FAE;
            }

            .mobile-subcat-collapse {
                border-top: 1px solid #F1F5F9;
                background: #FAFCFE;
            }

            .mobile-subcat-list {
                list-style: none;
                padding: 8px 12px 10px 12px;
                margin: 0;
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .mobile-subcat-link {
                display: flex;
                align-items: center;
                gap: 8px;
                font-family: 'Poppins', sans-serif;
                font-size: 13px;
                font-weight: 500;
                color: #475569;
                text-decoration: none;
                padding: 8px 10px;
                border-radius: 8px;
                transition: all 0.2s ease;
            }

            .mobile-subcat-link:hover {
                background: #F0F7FD;
                color: #0B6FAE;
            }

            .mobile-subcat-all {
                font-weight: 600;
                color: #0B6FAE;
                border-top: 1px dashed #E2E8F0;
                padding-top: 8px;
                margin-top: 4px;
            }
        }
    </style>
</head>

<body>

    {{-- Top Bar --}}
    <div class="premium-topbar">
        <div class="topbar-left">
            @if(setting('site_email'))
            <a href="mailto:{{ setting('site_email') }}">
                <i class="bi bi-envelope"></i>
              {{ setting('site_email') }}
            </a>
            @endif
             @if(setting('site_phone'))
            <a href="tel:{{ setting('site_phone') }}">
                <i class="bi bi-telephone"></i>
              {{ setting('site_phone') }}
            </a>
            @endif

        </div>

        <div class="topbar-right">
            <span class="follow-label">
                Follow Us
            </span>
            <a href="https://www.facebook.com/">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://www.instagram.com/">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#">
                <i class="bi bi-twitter-x"></i>
            </a>
            <a href="#">
                <i class="bi bi-linkedin"></i>
            </a>
        </div>

    </div>

    <nav class="navbar navbar-expand-lg navbar-kkt py-0">

        <div class="container">

            {{-- LOGO --}}
            <a class="navbar-brand d-flex align-items-center py-0" href="{{ route('home') }}">
                @if (setting('site_logo'))
                    <img src="{{ asset('public/storage/' . setting('site_logo')) }}" alt="{{ config('app.name') }}">
                @else
                   <p>Logo</p>
                @endif

            </a>

            {{-- MOBILE RIGHT --}}
            <div class="mobile-header-actions d-lg-none">

                {{-- Mobile Cart --}}
                <a href="{{ route('cart.index') }}" class="btn btn-light cart-icon mobile-cart-btn" title="Cart">

                    <i class="bi bi-bag"></i>

                    <span class="cart-badge" id="mobile-cart-count">
                        {{ app(\App\Services\CartService::class)->count() }}
                    </span>

                </a>


                {{-- TOGGLER --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">

                    <span class="navbar-toggler-icon"></span>

                </button>

            </div>



            {{-- NAVBAR COLLAPSE --}}
            <div class="collapse navbar-collapse" id="navMain">

                {{-- MENU --}}
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">
                            About
                        </a>
                    </li>

                   @php
                        $categories = \App\Models\Category::with('subcategories')
                            ->orderBy('name')
                            ->get();
                    @endphp
                    <li class="nav-item dropdown-mega">
                        <a class="nav-link dropdown-toggle"
                           href="{{ route('shop') }}"
                           role="button"
                           id="productsMenuToggle"
                           aria-expanded="false">
                            <span>Categories</span>
                        </a>

                        {{-- SINGLE UNIFIED DROPDOWN MENU FOR DESKTOP & MOBILE --}}
                        <div class="mega-category-dropdown">
                            {{-- DESKTOP VIEW (>= 992px) --}}
                            <div class="mega-desktop-wrapper d-none d-lg-flex">
                                {{-- Left Sidebar: Main Categories Rail --}}
                                <div class="mega-cat-sidebar">
                                    <div class="mega-sidebar-header">
                                        <span class="mega-sidebar-title">Categories</span>
                                    </div>
                                    <ul class="mega-cat-list">
                                        @foreach ($categories as $index => $cat)
                                            <li class="mega-cat-item {{ $index === 0 ? 'active' : '' }}"
                                                data-target="mega-panel-{{ $cat->id }}">
                                                <a href="{{ route('shop.category', $cat->slug) }}" class="mega-cat-link">
                                                    <span class="mega-cat-name">{{ $cat->name }}</span>
                                                    @if($cat->subcategories->count())
                                                        <i class="bi bi-chevron-right mega-arrow"></i>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                {{-- Right Content: Subcategories Showcase --}}
                                <div class="mega-subcat-content">
                                    @foreach ($categories as $index => $cat)
                                        <div class="mega-subcat-panel {{ $index === 0 ? 'active' : '' }}" id="mega-panel-{{ $cat->id }}">
                                            {{-- Header --}}
                                            <div class="mega-panel-header">
                                                <div>
                                                    <span class="mega-panel-tag">Collection</span>
                                                    <h4 class="mega-panel-title">{{ $cat->name }}</h4>
                                                </div>
                                                <a href="{{ route('shop.category', $cat->slug) }}" class="mega-explore-link">
                                                    <span>Explore All {{ $cat->name }}</span>
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </div>

                                            {{-- Subcategories Grid --}}
                                            <div class="mega-panel-body">
                                                @if($cat->subcategories->count())
                                                    <div class="mega-subcat-grid">
                                                        @foreach($cat->subcategories as $sub)
                                                            <a href="{{ route('shop.subcategory', ['categorySlug' => $cat->slug, 'subcategorySlug' => $sub->slug]) }}"
                                                               class="mega-subcat-card">
                                                                <span class="mega-subcat-dot"></span>
                                                                <span class="mega-subcat-name">{{ $sub->name }}</span>
                                                                <i class="bi bi-arrow-up-right mega-subcat-icon"></i>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="mega-empty-state">
                                                        <p>Discover our exclusive {{ $cat->name }} collection handcrafted for fine living.</p>
                                                        <a href="{{ route('shop.category', $cat->slug) }}" class="btn btn-sm mega-viewall-btn">
                                                            Shop {{ $cat->name }}
                                                        </a>
                                                    </div>
                                                @endif

                                                {{-- Featured Banner Strip (if category has image) --}}
                                                @if($cat->image)
                                                    <a href="{{ route('shop.category', $cat->slug) }}" class="mega-banner-strip">
                                                        <div class="mega-banner-img-wrap">
                                                            <img src="{{ asset('public/storage/' . $cat->image) }}" alt="{{ $cat->name }}">
                                                        </div>
                                                        <div class="mega-banner-info">
                                                            <span class="mega-banner-eyebrow">Handcrafted Luxury</span>
                                                            <span class="mega-banner-text">View curated {{ strtolower($cat->name) }} designs</span>
                                                        </div>
                                                        <i class="bi bi-arrow-right mega-banner-arrow"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- MOBILE VIEW (< 992px) --}}
                            <div class="mega-mobile-wrapper d-lg-none">
                                {{-- Direct Link to All Products --}}
                                <a href="{{ route('shop') }}" class="mobile-all-products-btn">
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="bi bi-grid"></i>
                                        <strong>All Products</strong>
                                    </span>
                                    <span>Explore Catalog &rarr;</span>
                                </a>

                                <div class="mobile-cat-accordion">
                                    @foreach ($categories as $cat)
                                        <div class="mobile-cat-item">
                                            <div class="mobile-cat-row">
                                                <a href="{{ route('shop.category', $cat->slug) }}" class="mobile-cat-link">
                                                    {{ $cat->name }}
                                                </a>
                                                @if($cat->subcategories->count())
                                                    <button type="button"
                                                            class="mobile-subcat-toggle collapsed"
                                                            data-subcat-target="#mob-sub-{{ $cat->id }}"
                                                            aria-expanded="false"
                                                            aria-label="Toggle {{ $cat->name }} subcategories">
                                                        <i class="bi bi-chevron-down"></i>
                                                    </button>
                                                @endif
                                            </div>

                                            @if($cat->subcategories->count())
                                                <div class="collapse mobile-subcat-collapse" id="mob-sub-{{ $cat->id }}">
                                                    <ul class="mobile-subcat-list">
                                                        @foreach($cat->subcategories as $sub)
                                                            <li>
                                                                <a href="{{ route('shop.subcategory', ['categorySlug' => $cat->slug, 'subcategorySlug' => $sub->slug]) }}"
                                                                   class="mobile-subcat-link">
                                                                    <i class="bi bi-dash"></i>
                                                                    <span>{{ $sub->name }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                        <li>
                                                            <a href="{{ route('shop.category', $cat->slug) }}" class="mobile-subcat-link mobile-subcat-all">
                                                                <i class="bi bi-arrow-right"></i>
                                                                <span>View All {{ $cat->name }}</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">
                            Shops
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">
                            Blogs
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>



                {{-- RIGHT SIDE --}}
                <div class="mobile-auth-buttons">

                    {{-- Wishlist --}}
                    @auth
                        <a href="{{ route('wishlist.index') }}" class="btn btn-light cart-icon" title="Wishlist">

                            <i class="bi bi-heart"></i>

                        </a>
                    @endauth


                    {{-- DESKTOP CART --}}
                    <a href="{{ route('cart.index') }}" class="btn btn-light cart-icon desktop-cart" title="Cart">

                        <i class="bi bi-bag"></i>

                        <span class="cart-badge"  id="desktop-cart-count">
                            {{ app(\App\Services\CartService::class)->count() }}
                        </span>

                    </a>



                    {{-- USER --}}
                    @auth

                        <div class="dropdown">

                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                <i class="bi bi-person-circle me-1"></i>

                                {{ Str::words(Auth::user()->name, 1, '') }}

                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item" href="{{ route('account.dashboard') }}">

                                        <i class="bi bi-speedometer2 me-2"></i>

                                        Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('account.orders') }}">

                                        <i class="bi bi-box me-2"></i>

                                        Orders
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('account.profile') }}">

                                        <i class="bi bi-person me-2"></i>

                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">

                                        @csrf

                                        <button class="dropdown-item text-danger">

                                            <i class="bi bi-box-arrow-right me-2"></i>

                                            Logout

                                        </button>

                                    </form>
                                </li>

                            </ul>

                        </div>
                    @else
                        {{-- LOGIN --}}
                        <a href="{{ route('login') }}" class="btn btn-outline-pink">

                            Login

                        </a>


                        {{-- REGISTER --}}
                        <a href="{{ route('register') }}" class="btn btn-primary">

                            Join & Shop

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>

    {{-- Flash Messages --}}
    @if (session('success') || session('error'))
        <div class="toast-container">
            <div class="toast show align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0"
                role="alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') ?? session('error') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    @yield('content')
    
  <footer class="gw-footer">

    {{-- Trust badges --}}
    <div class="gw-trust">
        <div class="container">
            <div class="gw-trust-row">
                <div class="gw-trust-item">
                    <div class="gw-trust-icon-wrap">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="gw-trust-text">
                        <h6 class="gw-trust-title">100% Handcrafted</h6>
                        <span class="gw-trust-sub">Premium Brass &amp; Silver Plated</span>
                    </div>
                </div>
                <div class="gw-trust-item">
                    <div class="gw-trust-icon-wrap">
                        <i class="bi bi-gem"></i>
                    </div>
                    <div class="gw-trust-text">
                        <h6 class="gw-trust-title">Authentic &amp; Vintage Designs</h6>
                        <span class="gw-trust-sub">Timeless Metal Handicrafts</span>
                    </div>
                </div>
                <div class="gw-trust-item">
                    <div class="gw-trust-icon-wrap">
                        <i class="bi bi-truck"></i>
                    </div>
                    <div class="gw-trust-text">
                        <h6 class="gw-trust-title">Safe &amp; Secure Packaging</h6>
                        <span class="gw-trust-sub">Delivered with Care</span>
                    </div>
                </div>
                <div class="gw-trust-item">
                    <div class="gw-trust-icon-wrap">
                        <i class="bi bi-gift"></i>
                    </div>
                    <div class="gw-trust-text">
                        <h6 class="gw-trust-title">Perfect for Gifting</h6>
                        <span class="gw-trust-sub">Weddings, Corporate &amp; More</span>
                    </div>
                </div>
                <div class="gw-trust-item">
                    <div class="gw-trust-icon-wrap">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="gw-trust-text">
                        <h6 class="gw-trust-title">Quality You Can Trust</h6>
                        <span class="gw-trust-sub">Handmade with Excellence</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="gw-cols">

            {{-- About --}}
            <div class="gw-col gw-brand">
                <a href="{{ route('home') }}" class="gw-logo">
                    @if (setting('site_logo'))
                        <img src="{{ asset('public/storage/' . setting('site_logo')) }}" alt="{{ config('app.name') }}">
                    @else
                        <img src="{{ base_public_url('assets/img/kkt.png') }}" alt="{{ config('app.name') }}">
                    @endif
                </a>
                <p>{{ setting('site_tagline', 'Finesse By Design is a trusted manufacturer and exporter of premium brass, silver-plated, and luxury handcrafted tableware — delivering timeless elegance across India and worldwide.') }}</p>
            </div>

            {{-- Quick Links --}}
            <div class="gw-col">
                <h6>Quick Links</h6>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Product Categories --}}
           <div class="gw-col">
                    <h6>Categories</h6>
                    @php
                        $categories = \App\Models\Category::orderBy('name')
                                        ->take(6)
                                        ->get();
                    @endphp

                    <ul>
                        @forelse($categories as $category)
                            <li>
                                <a href="{{ route('shop', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @empty
                            <li>No categories found.</li>
                        @endforelse
                    </ul>
                </div>

            {{-- Customer Support --}}
            <div class="gw-col">
                <h6>Useful Links</h6>
                <ul>
                    @if($footerPages && $footerPages->count())
                        @foreach($footerPages as $page)
                            <li><a href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Contact --}}
            <div class="gw-col">
                <h6>Contact Us</h6>
                <ul class="gw-contact">
                    <li><i class="bi bi-geo-alt-fill"></i> {{ setting('site_address', 'Address') }}</li>
                    @if(setting('site_phone'))
                    <li><i class="bi bi-telephone-fill"></i> <a href="tel:{{ setting('site_phone') }}">{{ setting('site_phone') }}</a></li>
                    @endif
                    @if(setting('site_email'))
                    <li><i class="bi bi-envelope-fill"></i> <a href="mailto:{{ setting('site_email') }}">{{ setting('site_email') }}</a></li>
                    @endif
                </ul>
            </div>

        </div>

    </div>

    {{-- Bottom --}}
    <div class="gw-bottom">
        <div class="container">
            <div class="gw-bottom-inner">
                <div class="gw-copy">© {{ date('Y') }} {{ setting('site_name', 'Finesse By Design') }}. All Rights Reserved.</div>

                
        {{-- Social --}}
       
                <div class="gw-pay">
                    
            <div class="gw-social">
                <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
                <a href="#"><i class="bi bi-whatsapp"></i></a>
            </div>
        
                </div>
            </div>
        </div>
    </div>

</footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // CSRF setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Auto-dismiss toasts
        setTimeout(() => {
            document.querySelectorAll('.toast').forEach(t => new bootstrap.Toast(t, {
                autohide: true,
                delay: 3500
            }).hide());
        }, 3500);

        // AJAX Search
        let searchTimeout;
        $('#search-input').on('input', function() {
            const q = $(this).val().trim();
            clearTimeout(searchTimeout);
            if (q.length < 2) {
                $('#search-results-dropdown').addClass('d-none').empty();
                return;
            }
            searchTimeout = setTimeout(() => {
                $.get('{{ route('search.ajax') }}', {
                    q
                }, function(data) {
                    const $d = $('#search-results-dropdown');
                    if (!data.length) {
                        $d.addClass('d-none');
                        return;
                    }
                    let html = data.map(p => `
                <a href="${p.url}" class="search-item">
                    <img src="${p.image}" alt="${p.name}">
                    <div><div style="font-size:.88rem;font-weight:600;">${p.name}</div>
                    <div style="color:var(--kkt-primary);font-weight:700;">₹ ${Math.round(parseFloat(p.price)).toLocaleString('en-IN')}</div></div>
                </a>`).join('');
                    $d.html(html).removeClass('d-none');
                });
            }, 300);
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('form').length) $('#search-results-dropdown').addClass('d-none');
        });

        // Shared helper: keep the navbar cart badges (mobile + desktop) in sync
        // instantly, without needing a page refresh. Any add/remove/update flow
        // anywhere in the app should call this with the fresh count from the server.
        window.updateCartCount = function(count) {
            $('#mobile-cart-count').text(count);
            $('#desktop-cart-count').text(count);
        };

        // Add to Cart AJAX (product listing / category / wishlist cards).
        // The product detail page (products/show.blade.php) has its own handler
        // with a loading spinner on the button, so we skip delegating to this one
        // there to avoid submitting the request twice.
        $(document).on('click', '.btn-add-to-cart:not(#main-add-to-cart)', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.attr('data-product-id');
            const variantId = btn.attr('data-variant-id') || null;
            const qty = parseInt($('#qty-input').val() || 1);

            $.post('{{ route('cart.add') }}', {
                    product_id: productId,
                    product_variant_id: variantId,
                    quantity: qty
                })
                 .done(res => {
                    if (res.success) {
                        window.updateCartCount(res.count);
                        showToast(res.message, 'success');
                    }
                })
                .fail(() => showToast('Failed to add product to cart', 'danger'));
        });

        // Wishlist toggle
        $(document).on('click', '.btn-wishlist', function(e) {
            e.preventDefault();
            @guest
            return;
        @endguest
        const btn = $(this); $.post('{{ route('wishlist.toggle') }}', {
            product_id: btn.data('product-id')
        })
        .done(res => {
            if (res.success) {
                btn.toggleClass('wishlisted', res.inWishlist);
                btn.find('i').toggleClass('bi-heart', !res.inWishlist).toggleClass('bi-heart-fill', res
                    .inWishlist);
                showToast(res.message, res.inWishlist ? 'success' : 'warning');
            }
        });
        });

        function showToast(msg, type = 'success') {
            const id = 'toast-' + Date.now();
            const bg = type === 'success' ? 'bg-success' : (type === 'danger' ? 'bg-danger' : 'bg-warning text-dark');
            const html =
                `<div id="${id}" class="toast show align-items-center text-white ${bg} border-0 mb-2" role="alert">
        <div class="d-flex"><div class="toast-body">${msg}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div></div>`;
            let container = document.querySelector('.toast-container');
            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container';
                document.body.appendChild(container);
            }
            container.insertAdjacentHTML('beforeend', html);
            setTimeout(() => document.getElementById(id)?.remove(), 3500);
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script>
        (function() {
            'use strict';
         const REELS = [
        {id:1, videoId:'uAmxdUDmJKw'},
        {id:2, videoId:'bIqAijsjH08'},
        {id:3, videoId:'Aw6QwM01kG8'},
        {id:4, videoId:'rIuwqzQO_xQ'},
        {id:5, videoId:'3P10tqraZsg'},
        { id: 6, videoId: 'lseFh9qG3g8'}
        ];

            /* ============================================================
               2. DOM REFS
            ============================================================ */
            const phoneScreen = document.querySelector('.rs-screen');
            const stripSlides = document.querySelectorAll('.rs-strip-slide');
            const stripCards = document.querySelectorAll('.rs-strip-card');

            /* Phone screen elements */
            const elMainVideo = document.getElementById('rsMainVideo');
            const elProdCat = document.querySelector('.rs-prod-cat');
            const elProdName = document.querySelector('.rs-prod-name');
            const elProdPrice = document.querySelector('.rs-prod-price');
            const elLikes = document.querySelectorAll('.rs-action-btn')[0]?.querySelector('p');
            const elComments = document.querySelectorAll('.rs-action-btn')[1]?.querySelector('p');

            /* ============================================================
               3. UPDATE PHONE with selected reel data
            ============================================================ */
            function updatePhone(index) {
                const reel = REELS[index];
                if (!reel) return;

                /* ---- Update placeholder / video ---- */
                if (elMainVideo) {
                    
                   const frame = document.getElementById('rsYoutubeFrame');
                        if(frame){

                           frame.src =
                            'https://www.youtube-nocookie.com/embed/' +
                            reel.videoId +
                            '?autoplay=1&mute=1&controls=0&playsinline=1';

                        }
                        
                }

                /* ---- Animate screen transition ---- */
                if (phoneScreen) {
                    phoneScreen.style.opacity = '0';
                    phoneScreen.style.transform = 'scale(0.97)';
                    setTimeout(function() {
                        phoneScreen.style.transition = 'opacity .35s ease, transform .35s ease';
                        phoneScreen.style.opacity = '1';
                        phoneScreen.style.transform = 'scale(1)';
                    }, 80);
                }
            }

            /* ============================================================
               4. SET ACTIVE CARD
            ============================================================ */
            function setActiveCard(index) {
                stripCards.forEach(function(card, i) {
                    if (i === index) {
                        card.classList.add('rs-active-card');
                    } else {
                        card.classList.remove('rs-active-card');
                    }
                });
                updatePhone(index);
            }

            /* ============================================================
               5. CLICK HANDLERS on strip cards
            ============================================================ */
            stripCards.forEach(function(card, i) {
                card.addEventListener('click', function() {
                    setActiveCard(i);
                    /* If swiper exists, slide to that index */
                    if (window._rsSwiper) {
                        window._rsSwiper.slideTo(i);
                    }
                });
            });

            /* ============================================================
               6. SWIPER — Vertical strip (auto-advances every 3s)
            ============================================================ */
            document.addEventListener('DOMContentLoaded', function() {

                /* Detect tablet/mobile for direction */
                const isMobile = window.innerWidth <= 900;

                window._rsSwiper = new Swiper('#rsStripSwiper', {
                    direction: isMobile ? 'horizontal' : 'vertical',
                    slidesPerView: isMobile ? 1.4 : 5,
                    spaceBetween: 16,
                    loop: !isMobile,
                    speed: isMobile ? 600 : 900,
                    grabCursor: true,
                    freeMode: isMobile,
                    centeredSlides: false,
                    autoplay: isMobile ? false : {
                        delay: 2000,
                        disableOnInteraction: false
                    },
                    mousewheel: false,
                    on: {
                        slideChange: function () {
                            const idx = this.realIndex % REELS.length;
                            setActiveCard(idx);
                        }
                    }

                });

                /* Initial state */
                setActiveCard(0);

                /* ---- Pause autoplay when user hovers the phone ---- */
                const phoneEl = document.getElementById('rsPhone');
                if (phoneEl && window._rsSwiper) {
                    phoneEl.addEventListener('mouseenter', function() {
                        window._rsSwiper.autoplay.stop();
                    });
                    phoneEl.addEventListener('mouseleave', function() {
                        window._rsSwiper.autoplay.start();
                    });
                }
            });

            /* ============================================================
               7. RESIZE HANDLER — re-init swiper direction on breakpoint
            ============================================================ */
            let _resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(_resizeTimer);
                _resizeTimer = setTimeout(function() {
                    if (window._rsSwiper) {
                        window._rsSwiper.destroy(true, true);
                    }
                    const isMob = window.innerWidth <= 900;
                    window._rsSwiper = new Swiper('#rsStripSwiper', {
                        direction: isMob ? 'horizontal' : 'vertical',
                      slidesPerView: isMob ? 1.4 : 5,
                       slidesPerView: isMob ? 1.4 : 5,
                            spaceBetween: 16,
                            loop: !isMob,
                            freeMode: isMob,
                            speed: isMob ? 600 : 900,
                        autoplay: {
                            delay: 8000,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true,
                        },
                        on: {
                            slideChange: function() {
                                const idx = this.realIndex % REELS.length;
                                setActiveCard(idx);
                            }
                        }
                    });
                }, 250);
            });

        })();

        /* ============================================================
           MEGA MENU HANDLERS (DESKTOP HOVER + MOBILE TOGGLE & ACCORDION)
        ============================================================ */
        (function() {
            function switchMegaCategory(item) {
                if (!item) return;
                var targetId = item.getAttribute('data-target');
                if (!targetId) return;

                // Update sidebar items
                document.querySelectorAll('.mega-cat-item').forEach(function(el) {
                    el.classList.remove('active');
                });
                item.classList.add('active');

                // Update right panels
                document.querySelectorAll('.mega-subcat-panel').forEach(function(panel) {
                    panel.classList.remove('active');
                });
                var targetPanel = document.getElementById(targetId);
                if (targetPanel) {
                    targetPanel.classList.add('active');
                }
            }

            // Desktop category hover listeners
            document.addEventListener('mouseover', function(e) {
                if (window.innerWidth < 992) return;
                var item = e.target.closest('.mega-cat-item');
                if (item) {
                    switchMegaCategory(item);
                }
            }, true);

            if (window.jQuery) {
                $(document).on('mouseenter mouseover', '.mega-cat-item', function() {
                    if (window.innerWidth >= 992) {
                        switchMegaCategory(this);
                    }
                });
            }

            // Helper to toggle mobile products dropdown
            function toggleMobileProducts(e) {
                if (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                var megaItem = document.querySelector('.nav-item.dropdown-mega');
                var toggleBtn = document.getElementById('productsMenuToggle');
                var megaMenu = document.querySelector('.mega-category-dropdown');
                if (!megaItem || !megaMenu) return;

                var willOpen = !megaItem.classList.contains('open');
                megaItem.classList.toggle('open', willOpen);
                megaMenu.classList.toggle('show', willOpen);
                if (toggleBtn) {
                    toggleBtn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
                }
            }

            // Click listener
            document.addEventListener('click', function(e) {
                var isMobile = window.innerWidth < 992;

                // 1. Tapping "Products" toggle button on mobile
                var toggle = e.target.closest('#productsMenuToggle');
                if (toggle && isMobile) {
                    toggleMobileProducts(e);
                    return;
                }

                // 2. Tapping subcategory accordion toggle button on mobile
                var subcatBtn = e.target.closest('.mobile-subcat-toggle');
                if (subcatBtn && isMobile) {
                    e.preventDefault();
                    e.stopPropagation();
                    var targetId = subcatBtn.getAttribute('data-subcat-target') || subcatBtn.getAttribute('data-bs-target');
                    if (targetId) {
                        var targetPanel = document.querySelector(targetId);
                        if (targetPanel) {
                            if (window.jQuery) {
                                $(targetPanel).slideToggle(200);
                            } else {
                                targetPanel.classList.toggle('show');
                            }
                            subcatBtn.classList.toggle('collapsed');
                            var isExp = !subcatBtn.classList.contains('collapsed');
                            subcatBtn.setAttribute('aria-expanded', isExp ? 'true' : 'false');
                        }
                    }
                    return;
                }

                // 3. Tapping inside the mobile mega dropdown
                var insideMega = e.target.closest('.mega-category-dropdown');
                if (insideMega && isMobile) {
                    // If tapped on an <a> tag, allow normal navigation to proceed
                    if (e.target.closest('a')) {
                        return;
                    }
                    // Prevent closing dropdown when tapping inside container
                    e.stopPropagation();
                    return;
                }

                // 4. Tapping outside closes the mobile products dropdown
                if (isMobile) {
                    var openMegaItem = document.querySelector('.nav-item.dropdown-mega.open');
                    if (openMegaItem) {
                        openMegaItem.classList.remove('open');
                        var openMenu = openMegaItem.querySelector('.mega-category-dropdown');
                        if (openMenu) openMenu.classList.remove('show');
                        var btn = document.getElementById('productsMenuToggle');
                        if (btn) btn.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
