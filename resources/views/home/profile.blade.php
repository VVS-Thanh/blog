@extends('_layout.layout')
@section('menu')
    @includeIf('_partials.menu')
@endsection
@section('content')
    <section style="padding-top: 80px" id="profile" class="profile position-relative">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2  px-0 admin_dashboard group_head">
                    <div style="border-right: 1px solid #284b63"
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 group_head">
                        <!-- <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <span class="fs-5 d-none d-sm-inline">Menu</span>
                                </a> -->
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start group_item_sidebar group_head"
                            id="menu">
                            <li class="nav-item item_sidebar">
                                <a href="#trangchu" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Trang</span>
                                </a>
                                <ul id="trangchu" class="collapse show nav flex-column ms-1" data-bs-parent="#menu">
                                    <li class="w-100 group_item_side">
                                        <span class="card-icon"><i class="fa-solid fa-house"></i></span>
                                        <span>
                                            <a href="{{ route('dashboard') }}" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline item_side_text">Trang chủ</span> </a>
                                        </span>
                                    </li>
                                    <li class="w-100 group_item_side">
                                        <span class="card-icon"><i class="fa-solid fa-microchip"></i></span>
                                        <span>
                                            <a href="https://viblo.asia/newest" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline item_side_text">Trang tin tức công nghệ</span>
                                            </a>
                                        </span>
                                    </li>
                                    <!-- <li>
                                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                                            </li> -->
                                </ul>
                            </li>
                            <li class="item_sidebar">
                                <a href="#canhan" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Thông tin cá
                                        nhân</span>
                                </a>
                                <ul id="canhan" class="collapse show nav flex-column ms-1" data-bs-parent="#menu">
                                    <li class="w-100 group_item_side">
                                        <span class="card-icon"><i class="fa-solid fa-house"></i></span>
                                        <span>
                                            <a href="{{ route('user_detail') }}" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline item_side_text">Quản lý thông tin cá
                                                    nhân</span> </a>
                                        </span>
                                    </li>
                                    <li class="w-100 group_item_side">
                                        <span class="card-icon"><i class="fa-solid fa-microchip"></i></span>
                                        <span>
                                            <a href="{{ route('user_security_detail') }}" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline item_side_text">
                                                    Quản lý thông tin bảo mật

                                                </span> </a>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                            <li class="item_sidebar">
                                <a href="#baiviet" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Danh sách bài
                                        viết</span>
                                </a>
                                <ul id="baiviet" class="collapse show nav flex-column ms-1" data-bs-parent="#menu">
                                    <li class="w-100 group_item_side">
                                        <span class="card-icon"><i class="fa-solid fa-house"></i></span>
                                        <span>
                                            <a href="{{ route('list_user_blog') }}" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline item_side_text"> Quản lý danh sách bài
                                                    viết</span> </a>
                                        </span>
                                    </li>
                                    <li class="w-100 group_item_side">
                                        <span class="card-icon"><i class="fa-solid fa-microchip"></i></span>
                                        <span>
                                            <a href="{{ route('detail') }}" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline item_side_text">Thêm bài viết</span> </a>
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
                    <div class="profile-main pt-0">
                        <h2 class="head-title">TRANG CÁ NHÂN</h2>
                        <div class="profile-main-top">

                            <img :src="_.get(me, 'profile.avatar', '')" alt="">
                            <!-- <div class="top-infor">
                                <div class="top-infor-name"></div>
                                <div class="top-infor-date"></div>
                            </div> -->
                        </div>
                        <div class="vertical-line"></div>
                        <div class="profile-main-bot">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="profile-text profile-main-right-username">
                                        <span>Username:</span>
                                        <span v-text="me.name"></span>
                                    </div>
                                    <div class="profile-text profile-main-right-email">
                                        <span>Email: </span>
                                        <span v-text="me.email"></span>
                                    </div>
                                    <div class="profile-text profile-main-right-phone">
                                        <span>Phone number: </span>
                                        <span v-text="me.phone"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="profile-text profile-main-right-fullname">
                                        <span>Fullname: </span>
                                        <span
                                            v-text="_.get(me,'profile.firstname','') + ' ' + _.get(me,'profile.lastname','')">
                                        </span>
                                    </div>
                                    <div class="profile-text profile-main-right-date">
                                        <span>Birthday:</span>
                                        <span v-text="_.get(me,'profile.birthday','')"></span>
                                    </div>
                                    <div class="profile-text profile-main-right-note">
                                        <span>Description:</span>
                                        <span v-text="_.get(me,'profile.note','')"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="vertical-line"></div>
                        <div class="list_blog">
                            <h2 class="head-title">Danh sách bài viết</h2>
                            <div class="list_blog_me">
                                <div v-for="(item,index) in list_all_posts" class="list_main_blog ">
                                    <div class="blog_card">

                                        <div class="blog_card_left">
                                            <img style="cursor: pointer" @click="viewMoreDetail(item.id)"
                                                :src="item.thumbnail_image" alt="">
                                        </div>
                                        <div class="blog_card_right">
                                            <div class="blog_card_right_user">
                                                <span class="blog_card_right_user_name">name</span>
                                                <span class="blog_card_right_user_created" v-text="item.created_at">ngày
                                                    thêm vào</span>
                                            </div>
                                            <div class="blog_card_right_detail">
                                                <div class="block_type">
                                                    <span @click="viewTypeKeywords(value.name)"
                                                        v-for="(value,index) in item.type_of_post" v-text="value.name"
                                                        class="type_item"></span>

                                                </div>
                                                <span @click="viewMoreDetail(item.id)"
                                                    class="blog_card_right_detail_title" v-text="item.topic"></span>
                                                <span @click="viewMoreDetail(item.id)"
                                                    class="blog_card_right_detail_content" v-text="item.contents"></span>
                                            </div>
                                        </div>
                                        <div class="btn-group btn-list-data-group">
                                            <button type="button" class="btn dropdown-toggle btn-data-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item " @click="redirectEditPage(item.id)"
                                                    href="#">Sữa</a>
                                                <div class="dropdown-divider"></div>
                                                <div @click="pushId(item.id)" data-toggle="modal"
                                                    data-target="#deleteModal" class="dropdown-item ">Xóa</div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>Bạn có đồng ý xóa bài viết</span>
                                                        <!-- <div v-text="item.topic"></div> -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" @click="delete_post(id)"
                                                            class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <!-- MODAL DELETE POST -->


    </section>




    </section>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let app = new Vue({
                el: '#profile',
                data: {
                    text: '213123',
                    username: '',
                    password: '',
                    postBody: '',
                    errors: [],
                    list_user_blog: {},
                    list_data: [],
                    list_format_all_post: [],
                    list_all_posts: [],
                    saving_data: [
                        data = {},
                    ],
                    id_delete: '',
                    me: [],
                },
                created() {
                    let vm = this;
                },

                mounted() {
                    let vm = this;
                    vm.getAllPostUser();
                    vm.getMe();
                    // vm.postPost();
                },
                methods: {
                    getMe() {
                        let vm = this;
                        get_me = localStorage.getItem('user');
                        let auth = JSON.parse(get_me);
                        vm.me = auth.data.user;
                    },
                    getAllPostUser() {
                        let vm = this;
                        var url_string = window.location.href;
                        var url = new URL(url_string);
                        var token = url.searchParams.get("token");
                        const rawData = localStorage.getItem("user") || "[]";
                        vm.auth = JSON.parse(rawData);
                        vm.token = vm.auth.data.authorisation.token;
                        const headers = {
                            Authorization: `Bearer ${vm.token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        };

                        axios.get(`/api/me/post`, {
                                headers: headers,
                                token: vm.token,
                            })
                            .then(response => {
                                console.log(response.data);
                                vm.list_format_all_post = response.data;
                                console.log(vm.list_format_all_post);
                                vm.list_all_posts = vm.list_format_all_post.map((value, index) => {
                                    return {
                                        contents: vm.extractContent(value.contents).substring(0,
                                            100) + "[...]",
                                        topic: vm.extractContent(value.topic).substring(0, 50) +
                                            " " + "[...]",
                                        like: value.like,
                                        created_at: vm.formatDate(value.created_at),
                                        thumbnail_image: value.thumbnail_image,
                                        type_of_post: value.type_of_post,
                                        id: value.id,
                                    }
                                })
                                console.log('new', newData);
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },
                    viewTypeKeywords(name) {
                        let vm = this;
                        window.location.href = '{{ route('list_blog_search') }}/' + name;
                    },
                    pushId(id) {
                        let vm = this;
                        vm.id_delete = id;
                    },
                    extractContent(html) {
                        return new DOMParser().parseFromString(html, "text/html").documentElement
                            .textContent;

                    },
                    formatDate(date) {
                        return moment(date).format('DD / MM / YYYY');
                    },
                    add_new() {
                        let vm = this;
                        window.location.href = '{{ route('detail') }}';
                    },
                    redirectEditPage(id) {
                        let vm = this;
                        window.location.href = '{{ route('edit_blog') }}/' + id;
                    },
                    viewMoreDetail(id) {
                        let vm = this;
                        window.location.href = '{{ route('blog_detail') }}/' + id;
                    }
                }
            })

        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer')
@endsection
