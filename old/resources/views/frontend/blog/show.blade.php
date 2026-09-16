@extends('layouts.app')
@section('title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description ?? $blog->excerpt)
@section('content')
<div class="breadcrumb-kkt"><div class="container"><nav><ol class="breadcrumb mb-0" style="font-size:.84rem;"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li><li class="breadcrumb-item active">{{ Str::limit($blog->title, 30) }}</li></ol></nav></div></div>
<section class="py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($blog->category)<span style="background:var(--kkt-light);color:var(--kkt-primary);font-size:.8rem;font-weight:600;padding:4px 14px;border-radius:20px;">{{ $blog->category->name }}</span>@endif
            <h1 class="fw-800 mt-3 mb-3" style="color:var(--kkt-dark);font-size:2rem;">{{ $blog->title }}</h1>
            <div class="d-flex gap-3 mb-4" style="font-size:.82rem;color:#6c757d;">
                <span>{{ $blog->published_at?->format('d M Y') }}</span>
                <span>·</span><span>{{ $blog->views }} views</span>
            </div>
            @if($blog->thumbnail)
            <img src="{{ $blog->thumbnail_url }}" class="w-100 rounded-4 mb-4" style="max-height:400px;object-fit:cover;" alt="{{ $blog->title }}">
            @endif
          <div
                class="text-secondary"
                style="
                    font-size:1rem;
                    line-height:2;
                    text-align:justify;
                    color:#444;
                "
            >
                {!! $blog->body !!}
            </div>
        </div>
    </div>
    @if($related->count())
    <div class="mt-5">
        <h5 class="fw-700 mb-4">Related Posts</h5>
        <div class="row g-3">
            @foreach($related as $post)
            <div class="col-md-4">
                <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                    <div class="bg-white rounded-4 border overflow-hidden">
                        <img src="{{ $post->thumbnail_url }}" style="width:100%;height:160px;object-fit:cover;">
                        <div class="p-3"><h6 class="fw-700 mb-0" style="font-size:.9rem;color:var(--kkt-dark);">{{ Str::limit($post->title, 50) }}</h6></div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
</section>
@endsection
