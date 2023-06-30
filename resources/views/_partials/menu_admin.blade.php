<header id="header">
    <nav class="navbar navbar-expand-lg navbar-light navbar_admin">
        <div class="container">
            <a class="navbar-brand" href="{{route('dashboard')}}">
                <div class="logo-nav">
                    <img src="{{ asset('images/layout/logo.png') }}" alt="">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div v-if="user_flag == false" class="nav-user">
                    <a href="{{route('login')}}">
                        <span class="nav-user-login">Đăng nhập</span>
                    </a>
                    <a href="{{route('register')}}">
                        <span class="nav-user-register">Đăng ký</span>
                    </a>
                </div>
                <div v-else>
                    <div class="btn-group">
                        <div class="d-flex head-infor" data-toggle="dropdown" aria-expanded="false">
                            <img class="avt-header" :src="user_data.profile.avatar" alt="">
                            <button v-text="user_data.name" type="button" class="btn dropdown-toggle btn-user" >
                            </button>
                            </div>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" @click="redirectProfile(user_data.id)">Trang cá nhân</a>
                            <a class="dropdown-item" href="{{route('list_user_blog')}}">Danh sách bài viết</a>
                            <a class="dropdown-item" href="{{route('detail')}}">Thêm bài viết mới</a>
                            <div class="dropdown-divider"></div>
                            <a @click="logOut()" class="dropdown-item text-danger" href="#">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </nav>
</header>
