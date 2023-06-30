@extends('_layout.layout')
@section('menu')
@includeIf('_partials.menu')
@endsection
@section('content')
<section id="user_detail" class="user_detail">
<div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2  px-0 admin_dashboard group_head">
                <div style="border-right: 1px solid #284b63" class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 group_head">
                    <!-- <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                    </a> -->
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start group_item_sidebar group_head" id="menu">
                        <li class="nav-item item_sidebar">
                            <a href="#trangchu" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Trang</span>
                            </a>
                            <ul id="trangchu" class="collapse show nav flex-column ms-1" data-bs-parent="#menu">
                                <li class="w-100 group_item_side">
                                    <span class="card-icon"><i class="fa-solid fa-house"></i></span>
                                    <span>
                                        <a href="{{route('dashboard')}}" class="nav-link px-0"> <span class="d-none d-sm-inline item_side_text">Trang chủ</span> </a>
                                    </span>
                                </li>
                                <li class="w-100 group_item_side">
                                    <span class="card-icon"><i class="fa-solid fa-microchip"></i></span>
                                    <span>
                                        <a href="https://viblo.asia/newest" class="nav-link px-0"> <span class="d-none d-sm-inline item_side_text">Trang tin tức công nghệ</span> </a>
                                    </span>
                                </li>
                                <!-- <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="item_sidebar">
                            <a href="#canhan" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Thông tin cá nhân</span>
                            </a>
                            <ul id="canhan" class="collapse show nav flex-column ms-1" data-bs-parent="#menu">
                                <li class="w-100 group_item_side">
                                    <span class="card-icon"><i class="fa-solid fa-house"></i></span>
                                    <span>
                                        <a href="{{route('user_detail')}}" class="nav-link px-0"> <span class="d-none d-sm-inline item_side_text">Quản lý thông tin cá nhân</span> </a>
                                    </span>
                                </li>
                                <li class="w-100 group_item_side">
                                    <span class="card-icon"><i class="fa-solid fa-microchip"></i></span>
                                    <span>
                                        <a href="{{route('user_security_detail')}}" class="nav-link px-0"> <span class="d-none d-sm-inline item_side_text">
                                                Quản lý thông tin bảo mật

                                            </span> </a>
                                    </span>
                                </li>
                            </ul>
                        </li>
                        <li class="item_sidebar">
                            <a href="#baiviet" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Danh sách bài viết</span>
                            </a>
                            <ul id="baiviet" class="collapse show nav flex-column ms-1" data-bs-parent="#menu">
                                <li class="w-100 group_item_side">
                                    <span class="card-icon"><i class="fa-solid fa-house"></i></span>
                                    <span>
                                        <a href="{{route('list_user_blog')}}" class="nav-link px-0"> <span class="d-none d-sm-inline item_side_text"> Quản lý danh sách bài viết</span> </a>
                                    </span>
                                </li>
                                <li class="w-100 group_item_side">
                                    <span class="card-icon"><i class="fa-solid fa-microchip"></i></span>
                                    <span>
                                        <a href="{{route('detail')}}" class="nav-link px-0"> <span class="d-none d-sm-inline item_side_text">Thêm bài viết</span> </a>
                                    </span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <!-- <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">loser</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div> -->
                </div>
            </div>
            <div class="col py-3">

            <div class="row pt-5">
            <div class="col-lg-8">
                <div class="infor-user">
                    <div class="infor-user-title">
                        <h2 class="title-user">Thông tin bảo mật</h2>
                        <h2 class="title-user">Quản lý thông tin bảo mật của bạn</h2>
                    </div>
                    <div class="form-element">
                        <h2 class="title-user" v-text="'Bạn đã tham gia cộng đồng vào ngày: ' + formatDate(base_info.created_at)"></h2>

                        <label class="input-label label-user" for="">Email</label>
                        <input disabled v-model="base_info.email" class="form-input input-user" type="text">
                    </div>
                    <div class="form-element">
                        <label class="input-label label-user" for="">Username</label>
                        <input v-model="base_info.name" class="form-input input-user" type="text">
                    </div>
                    <div class="form-element">
                        <label class="input-label label-user" for="">Phone</label>
                        <input v-model="base_info.phone" class="form-input input-user" type="text">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="user-right">

                    <!-- <div class="avt-user">
                        <img :src="thumbnails" alt="Thumbnail" class="avatar-trial img-avatar-user">
                        <div class="form-element pt-3 ps-5">
                            <input @change="changeImages" class="file-upload file-avt" type="file" accept="image/*" ref="file" />
                        </div>
                    </div> -->
                    <div @click="changeUserData" class="change-info btn-change">
                        Thay đổi thông tin
                    </div>
                </div>
            </div>
        </div>

            </div>
        </div>
    </div>




</section>

<script src="{{ asset('js/app.js') }}">
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        let app = new Vue({
            el: '#user_detail',
            data: {
                username: '',
                password: '',
                postBody: '',
                errors: [],
                blog_data: {},
                list_all_posts: [],
                thumbnails: '',
                base_info: [],
                file_path: '',
            },
            created() {
                let vm = this;
            },
            mounted() {
                let vm = this;
                vm.getAllBlog();
                let base_user = JSON.parse(localStorage.getItem('user'));
                vm.base_info = base_user.data.user;
                // vm.getBlogAfterClick();
            },
            methods: {
                formatDate(date) {
                    return moment(date).format('DD-MM-YYYY');
                },
                save_post() {
                    let vm = this;
                    console.log('data', vm.item_post.content);
                },
                substr(string) {
                    return this.string.substring(0, 8) + ".."
                },

                getBlogAfterClick() {
                    let vm = this;
                    // vm.blog_data = localStorage.getItem("data_click");
                },
                changeUserData() {
                    let vm = this;
                    var url_string = window.location.href;
                    var url = new URL(url_string);
                    var token = url.searchParams.get("token");
                    const rawData = localStorage.getItem("user") || "[]";
                    vm.auth = JSON.parse(rawData);
                    vm.token = vm.auth.data.authorisation.token;
                    const headers = {
                        Authorization: `Bearer ${vm.token}`,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    };
                    axios.put(`api/me`, {
                            headers: headers,
                            token: vm.token,
                            name: vm.base_info.name,
                            email: vm.base_info.email,
                            phone: vm.base_info.phone,
                        })
                        .then(response => {
                            window.localStorage.removeItem('token');
                            window.localStorage.removeItem('user');
                            window.localStorage.removeItem('redirect_url');
                            vm.redirectLoginPage();
                            // localStorage.removeItem('user');
                            // localStorage.setItem("user", JSON.stringify(response));
                            // location.reload();
                        })
                        .catch(e => {
                            this.errors.push(e)

                        })
                },
                changeImages(e) {
                    let vm = this;
                    this.$emit('input', e.target.files[0]);
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.thumbnails = e.target.result;
                    }
                    reader.readAsDataURL(e.target.files[0]);
                    vm.file_path = e.target.files[0];

                },
                redirectLoginPage: function() {
                        return window.location.href = '{{route('dashboard')}}' + '/' + 'login';
                    },
                getAllBlog() {
                    let vm = this;
                    var url_string = window.location.href;
                    var url = new URL(url_string);
                    var token = url.searchParams.get("token");
                    const rawData = localStorage.getItem("user") || "[]";
                    // vm.auth = JSON.parse(rawData);
                    // vm.token = vm.auth.data.authorisation.token;
                    const headers = {
                        Authorization: `Bearer ${vm.token}`,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    };
                    axios.get(`http://blog.com/api/post  `, {
                            headers: headers,
                            token: vm.token
                        })
                        .then(response => {
                            vm.list_all_posts = response.data;

                            vm.blog_data = vm.list_all_posts.find((value) => {
                                if (value.id == vm.id) {
                                    return value;
                                }
                            })
                            console.log(vm.list_all_posts);
                        })
                        .catch(e => {
                            this.errors.push(e)

                        })
                },


            }
        })

    })
</script>

@endsection
@section('footer')
@includeIf('_partials.footer')
@endsection
