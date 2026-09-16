@php
    $wished = auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists();

    // Category info
    $catName = $product->category->name ?? 'Collection';
    $catLower = strtolower($catName);
    $prodNameLower = strtolower($product->name ?? '');

    // Dynamic Corner Tag (Subcategory, Tag, or Short Highlight)
    $tagLine = null;
    if (!empty($product->subcategory?->name)) {
        $tagLine = $product->subcategory->name;
    } elseif (!empty($product->tags) && is_array($product->tags) && count($product->tags)) {
        $tagLine = $product->tags[0];
    } elseif (!empty($product->short_description)) {
        $shortText = trim(strip_tags($product->short_description));
        if (strlen($shortText) > 0 && strlen($shortText) <= 24) {
            $tagLine = $shortText;
        }
    }

    // SKU
    $sku = $product->sku ?: ('FD-' . str_pad($product->id, 3, '0', STR_PAD_LEFT));
@endphp

<div class="{{ $colClass ?? 'col-xl-3 col-lg-4 col-md-6 col-6' }}">
    <div class="product-card">
        {{-- Product Image Container --}}
        <div class="card-img-wrapper">
            <a href="{{ route('product.show', $product->slug) }}" class="card-img-link">
                <img src="{{ $product->thumbnail_url }}"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='{{ base_public_url('assets/img/no-products.png') }}';">
            </a>

            {{-- Top-Left Badge (New / Bestseller / Trending / Discount / Out of stock) --}}
            <div class="prod-badge-wrap">
                @if($product->stock === 0 && $product->manage_stock)
                    <span class="prod-badge prod-badge-soldout">Sold Out</span>
                @elseif($product->discount_percent > 0)
                    <span class="prod-badge">-{{ $product->discount_percent }}%</span>
                @elseif($product->is_new_arrival)
                    <span class="prod-badge">New</span>
                @elseif($product->is_best_seller)
                    <span class="prod-badge">Bestseller</span>
                @elseif($product->is_trending)
                    <span class="prod-badge">Trending</span>
                @elseif($product->is_featured)
                    <span class="prod-badge">Featured</span>
                @endif
            </div>

            {{-- Top-Right Wishlist Button --}}
            <button type="button"
                    class="prod-wishlist-btn btn-wishlist {{ $wished ? 'wishlisted' : '' }}"
                    data-product-id="{{ $product->id }}"
                    title="Wishlist"
                    aria-label="Wishlist">
                <i class="bi bi-heart{{ $wished ? '-fill' : '' }}"></i>
            </button>

            {{-- Bottom-Right Dynamic Frosted Corner Tag --}}
            @if($tagLine)
            <div class="prod-corner-tag">
                <span>{{ $tagLine }}</span>
            </div>
            @endif
        </div>

        {{-- Product Information Body --}}
        <div class="card-body">
            {{-- Category Row with Custom Outline Icon --}}
            <div class="prod-category-row">
                @if(!empty($product->category?->icon))
                    <i class="{{ $product->category->icon }} prod-cat-icon"></i>
                @elseif(str_contains($catLower, 'bar') || str_contains($catLower, 'wine') || str_contains($prodNameLower, 'cooler') || str_contains($prodNameLower, 'wine'))
                    <svg class="prod-cat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 22h8"/><path d="M12 15v7"/><path d="M19 3H5l2 8a5 5 0 0 0 10 0z"/></svg>
                @elseif(str_contains($catLower, 'cutlery') || str_contains($catLower, 'dine') || str_contains($catLower, 'table') || str_contains($prodNameLower, 'cutlery') || str_contains($prodNameLower, 'spoon'))
                    <svg class="prod-cat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2v20"/><path d="M18 7c1.66 0 3-1.34 3-3V2h-3v5z"/><path d="M6 2v20"/><path d="M3 2v5a3 3 0 0 0 6 0V2"/></svg>
                @elseif(str_contains($catLower, 'server') || str_contains($catLower, 'dish') || str_contains($prodNameLower, 'dish') || str_contains($prodNameLower, 'bowl'))
                    <svg class="prod-cat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/><path d="M4 16a8 8 0 0 1 16 0"/><path d="M2 19h20"/><path d="M12 4v2"/></svg>
                @elseif(str_contains($catLower, 'gift') || str_contains($catLower, 'hamper') || str_contains($prodNameLower, 'gift'))
                    <svg class="prod-cat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="13" rx="2"/><path d="M12 8v13"/><path d="M3 12h18"/><path d="M12 8H7.5a2.5 2.5 0 1 1 0-5C11 3 12 8 12 8z"/><path d="M12 8h4.5a2.5 2.5 0 1 0 0-5C13 3 12 8 12 8z"/></svg>
                @else
                    <svg class="prod-cat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                @endif
                <span class="prod-cat-name">{{ $catName }}</span>
            </div>

            {{-- Product Title --}}
            <a href="{{ route('product.show', $product->slug) }}" class="prod-title-link">
                <h3 class="prod-title" title="{{ $product->name }}">{{ $product->name }}</h3>
            </a>

            {{-- Product SKU --}}
            <div class="prod-sku">{{ $sku }}</div>

            {{-- Price & Cart Action Row (Same Line) --}}
            <div class="prod-action-row">
                <div class="prod-price-block">
                    <span class="prod-price-current">₹ {{ number_format($product->effective_price, 2) }}</span>
                    @if($product->sale_price && $product->sale_price < $product->price)
                        <span class="prod-price-original">₹ {{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                @if($product->isInStock())
                    <button type="button"
                            class="prod-cart-btn btn-add-to-cart"
                            data-product-id="{{ $product->id }}"
                            title="Add to Cart">
                        <i class="bi bi-bag"></i>
                        <span>Add to Cart</span>
                    </button>
                @else
                    <button type="button" class="prod-cart-btn prod-cart-btn-disabled" disabled>
                        <i class="bi bi-bag-x"></i>
                        <span>Sold Out</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

@once
<style>
/* ============================================================
   FINESSE LUXURY PRODUCT CARD (MOCKUP ACCURATE)
============================================================ */
.product-card {
    position: relative;
    background: #FFFFFF;
    border: 1px solid #E8EDF2;
    border-radius: 22px;
    padding: 12px 10px 16px 10px;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow:
        0 4px 12px rgba(11, 111, 174, 0.04),
        0 12px 30px rgba(21, 27, 33, 0.06);
    transition: transform 0.35s cubic-bezier(0.25, 0.8, 0.25, 1),
                box-shadow 0.35s cubic-bezier(0.25, 0.8, 0.25, 1),
                border-color 0.35s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    border-color: rgba(11, 111, 174, 0.28);
    box-shadow:
        0 6px 16px rgba(11, 111, 174, 0.08),
        0 20px 42px rgba(21, 27, 33, 0.12);
}

/* ===== IMAGE WRAPPER ===== */
.product-card .card-img-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 16px;
    overflow: hidden;
    background: #F8FAFC;
}

.product-card .card-img-link {
    display: block;
    width: 100%;
    height: 100%;
}

.product-card .card-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.product-card:hover .card-img-wrapper img {
    transform: scale(1.06);
}

/* ===== TOP-LEFT BADGE ===== */
.prod-badge-wrap {
    position: absolute;
    top: 12px;
    left: 12px;
    z-index: 3;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.prod-badge {
    display: inline-block;
    background: #0B6FAE;
    color: #FFFFFF;
    font-family: 'Poppins', sans-serif;
    font-size: 11px;
    font-weight: 600;
    line-height: 1;
    padding: 6px 14px;
    border-radius: 8px;
    box-shadow: 0 3px 10px rgba(11, 111, 174, 0.35);
    letter-spacing: 0.3px;
}

.prod-badge-soldout {
    background: #475569;
    box-shadow: 0 3px 10px rgba(71, 85, 105, 0.25);
}

/* ===== TOP-RIGHT WISHLIST BUTTON ===== */
.prod-wishlist-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #151B21;
    font-size: 15px;
    cursor: pointer;
    z-index: 3;
    transition: transform 0.25s ease, box-shadow 0.25s ease, color 0.2s ease;
    padding: 0;
}

.prod-wishlist-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.18);
    color: #0B6FAE;
}

.prod-wishlist-btn.wishlisted {
    color: #E11D48;
}

.prod-wishlist-btn.wishlisted i {
    color: #E11D48;
}

/* ===== BOTTOM-RIGHT FROSTED CORNER TAG ===== */
.prod-corner-tag {
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: 2;
    pointer-events: none;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.72) 0%, rgba(222, 240, 252, 0.92) 100%);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border-top-left-radius: 26px;
    padding: 8px 14px 6px 16px;
    font-family: 'Playfair Display', Georgia, serif;
    font-style: italic;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.25;
    color: #0B6FAE;
    text-align: right;
    box-shadow: -2px -2px 10px rgba(11, 111, 174, 0.08);
    max-width: 75%;
}

/* ===== CARD BODY ===== */
.product-card .card-body {
    padding: 14px 4px 2px 4px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

/* Category Row */
.prod-category-row {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 4px;
}

.prod-cat-icon {
    width: 14px;
    height: 14px;
    color: #0B6FAE;
    flex-shrink: 0;
}

.prod-cat-name {
    font-family: 'Poppins', sans-serif;
    font-size: 10.5px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: #52606B;
    line-height: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Title */
.prod-title-link {
    text-decoration: none;
    display: block;
    margin-bottom: 2px;
}

.prod-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 17px;
    font-weight: 600;
    color: #151B21;
    line-height: 1.35;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s ease;
}

.prod-title-link:hover .prod-title {
    color: #0B6FAE;
}

/* SKU */
.prod-sku {
    font-family: 'Poppins', sans-serif;
    font-size: 11px;
    font-weight: 500;
    color: #87939D;
    letter-spacing: 0.4px;
    margin-bottom: 6px;
    line-height: 1.2;
}

/* Price & Cart Action Row (Same Line) */
.prod-action-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    margin-top: auto;
    padding-top: 12px;
}

.prod-price-block {
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-width: 0;
    margin-right: auto;
}

.prod-price-current {
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    font-weight: 700;
    color: #0B6FAE;
    letter-spacing: -0.3px;
    line-height: 1.15;
    white-space: nowrap;
}

.prod-price-original {
    font-family: 'Poppins', sans-serif;
    font-size: 11px;
    font-weight: 400;
    color: #87939D;
    text-decoration: line-through;
    line-height: 1.1;
    white-space: nowrap;
}

/* ===== ADD TO CART COMPACT BUTTON ===== */
.prod-cart-btn {
    width: auto !important;
    height: 33px !important;
    border-radius: 10px !important;
    background: linear-gradient(135deg, #0A4F7D 0%, #0B6FAE 45%, #118CC4 100%) !important;
    border: none !important;
    padding: 0 11px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 5px !important;
    color: #FFFFFF !important;
    font-family: 'Poppins', sans-serif !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    letter-spacing: 0.2px !important;
    box-shadow: 0 3px 8px rgba(11, 111, 174, 0.22);
    cursor: pointer;
    transition: transform 0.25s cubic-bezier(0.25, 0.8, 0.25, 1),
                box-shadow 0.25s ease,
                background 0.25s ease;
    text-decoration: none;
    white-space: nowrap !important;
    flex-shrink: 0 !important;
    margin: 0 !important;
}

.prod-cart-btn i {
    font-size: 13px !important;
    color: #FFFFFF !important;
}

.prod-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(11, 111, 174, 0.38);
    background: linear-gradient(135deg, #09446B 0%, #0B6FAE 40%, #159CD8 100%) !important;
}

.prod-cart-btn:active {
    transform: translateY(0);
}

.prod-cart-btn-disabled {
    background: #94A3B8 !important;
    box-shadow: none !important;
    cursor: not-allowed !important;
    opacity: 0.85;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 575px) {
    .product-card {
        padding: 10px 10px 12px 10px;
        border-radius: 18px;
    }
    .product-card .card-img-wrapper {
        border-radius: 14px;
    }
    .prod-badge {
        font-size: 10px;
        padding: 4px 10px;
    }
    .prod-wishlist-btn {
        width: 32px;
        height: 32px;
        font-size: 13px;
        top: 8px;
        right: 8px;
    }
    .prod-corner-tag {
        font-size: 9.5px;
        padding: 4px 9px 3px 11px;
        border-top-left-radius: 18px;
    }
    .product-card .card-body {
        padding: 10px 2px 2px 2px;
    }
    .prod-title {
        font-size: 14.5px;
    }
    .prod-action-row {
        gap: 6px;
        padding-top: 6px;
    }
    .prod-price-current {
        font-size: 13.5px;
    }
    .prod-price-original {
        font-size: 10px;
    }
    .prod-cart-btn {
        height: 29px !important;
        font-size: 10.5px !important;
        padding: 0 9px !important;
        gap: 4px !important;
    }
    .prod-cart-btn i {
        font-size: 11.5px !important;
    }
}
</style>
@endonce