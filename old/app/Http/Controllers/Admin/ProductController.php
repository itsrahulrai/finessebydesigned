<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Subcategory;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private ImageService $imageService
    ) {}

    public function index(Request $request)
    {
        $query = Product::with(['category', 'subcategory'])->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('category_id')) {
            $query->whereHas('categories', fn ($q) => $q->where('categories.id', $request->category_id));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products   = $query->paginate(10)->withQueryString();
        // $products   = $query->get();
        // dd($products);
        $categories = Category::active()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()  
    {
        $categories = Category::with('subcategories')->active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data   = $request->validated();
        $images = $request->file('gallery', []);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->imageService->store($request->file('thumbnail'), 'products/thumbnails');
        }

        $product = $this->productService->create($data, $images);

        // Handle variants
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                if (!empty($variant['sku'])) {
                    ProductVariant::create(array_merge($variant, ['product_id' => $product->id]));
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'variants', 'category', 'subcategory', 'categories', 'subcategories']);
        $categories = Category::with('subcategories')->active()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        // dd($request->all());

        $data   = $request->validated();
        $images = $request->file('gallery', []);

        if ($request->hasFile('thumbnail')) {

            // Delete old image
            if ($product->thumbnail) {
                $this->imageService->delete($product->thumbnail);
            }

            // Upload new image
            $data['thumbnail'] = $this->imageService->store(
                $request->file('thumbnail'),
                'products/thumbnails'
            );
        }

        $this->productService->update($product, $data, $images);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->imageService->delete($product->thumbnail);
        $product->images->each(function ($img) {
            $this->imageService->delete($img->image);
            $img->delete();
        });
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }

    public function deleteImage(ProductImage $image)
    {
        $this->imageService->delete($image->image);
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function getSubcategories(Category $category)
    {
        return response()->json($category->subcategories()->where('is_active', true)->get(['id', 'name']));
    }
}
