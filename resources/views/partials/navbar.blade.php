<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo hoặc tên trang -->
        <a class="navbar-brand" href="{{ route('categories.index') }}">Forum Demo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Các link trên navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <!-- Khi chưa đăng nhập -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                    </li>
                @else
                    <!-- Khi đã đăng nhập -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <!-- Link đăng xuất với form ẩn -->
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
