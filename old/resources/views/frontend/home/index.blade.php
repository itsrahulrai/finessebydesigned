@extends('layouts.app')
@section('title', setting('site_name', 'Sanni Cad Cam'))

@section('content')

    {{-- Hero Slider --}}
    @if ($banners->count())

        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            {{-- Indicators --}}
            <div class="carousel-indicators">
                @foreach ($banners as $i => $banner)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                        class="{{ $i === 0 ? 'active' : '' }}">
                    </button>
                @endforeach
            </div>

            {{-- Slides --}}
            <div class="carousel-inner">

                @foreach ($banners as $i => $banner)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">

                        @if ($banner->link)
                            <a href="{{ $banner->link }}">
                        @endif

                        {{-- Desktop Image --}}
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                            class="w-100 d-none d-md-block hero-banner-img">

                        {{-- Mobile Image --}}
                        <img src="{{ $banner->mobile_image ? asset('public/storage/' . $banner->mobile_image) : $banner->image_url }}"
                            alt="{{ $banner->title }}" class="w-100 d-block d-md-none hero-banner-mobile-img">

                        @if ($banner->link)
                            </a>
                        @endif

                    </div>
                @endforeach

            </div>

            {{-- Controls --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">

                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">

                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    @else
        {{-- Default Banner --}}
        <div class="hero-default-banner">

            {{-- Desktop --}}
            <img src="{{ base_public_url('assets/img/dummy.png') }}" alt="Banner"
                class="w-100 d-none d-md-block hero-banner-img">

            {{-- Mobile --}}
            <img src="{{ base_public_url('assets/img/dummy.png') }}" alt="Banner"
                class="w-100 d-block d-md-none hero-banner-mobile-img">

        </div>

    @endif





    @if ($featuredCategories->count())

    <section class="cat-slide-section">
        <div class="container-fluid px-lg-5">
            {{-- Header Section --}}
            <div class="cat-section-header">
                {{-- Center Content --}}
                <div class="cat-header-content text-center">
                    <div class="cat-explore-tag">
                        <span class="tag-line"></span>
                        <span class="tag-text">EXPLORE OUR RANGE</span>
                        <span class="tag-line"></span>
                    </div>
                    <h2 class="cat-main-heading">
                        Shop by <span class="cat-heading-accent">Category</span>
                    </h2>
                    <p class="cat-desc">
                        Discover thoughtfully curated collections for every occasion, because every gift tells a story.
                    </p>
                </div>
            </div>

            {{-- Slider Container --}}
            <div class="cat-swiper-outer">
                <button type="button" class="cat-nav-btn cat-prev" aria-label="Previous categories">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="swiper cat-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($featuredCategories as $cat)
                            <div class="swiper-slide">
                                <a href="{{ route('shop.category', $cat->slug) }}" class="cat-arch-card">
                                    <div class="cat-arch-inner">
                                        <div class="cat-arch-frame">
                                            <div class="cat-arch-img-wrap">
                                                @if ($cat->image)
                                                    <img src="{{ $cat->image_url }}" alt="{{ $cat->name }}" class="cat-arch-img" loading="lazy">
                                                @else
                                                    <img src="{{ base_public_url('assets/img/no-category.jpg') }}" alt="{{ $cat->name }}" class="cat-arch-img" loading="lazy">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="cat-arch-info">
                                            <h6 class="cat-arch-name">{{ $cat->name }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="cat-nav-btn cat-next" aria-label="Next categories">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    @once
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Swiper('.cat-swiper', {
                    slidesPerView: 8,
                    spaceBetween: 14,
                    navigation: {
                        nextEl: '.cat-next',
                        prevEl: '.cat-prev',
                    },
                    breakpoints: {
                        0:    { slidesPerView: 2.3, spaceBetween: 10 },
                        420:  { slidesPerView: 2.7, spaceBetween: 10 },
                        576:  { slidesPerView: 3.4, spaceBetween: 12 },
                        768:  { slidesPerView: 4.4, spaceBetween: 12 },
                        992:  { slidesPerView: 5.5, spaceBetween: 14 },
                        1200: { slidesPerView: 6.8, spaceBetween: 14 },
                        1400: { slidesPerView: 8,   spaceBetween: 14 },
                    }
                });
            });
        </script>
    @endonce

@endif




    {{-- Featured Products --}}
    @php
        $homeFeatured = (isset($featuredProducts) && $featuredProducts->count()) ? $featuredProducts : $trendingProducts;
    @endphp
    @if ($homeFeatured && $homeFeatured->count())
        <section class="py-5" style="
            background: radial-gradient(circle at 80% 20%, rgba(17,140,196,0.05), transparent 45%),
                        radial-gradient(circle at 10% 80%, rgba(11,111,174,0.04), transparent 40%),
                        linear-gradient(180deg, #FFFFFF 0%, #F6F9FB 100%);
            position: relative;
        ">
            <div class="container">
                <div class="position-relative mb-4">
                    <div class="section-luxury-header mb-0">
                        <div class="section-luxury-header-content">
                            <div class="sec-explore-tag">
                                <span class="tag-line"></span>
                                <span class="tag-text">CRAFTED FOR A BETTER TOMORROW</span>
                                <span class="tag-line"></span>
                            </div>
                            <h2 class="sec-main-heading">
                                Featured <span class="sec-heading-accent">Products</span>
                            </h2>
                            <p class="sec-desc">
                                Handpicked pieces to elevate your everyday moments
                            </p>
                        </div>
                    </div>
                    <div class="d-none d-md-block position-absolute end-0 top-50 translate-middle-y">
                        <a href="{{ route('shop') }}" class="btn-luxury-viewall">
                            <span>View All</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-3">
                    @foreach ($homeFeatured as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="text-center mt-4 d-md-none">
                    <a href="{{ route('shop') }}" class="btn-luxury-viewall">
                        <span>View All Products</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif
   
    {{-- Flash Sale / Special Offers --}}
    @if ($saleProducts->count())
        <section class="py-5" style="background: #FFFFFF;">
            <div class="container"> 
                <div class="section-luxury-header mb-4">
                    <div class="section-luxury-header-content">
                        <div class="sec-explore-tag">
                            <span class="tag-line"></span>
                            <span class="tag-text">CURATED SELECTION</span>
                            <span class="tag-line"></span>
                        </div>
                        <h2 class="sec-main-heading">
                            Special <span class="sec-heading-accent">Offers</span>
                        </h2>
                        <p class="sec-desc">
                            Carefully selected signature pieces at exceptional prices.
                        </p>
                    </div>
                </div>
                <div class="row g-3">
                    @foreach ($saleProducts as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- New Arrivals --}}
    @if ($newArrivals->count())
        <section class="py-5" style="
            background: radial-gradient(circle at top right, rgba(17,140,196,.05), transparent 30%),
                        linear-gradient(180deg, #FFFFFF 0%, #F6F9FB 100%);
        ">
            <div class="container">
                <div class="section-luxury-header mb-4">
                    <div class="section-luxury-header-content">
                        <div class="sec-explore-tag">
                            <span class="tag-line"></span>
                            <span class="tag-text">LATEST COLLECTION</span>
                            <span class="tag-line"></span>
                        </div>
                        <h2 class="sec-main-heading">
                            New <span class="sec-heading-accent">Arrivals</span>
                        </h2>
                        <p class="sec-desc">
                            Freshly crafted additions to our luxury tableware and barware collection.
                        </p>
                    </div>
                </div>

                <div class="row g-3">
                    @foreach ($newArrivals as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Best Sellers --}}
    @if ($bestSellers->count())
        <section class="py-5" style="background: #FFFFFF;">
            <div class="container">
                <div class="section-luxury-header mb-4">
                    <div class="section-luxury-header-content">
                        <div class="sec-explore-tag">
                            <span class="tag-line"></span>
                            <span class="tag-text">CUSTOMER FAVORITES</span>
                            <span class="tag-line"></span>
                        </div>
                        <h2 class="sec-main-heading">
                            Best <span class="sec-heading-accent">Sellers</span>
                        </h2>
                        <p class="sec-desc">
                            Most admired and frequently chosen signature pieces.
                        </p>
                    </div>
                </div>

                <div class="row g-3">
                    @foreach ($bestSellers as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Latest Blog / Articles --}}
    @if ($latestBlogs->count())
        <section class="py-5" style="
            background: radial-gradient(circle at bottom left, rgba(17,140,196,.04), transparent 30%),
                        linear-gradient(180deg, #FFFFFF 0%, #F6F9FB 100%);
        ">
            <div class="container">
                <div class="section-luxury-header mb-4">
                    <div class="section-luxury-header-content">
                        <div class="sec-explore-tag">
                            <span class="tag-line"></span>
                            <span class="tag-text">STORIES & INSPIRATION</span>
                            <span class="tag-line"></span>
                        </div>
                        <h2 class="sec-main-heading">
                            Latest <span class="sec-heading-accent">Articles</span>
                        </h2>
                        <p class="sec-desc">
                            Explore stories of timeless craftsmanship, design inspiration, and luxury living.
                        </p>
                    </div>
                </div>
                <div class="row g-3">
                    @foreach ($latestBlogs as $blog)
                        <div class="col-md-4">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none">
                                <div style="border-radius:18px;overflow:hidden;border:1px solid #E8EDF2;background:#fff;transition:all .3s ease;box-shadow:0 4px 16px rgba(21,27,33,.05);"
                                    onmouseover="this.style.boxShadow='0 12px 30px rgba(11,111,174,.15)';this.style.transform='translateY(-6px)'"
                                    onmouseout="this.style.boxShadow='0 4px 16px rgba(21,27,33,.05)';this.style.transform='none'">
                                    <img src="{{ $blog->thumbnail_url }}"
                                        style="width:100%;height:200px;object-fit:cover;" alt="{{ $blog->title }}">
                                    <div class="p-4">
                                        <div
                                            style="font-size:.75rem;color:var(--kkt-secondary);font-weight:600;margin-bottom:8px;text-transform:uppercase;letter-spacing:1px;">
                                            {{ $blog->published_at?->format('d M Y') }}</div>
                                        <h5 style="font-family:'Playfair Display', Georgia, serif;font-weight:700;color:var(--kkt-dark);margin-bottom:8px;">
                                            {{ Str::limit($blog->title, 60) }}</h5>
                                        <p style="font-size:.86rem;color:#52606B;line-height:1.6;">{{ Str::limit($blog->excerpt, 100) }}
                                        </p>
                                        <span style="color:var(--kkt-primary);font-size:.85rem;font-weight:600;display:inline-flex;align-items:center;gap:4px;">
                                            Read Story <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection


