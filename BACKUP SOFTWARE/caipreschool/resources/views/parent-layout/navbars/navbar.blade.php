<nav class="mb-1 navbar navbar-expand-lg text-white-50 nav-menu">
    <a class="navbar-brand" href="#"><img src="{{ url('public/frontend/images/apple-touch-icon.png') }}" width="50px"></a>

    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
        aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>

    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
        <ul class="navbar-nav ml-auto nav-flex-icons nav-menu">
            <li class="nav-item">
                <a class="nav-link" href="">Announcement
                <span class="sr-only"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('parent/profile', Session::get('LoggedUser')) }}">Profile
                <span class="sr-only"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>