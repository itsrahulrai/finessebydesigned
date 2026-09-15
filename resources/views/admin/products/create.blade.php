@extends('layouts.admin')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-700 mb-0">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h5>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<form method="POST"
      action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
      enctype="multipart/form-data">
    @csrf
    @isset($product) @method('PUT') @endisset

    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-xl-8">
            {{-- Basic Info --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Basic Information</h6>
                <div class="mb-3">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $product->name ?? '') }}" id="product-name" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="product-slug" class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug', $product->slug ?? '') }}">
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                               value="{{ old('sku', $product->sku ?? '') }}" placeholder="Auto-generated if empty">
                        @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Full Description</label>
                    <textarea name="description" id="description-editor" class="form-control" rows="6">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>

            {{-- Pricing & Inventory --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Pricing & Inventory</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Regular Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0"
                               value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sale Price (₹)</label>
                        <input type="number" name="sale_price" class="form-control" step="0.01" min="0"
                               value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Leave empty if no discount">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cost Price (₹)</label>
                        <input type="number" name="cost_price" class="form-control" step="0.01" min="0"
                               value="{{ old('cost_price', $product->cost_price ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock" class="form-control" min="0"
                               value="{{ old('stock', $product->stock ?? 0) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Low Stock Threshold</label>
                        <input type="number" name="low_stock_threshold" class="form-control" min="0"
                               value="{{ old('low_stock_threshold', $product->low_stock_threshold ?? 5) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" class="form-control" step="0.01" min="0"
                               value="{{ old('tax_rate', $product->tax_rate ?? 0) }}">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="manage_stock" id="manage_stock" value="1"
                           {{ old('manage_stock', $product->manage_stock ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="manage_stock">Track inventory for this product</label>
                </div>
            </div>

            {{-- SEO --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">SEO Settings</h6>
                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                           value="{{ old('meta_title', $product->meta_title ?? '') }}" maxlength="160">
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2" maxlength="300">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="form-control"
                           value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}" placeholder="Comma separated keywords">
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-xl-4">
            {{-- Status & Visibility --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Status & Visibility</h6>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ old('status', $product->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $product->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="draft" {{ old('status', $product->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="d-flex flex-column gap-2">
                    @foreach(['is_featured'=>'Featured Product','is_trending'=>'Trending','is_new_arrival'=>'New Arrival','is_best_seller'=>'Best Seller','is_on_sale'=>'On Sale'] as $field => $label)
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="{{ $field }}" id="{{ $field }}" value="1"
                               {{ old($field, $product->{$field} ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $field }}" style="font-size:.87rem;">{{ $label }}</label>
                    </div>
                    @endforeach
                </div>
                
            </div>

            {{-- Category --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Category</h6>

                @php
                    $selectedCategoryIds = old('category_ids', isset($product) ? $product->categories->pluck('id')->toArray() : []);
                    $selectedSubcategoryIds = old('subcategory_ids', isset($product) ? $product->subcategories->pluck('id')->toArray() : []);
                @endphp

                <div class="mb-3">
                    <label class="form-label">Categories <span class="text-danger">*</span></label>
                    <div class="border rounded p-2 @error('category_ids') is-invalid @enderror" style="max-height:210px;overflow-y:auto;">
                        @forelse($categories as $cat)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="category_ids[]"
                                   value="{{ $cat->id }}" id="cat-{{ $cat->id }}"
                                   {{ in_array($cat->id, $selectedCategoryIds) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cat-{{ $cat->id }}">{{ $cat->name }}</label>
                        </div>
                        @empty
                        <span class="text-muted">No categories found.</span>
                        @endforelse
                    </div>
                    @error('category_ids') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    <small class="text-muted">Select one or more categories this product belongs to.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subcategories</label>
                    <div class="border rounded p-2" style="max-height:260px;overflow-y:auto;">
                        @forelse($categories as $cat)
                            @if($cat->subcategories->count())
                            <div class="mb-2">
                                <div class="text-uppercase fw-700" style="font-size:.7rem;letter-spacing:.03em;color:#9aa0a6;">{{ $cat->name }}</div>
                                @foreach($cat->subcategories as $sub)
                                <div class="form-check ms-2">
                                    <input class="form-check-input" type="checkbox" name="subcategory_ids[]"
                                           value="{{ $sub->id }}" id="sub-{{ $sub->id }}"
                                           {{ in_array($sub->id, $selectedSubcategoryIds) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sub-{{ $sub->id }}">{{ $sub->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        @empty
                        <span class="text-muted">No subcategories found.</span>
                        @endforelse
                    </div>
                    <small class="text-muted">Select any subcategories that apply, from any category.</small>
                </div>
            </div>

            {{-- Thumbnail --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Thumbnail</h6>
                @isset($product)
                @if($product->thumbnail)
                <div class="mb-2">
                    <img src="{{ $product->thumbnail_url }}" class="img-fluid rounded" style="max-height:160px;object-fit:cover;">
                </div>
                @endif
                @endisset
                <input type="file" name="thumbnail" class="form-control form-control-sm" accept="image/*">
                <small class="text-muted">Recommended: 800x800px, JPG/PNG, max 2MB</small>
            </div>

            {{-- Gallery --}}
            <div class="form-card mb-4">
                <h6 class="fw-700 mb-3 pb-2 border-bottom">Product Gallery</h6>
                @isset($product)
                @if($product->images->count())
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach($product->images as $img)
                    <div class="position-relative">
                        <img src="{{ $img->url }}" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image"
                                data-id="{{ $img->id }}" data-url="{{ route('admin.products.images.destroy', $img) }}"
                                style="padding:1px 5px;font-size:.65rem;border-radius:0 8px 0 8px;">×</button>
                    </div>
                    @endforeach
                </div>
                @endif
                @endisset
                <input type="file" name="gallery[]" class="form-control form-control-sm" accept="image/*" multiple>
                <small class="text-muted">Upload multiple images (max 2MB each)</small>
            </div>

            <button type="submit" class="btn btn-admin-primary text-white w-100 py-2">
                <i class="bi bi-check2-circle me-2"></i>{{ isset($product) ? 'Update Product' : 'Create Product' }}
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Auto-generate slug
$('#product-name').on('input', function() {
    if (!{!! isset($product) ? 'true' : 'false' !!}) {
        const slug = $(this).val().toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-');
        $('#product-slug').val(slug);
    }
});

// Delete gallery image
$(document).on('click', '.delete-image', function() {
    if (!confirm('Delete this image?')) return;
    const btn = $(this);
    $.ajax({ url: btn.data('url'), method: 'DELETE' })
        .done(() => btn.closest('.position-relative').remove());
});
</script>

<script>
new Jodit('#description-editor', {
    height: 350
});
</script>
@endpush
