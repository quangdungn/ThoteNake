<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Demo</title>
    <!-- Sử dụng Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding-top: 70px; }
        .footer { background: #f8f9fa; padding: 20px 0; margin-top: 50px; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('categories.index') }}">Forum Demo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @else
                        <!-- Dropdown menu dành cho Admin -->
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" 
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Quản trị
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.categories.index') }}">Quản lý chủ đề</a>
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">Quản lý người dùng</a>
                                    <a class="dropdown-item" href="{{ route('admin.reports.index') }}">Quản lý báo cáo</a>
                                    <a class="dropdown-item" href="{{ route('admin.subjects.index') }}">Quản lý Subject</a>
                                </div>
                            </li>
                        @endif

                        <!-- Dropdown thông tin cá nhân -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">Thông tin cá nhân</a>
                                <a class="dropdown-item" href="{{ route('user.posts.index', Auth::user()->id) }}">Bài viết của tôi</a>
                                <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung trang -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer mt-4">
        <div class="container text-center">
            <small>&copy; {{ date('Y') }} Forum Demo. All rights reserved.</small>
        </div>
    </footer>

    <!-- Scripts Bootstrap và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    @include('partials.confirm-delete-modal')
    <!-- Script xử lý thiết lập action cho form xóa -->
    <script>
        // Hàm này được gọi khi nhấn nút xóa
        function confirmDelete(url) {
            // Thiết lập action của form xóa với URL truyền vào
            $('#deleteForm').attr('action', url);
            // Hiển thị modal xác nhận
            $('#confirmDeleteModal').modal('show');
        }
    </script>
</body>
</html>
