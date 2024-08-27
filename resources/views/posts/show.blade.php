@extends('adminlte::page')
@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 0.5s ease-out;
}

.loader-content {
    text-align: center;
}

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad; /* Purple color */
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}
</style>
@stop
@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="post-header bg-primary text-white p-4 rounded-top">
                <h3 class="post-title mb-0">{{ $post->title }}</h3>
            </div>
            <div class="post-content p-4 bg-white rounded-bottom shadow-sm">
                <div class="post-meta mb-4">
                    <p class="text-muted mb-0">Posted on {{ $post->created_at->format('M d, Y') }}</p>
                </div>
                <div class="post-body mb-4">
                    <p>{!! nl2br(e($post->content)) !!}</p>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="post-info">
                            <strong>Start Date:</strong>
                            <p>{{ \Carbon\Carbon::parse($post->date_start)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="post-info">
                            <strong>End Date:</strong>
                            <p>{{ \Carbon\Carbon::parse($post->date_end)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="post-info">
                            <strong>Author:</strong>
                            <p>{{ $post->user->first_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('posts.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .post-header {
        background-color: #007bff;
        color: white;
        padding: 1rem 1.5rem;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .post-title {
        margin: 0;
    }

    .post-content {
        background-color: white;
        padding: 2rem;
        border-bottom-left-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .post-meta {
        font-size: 0.875rem;
    }

    .post-body p {
        margin-bottom: 1rem;
    }

    .post-info {
        margin-bottom: 1rem;
    }

    .post-info strong {
        display: block;
        font-size: 1rem;
        font-weight: bold;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
</style>
