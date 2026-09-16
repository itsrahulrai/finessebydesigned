@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<div class="breadcrumb-kkt"><div class="container"><nav><ol class="breadcrumb mb-0" style="font-size:.84rem;"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item active">Blog</li></ol></nav></div></div>
<section class="py-5">
    <div class="section-luxury-header mb-5">
        <div class="section-luxury-header-content">
            <div class="sec-explore-tag">
                <span class="tag-line"></span>
                <span class="tag-text">STORIES & INSIGHTS</span>
                <span class="tag-line"></span>
            </div>
            <h2 class="sec-main-heading">
                Latest <span class="sec-heading-accent">Articles</span>
            </h2>
            <p class="sec-desc">
                Discover design inspirations, gifting guides, and stories of brass craftsmanship.
            </p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="row g-4">
                @forelse($blogs as $blog)
                <div class="col-md-6">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none">
                        <div class="bg-white rounded-4 border overflow-hidden" style="transition:box-shadow .2s;" onmouseover="this.style.boxShadow='0 4px 20px rgba(46,111,64,.1)'" onmouseout="this.style.boxShadow=''">
                            <img src="{{ $blog->thumbnail_url }}" style="width:100%;height:200px;object-fit:cover;" alt="{{ $blog->title }}">
                            <div class="p-4">
                                @if($blog->category)<span style="background:var(--kkt-light);color:var(--kkt-primary);font-size:.72rem;font-weight:600;padding:3px 10px;border-radius:12px;">{{ $blog->category->name }}</span>@endif
                                <h6 class="fw-700 mt-2 mb-2" style="color:var(--kkt-dark);">{{ Str::limit($blog->title, 55) }}</h6>
                                <p style="font-size:.83rem;color:#6c757d;">{{ Str::limit($blog->excerpt, 90) }}</p>
                                <div style="font-size:.76rem;color:#aaa;">{{ $blog->published_at?->format('d M Y') }}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <p class="text-muted">No blog posts yet.</p>
                @endforelse
            </div>
            <div class="mt-4">{{ $blogs->links() }}</div>
        </div>
        <div class="col-lg-4">
            <div class="bg-white rounded-4 border p-4 mb-4">
                <h6 class="fw-700 mb-3">Categories</h6>
                @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="d-flex justify-content-between text-decoration-none py-2 border-bottom" style="font-size:.87rem;color:#555;">
                    <span>{{ $cat->name }}</span><span class="text-muted">{{ $cat->blogs_count }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>
@endsection
