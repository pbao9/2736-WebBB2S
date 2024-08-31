<h2 class=" text-dark fw-bold text-uppercase title-sidebar pb-2">Bài viết liên quan</h2>
@foreach ($related as $post)
    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
        <div class="text-center mb-2">
            <a href="{{ route('blog.show', $post->slug) }}"
                class="text-uppercase mt-3 nav-link text-start">{{ $post->title }}</a>
        </div>
    </a>
@endforeach
