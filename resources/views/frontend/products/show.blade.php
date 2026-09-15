@extends('layouts.app')
@section('title', $product->meta_title ?? $product->name)
@section('meta_description', $product->meta_description ?? $product->short_description)
@section('og_title', $product->name)
@section('og_image', $product->thumbnail_url)

@push('styles')
<style>
    .product-actions-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: nowrap;
    }
    .product-qty-box {
        display: inline-flex;
        align-items: center;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        background: #fff;
        height: 48px;
        flex-shrink: 0;
        overflow: hidden;
    }
    .product-qty-box .qty-btn {
        width: 38px;
        height: 100%;
        border: none;
        background: #f8f9fa;
        color: #495057;
        font-size: 1.15rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color .2s;
    }
    .product-qty-box .qty-btn:hover {
        background: #e9ecef;
    }
    .product-qty-box input#qty-input {
        width: 44px;
        height: 100%;
        border: none;
        text-align: center;
        font-weight: 700;
        font-size: 0.95rem;
        outline: none;
        background: transparent;
    }
    .product-qty-box input#qty-input::-webkit-outer-spin-button,
    .product-qty-box input#qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .product-qty-box input#qty-input[type=number] {
        -moz-appearance: textfield;
    }

    .btn-detail-add-cart {
        height: 48px !important;
        min-height: 48px !important;
        width: auto !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 0.98rem !important;
        padding: 0 28px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: var(--kkt-primary) !important;
        color: #fff !important;
        border: none !important;
        white-space: nowrap !important;
        flex: 0 0 auto !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12) !important;
        transition: all 0.25s ease !important;
    }
    .btn-detail-add-cart span {
        display: inline !important;
        color: #fff !important;
        font-size: inherit !important;
    }
    .btn-detail-add-cart i {
        font-size: 1.15rem !important;
        margin: 0 !important;
        display: inline-block !important;
    }
    .btn-detail-add-cart:hover {
        background: var(--kkt-secondary, #1a5632) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18) !important;
    }
    .btn-detail-out-of-stock {
        height: 48px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        padding: 0 28px !important;
        white-space: nowrap !important;
        flex: 0 0 auto !important;
    }
    .btn-detail-wishlist {
        width: 48px !important;
        height: 48px !important;
        min-height: 48px !important;
        border-radius: 12px !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        border: 1px solid #dee2e6 !important;
        background: #fff;
        color: #6c757d;
        transition: all 0.2s;
    }
    .btn-detail-wishlist:hover {
        background: #f8f9fa;
        color: #dc3545;
        border-color: #dc3545 !important;
    }
    .btn-detail-wishlist i {
        font-size: 1.2rem;
    }

    @media (max-width: 576px) {
        .product-actions-wrapper {
            gap: 8px;
        }
        .product-qty-box {
            height: 40px;
            border-radius: 10px;
        }
        .product-qty-box .qty-btn {
            width: 30px;
            font-size: 1rem;
        }
        .product-qty-box input#qty-input {
            width: 32px;
            font-size: 0.88rem;
        }
        .btn-detail-add-cart {
            flex: 0 0 auto !important;
            width: auto !important;
            height: 40px !important;
            min-height: 40px !important;
            border-radius: 10px !important;
            padding: 0 16px !important;
            font-size: 0.86rem !important;
            gap: 6px !important;
        }
        .btn-detail-out-of-stock {
            flex: 0 0 auto !important;
            width: auto !important;
            height: 40px !important;
            border-radius: 10px !important;
            padding: 0 16px !important;
            font-size: 0.86rem !important;
        }
        .btn-detail-add-cart i {
            font-size: 0.95rem !important;
        }
        .btn-detail-wishlist {
            width: 40px !important;
            height: 40px !important;
            min-height: 40px !important;
            border-radius: 10px !important;
        }
    }
    @media (max-width: 360px) {
        .product-actions-wrapper {
            gap: 6px;
        }
        .product-qty-box {
            height: 38px;
        }
        .product-qty-box .qty-btn {
            width: 26px;
        }
        .product-qty-box input#qty-input {
            width: 26px;
            font-size: 0.84rem;
        }
        .btn-detail-add-cart {
            height: 38px !important;
            min-height: 38px !important;
            padding: 0 12px !important;
            font-size: 0.82rem !important;
        }
        .btn-detail-wishlist {
            width: 38px !important;
            height: 38px !important;
            min-height: 38px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="breadcrumb-kkt">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:.84rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-4">
    <div class="container">
        <div class="row g-5">
            {{-- Images --}}
            <div class="col-lg-5">
                <div class="position-sticky" style="top: 80px;">
                    <div style="border-radius:16px;overflow:hidden;border:1px solid #e9ecef;background:#f8f9fa;aspect-ratio:1;" class="mb-3">
                        <img id="main-image" src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}"
                             onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-products.png') }}';"
                             style="width:100%;height:100%;object-fit:contain;cursor:zoom-in;transition:transform .3s;"
                             onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="d-flex gap-2 flex-wrap" id="image-thumbnails">
                        <div class="thumb-item active" onclick="changeImage('{{ $product->thumbnail_url }}', this)"
                             style="width:64px;height:64px;border-radius:8px;overflow:hidden;cursor:pointer;border:2px solid var(--kkt-primary);">
                            <img src="{{ $product->thumbnail_url }}" style="width:100%;height:100%;object-fit:cover;"  onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-products.png') }}';">
                        </div>
                        @foreach($product->images as $img)
                        <div class="thumb-item" onclick="changeImage('{{ $img->url }}', this)"
                             style="width:64px;height:64px;border-radius:8px;overflow:hidden;cursor:pointer;border:2px solid #e9ecef;">
                            <img src="{{ $img->url }}"  style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-products.png') }}';">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-lg-7">
                <div style="font-size:.82rem;color:var(--kkt-muted);margin-bottom:6px;">
                    <a href="{{ route('shop.category', $product->category->slug) }}" style="color:var(--kkt-primary);text-decoration:none;">{{ $product->category->name }}</a>
                    @if($product->subcategory)
                        <span class="mx-1">/</span>
                        <a href="{{ route('shop.subcategory', [$product->category->slug, $product->subcategory->slug]) }}" style="color:var(--kkt-primary);text-decoration:none;">{{ $product->subcategory->name }}</a>
                    @endif
                </div>

                @php
                    $otherCategories = $product->categories->where('id', '!=', $product->category_id);
                @endphp
                @if($otherCategories->count())
                <div style="font-size:.78rem;color:var(--kkt-muted);margin-bottom:6px;">
                    Also in:
                    @foreach($otherCategories as $oc)
                    <a href="{{ route('shop.category', $oc->slug) }}" class="badge rounded-pill me-1"
                       style="background:#f1f3f5;color:var(--kkt-dark);font-weight:500;text-decoration:none;">{{ $oc->name }}</a>
                    @endforeach
                </div>
                @endif

                <h1 style="font-size:1.7rem;font-weight:800;color:var(--kkt-dark);">{{ $product->name }}</h1>

                {{-- Rating --}}
                @if($product->reviews->count() > 0)
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($product->avg_rating) ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                    <span style="font-size:.88rem;color:#6c757d;">({{ $product->reviews->count() }} reviews)</span>
                </div>
                @endif

                {{-- Price --}}
                <div class="mb-4">
                    <span id="display-price" style="font-size:2rem;font-weight:900;color:var(--kkt-primary);">
                        ₹{{ number_format($product->effective_price, 2) }}
                    </span>
                    @if($product->sale_price && $product->sale_price < $product->price)
                    <span style="font-size:1.1rem;text-decoration:line-through;color:#6c757d;margin-left:10px;">₹{{ number_format($product->price, 2) }}</span>
                    <span class="badge-discount ms-2">{{ $product->discount_percent }}% OFF</span>
                    @endif
                </div>

                @if($product->short_description)
                <p style="color:#555;line-height:1.8;margin-bottom:20px;">{{ $product->short_description }}</p>
                @endif

                {{-- Variants --}}
                @if($product->variants->count())
                <div class="mb-4">
                    @php $colors = $product->variants->whereNotNull('color')->unique('color'); @endphp
                    @php $sizes  = $product->variants->whereNotNull('size')->unique('size'); @endphp

                    @if($colors->count())
                    <div class="mb-3">
                        <div style="font-size:.88rem;font-weight:600;margin-bottom:8px;">Color: <span id="selected-color">{{ $colors->first()->color }}</span></div>
                        <div class="d-flex gap-2 flex-wrap">
                            @foreach($colors as $variant)
                            <button type="button" class="variant-color-btn {{ $loop->first ? 'active' : '' }}"
                                    data-color="{{ $variant->color }}"
                                    title="{{ $variant->color }}"
                                    style="width:32px;height:32px;border-radius:50%;background:{{ $variant->color_hex ?? '#ccc' }};border:{{ $loop->first ? '3px solid #2E6F40' : '2px solid #ccc' }};cursor:pointer;transition:border .2s;">
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($sizes->count())
                    <div class="mb-3">
                        <div style="font-size:.88rem;font-weight:600;margin-bottom:8px;">Size: <span id="selected-size">—</span></div>
                        <div class="d-flex gap-2 flex-wrap" id="size-buttons">
                            @foreach($sizes as $variant)
                            <button type="button" class="variant-size-btn"
                                    data-size="{{ $variant->size }}"
                                    style="padding:6px 16px;border-radius:8px;border:2px solid #e9ecef;background:#fff;font-size:.84rem;font-weight:600;cursor:pointer;transition:all .2s;">
                                {{ $variant->size }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Quantity + Add to Cart --}}
                <div class="product-actions-wrapper mb-4">
                    <div class="product-qty-box">
                        <button type="button" onclick="changeQty(-1)" class="qty-btn" aria-label="Decrease quantity">−</button>
                        <input type="number" id="qty-input" value="1" min="1" max="{{ $product->stock ?: 99 }}" aria-label="Quantity">
                        <button type="button" onclick="changeQty(1)" class="qty-btn" aria-label="Increase quantity">+</button>
                    </div>

                    @if($product->isInStock())
                    <button class="btn btn-primary btn-add-to-cart btn-detail-add-cart"
                            id="main-add-to-cart"
                            data-product-id="{{ $product->id }}">
                        <i class="bi bi-bag-plus"></i>
                        <span>Add to Cart</span>
                    </button>
                    @else
                    <button class="btn btn-secondary btn-detail-out-of-stock d-flex align-items-center justify-content-center" disabled>
                        Out of Stock
                    </button>
                    @endif

                    @auth
                    <button class="btn btn-outline-secondary btn-wishlist btn-detail-wishlist"
                            data-product-id="{{ $product->id }}"
                            title="Add to Wishlist">
                        <i class="bi bi-heart{{ auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? '-fill text-danger' : '' }}"></i>
                    </button>
                    @endauth
                </div>

                {{-- Product Meta --}}
                <div style="border-top:1px solid #e9ecef;padding-top:16px;font-size:.85rem;color:#555;line-height:2;">
                    <div><span style="font-weight:600;color:var(--kkt-dark);">SKU:</span> {{ $product->sku }}</div>
                    <div><span style="font-weight:600;color:var(--kkt-dark);">Category:</span> {{ $product->category->name }}</div>
                    <div>
                        <span style="font-weight:600;color:var(--kkt-dark);">Availability:</span>
                        @if($product->isInStock())
                        <span style="color:#198754;font-weight:600;">✓ In Stock</span>
                        @else
                        <span style="color:#dc3545;font-weight:600;">✗ Out of Stock</span>
                        @endif
                    </div>
                    @if($product->tags)
                    <div><span style="font-weight:600;color:var(--kkt-dark);">Tags:</span> {{ implode(', ', $product->tags) }}</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Description & Reviews Tabs --}}
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Description</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Reviews ({{ $product->reviews->count() }})</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#from-the-brand">From the Brand</button></li>
                </ul>
                <div class="tab-content border border-top-0 rounded-bottom p-4">
                    <div class="tab-pane fade show active" id="description">
                        {!! $product->description ?? '<p>No description available.</p>' !!}
                    </div>
                    <div class="tab-pane fade" id="reviews">
                        {{-- Add Review Form --}}
                            @auth

                            <div class="border rounded-4 p-4 mb-4 bg-light">

                                <h5 class="fw-bold mb-3">
                                    Write a Review
                                </h5>

                                <form action="{{ route('reviews.store', $product->id) }}" method="POST">

                                    @csrf

                                    {{-- Rating --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Rating
                                        </label>

                                        <select name="rating" class="form-select" required>
                                            <option value="">Select Rating</option>
                                            <option value="5">★★★★★ (5)</option>
                                            <option value="4">★★★★☆ (4)</option>
                                            <option value="3">★★★☆☆ (3)</option>
                                            <option value="2">★★☆☆☆ (2)</option>
                                            <option value="1">★☆☆☆☆ (1)</option>
                                        </select>

                                    </div>

                                    {{-- Title --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Review Title
                                        </label>

                                        <input
                                            type="text"
                                            name="title"
                                            class="form-control"
                                            placeholder="Enter review title"
                                        >

                                    </div>

                                    {{-- Review --}}
                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            Your Review
                                        </label>

                                        <textarea
                                            name="body"
                                            rows="4"
                                            class="form-control"
                                            placeholder="Write your review..."
                                            required
                                        ></textarea>

                                    </div>

                                    <button class="btn btn-primary px-4">
                                        Submit Review
                                    </button>

                                </form>

                            </div>

                            @else

                            <div class="alert alert-light border">
                                Please
                                <a href="{{ route('login') }}">
                                    login
                                </a>
                                to write a review.
                            </div>

                            @endauth
                        @forelse($product->reviews as $review)
                        <div class="d-flex gap-3 border-bottom pb-3 mb-3">
                            <img src="{{ $review->user->avatar_url }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;" alt="{{ $review->user->name }}">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <strong style="font-size:.9rem;">{{ $review->user->name }}</strong>
                                    <span style="font-size:.78rem;color:#6c757d;">{{ $review->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="text-warning my-1" style="font-size:.8rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                @if($review->title)<div style="font-weight:600;font-size:.88rem;">{{ $review->title }}</div>@endif
                                <p style="font-size:.87rem;color:#555;margin-top:4px;">{{ $review->body }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">No reviews yet. Be the first to review!</p>
                        @endforelse
                    </div>
                    <div class="tab-pane fade" id="from-the-brand">
                        <div class="row g-4 justify-content-center align-items-center text-center py-3">
                            <div class="col-6 col-md-3">
                                <div class="p-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ base_public_url('assets/img/AYUSH_Certified.png') }}" 
                                         alt="AYUSH Certified" 
                                         class="img-fluid" 
                                         style="max-height: 180px; object-fit: contain; transition: transform .3s;"
                                         onmouseover="this.style.transform='scale(1.05)'" 
                                         onmouseout="this.style.transform='scale(1)'">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ base_public_url('assets/img/GMP_Certified.png') }}" 
                                         alt="Made in GMP Certified facilities" 
                                         class="img-fluid" 
                                         style="max-height: 180px; object-fit: contain; transition: transform .3s;"
                                         onmouseover="this.style.transform='scale(1.05)'" 
                                         onmouseout="this.style.transform='scale(1)'">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ base_public_url('assets/img/No_Added_Sugar.png') }}" 
                                         alt="No Added Sugar" 
                                         class="img-fluid" 
                                         style="max-height: 180px; object-fit: contain; transition: transform .3s;"
                                         onmouseover="this.style.transform='scale(1.05)'" 
                                         onmouseout="this.style.transform='scale(1)'">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{ base_public_url('assets/img/No_Artificial_Flavour_or_Colour.png') }}" 
                                         alt="No Artificial Flavour or Colour" 
                                         class="img-fluid" 
                                         style="max-height: 180px; object-fit: contain; transition: transform .3s;"
                                         onmouseover="this.style.transform='scale(1.05)'" 
                                         onmouseout="this.style.transform='scale(1)'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($related->count())
        <div class="mt-5 pt-3">
            <div class="section-luxury-header mb-4">
                <div class="section-luxury-header-content">
                    <div class="sec-explore-tag">
                        <span class="tag-line"></span>
                        <span class="tag-text">YOU MAY ALSO LIKE</span>
                        <span class="tag-line"></span>
                    </div>
                    <h2 class="sec-main-heading">
                        Related <span class="sec-heading-accent">Products</span>
                    </h2>
                    <p class="sec-desc">
                        Complementary heirloom pieces crafted to complete your luxury collection.
                    </p>
                </div>
            </div>
            <div class="row g-3">
                @foreach($related as $p)
                    @include('partials.product-card', ['product' => $p])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
const variants = @json($product->variants);
let selectedVariantId = null;

function changeImage(url, el) {
    document.getElementById('main-image').src = url;
    document.querySelectorAll('.thumb-item').forEach(t => t.style.borderColor = '#e9ecef');
    el.style.borderColor = 'var(--kkt-primary)';
}

function changeQty(delta) {
    const input = document.getElementById('qty-input');
    let val = parseInt(input.value) + delta;
    input.value = Math.max(1, val);
}

// Color selection
document.querySelectorAll('.variant-color-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.variant-color-btn').forEach(b => b.style.border = '2px solid #ccc');
        this.style.border = '3px solid #2E6F40';
        document.getElementById('selected-color').textContent = this.dataset.color;
        updateVariantPrice();
    });
});

// Size selection
document.querySelectorAll('.variant-size-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.variant-size-btn').forEach(b => {
            b.style.borderColor = '#e9ecef'; b.style.background = '#fff'; b.style.color = '#333';
        });
        this.style.borderColor = '#2E6F40'; this.style.background = '#2E6F40'; this.style.color = '#fff';
        document.getElementById('selected-size').textContent = this.dataset.size;
        updateVariantPrice();
    });
});

function updateVariantPrice() {
    const color = document.getElementById('selected-color')?.textContent;
    const size  = document.getElementById('selected-size')?.textContent;
    const variant = variants.find(v => (!color || v.color === color) && (!size || v.size === size));
    if (variant) {
        selectedVariantId = variant.id;
        const price = variant.sale_price || variant.price || {{ $product->effective_price }};
        document.getElementById('display-price').textContent = '₹' + parseFloat(price).toFixed(2);
        document.getElementById('main-add-to-cart').dataset.variantId = variant.id;
    }
}

// Override add-to-cart for this page to include variant
document.getElementById('main-add-to-cart')?.addEventListener('click', function(e) {
    e.preventDefault();
    const productId = this.dataset.productId;
    const variantId = this.dataset.variantId || null;
    const qty = parseInt(document.getElementById('qty-input').value);
    $.post('{{ route("cart.add") }}', { product_id: productId, product_variant_id: variantId, quantity: qty })
        .done(res => {
            if (res.success) {
                $('#cart-count').text(res.count);
                showToast(res.message, 'success');
            }
        });
});
</script>
@endpush
