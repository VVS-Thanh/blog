@extends('_layout.layout')
@section('menu')
@includeIf('_partials.menu')
@endsection
@section('content')

<section id="app" class="detail position-relative">

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
                <div class="detail-group">
                    <h2 class="head-title">CHỈNH SỮA BÀI VIẾT</h2>
                    <div class="form-detail-group pb-5">
                        <div>
                            <label class="typo__label">Simple select / dropdown</label>
                            <multiselect tag-placeholder="Add this as new tag" :taggable="true" @tag="addTag" v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="true">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">@{{ values.length }} options selected</span></template>
                            </multiselect>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">

                                    <label class="input-label" for="tittle">Tiêu đề</label>
                                    <input v-model="edit_data.topic" style="height: 100px" v-model="title" id="tittle"></input>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="box-thumbnail">
                                    <img v-if="thumnail == true" :src="edit_data.thumbnail_image" alt="Thumbnail" class="avatar-trial">
                                    <img v-else :src="thumbnails" alt="Thumbnail" class="avatar-trial">
                                    <div class="form-element pt-3 ps-5">
                                        <input @change="changeImages" class="file-upload file-avt" type="file" accept="image/*" ref="file" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="input-label" for="">Nội dung</label>
                        <ckeditor v-model="edit_data.contents" :config="editorConfig"></ckeditor>
                    </div>
                    <!-- <select-2 :options="options" name="test" v-model="selected"></select-2> -->
                    <button class="btn-save" @click="save">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        Vue.use(CKEditor);
        let app = new Vue({
            el: '#app',
            components: {
                Multiselect
            },
            data: {
                myValue: '',
                myOptions: ['op1', 'op2', 'op3'], // or [{id: key, text: value}, {id: key, text: value}]
                editorData: '',
                options: [

                ],
                editorConfig: {
                    uicolor: "red",
                    extraPlugins: "uicolor,justify,autogrow,showblocks",

                },
                value: [],
                item_type: {
                    list_type_name: [],
                },
                flag_type: false,
                title: '',
                content: '',
                list_posts: [],
                errors: [],
                item_post: {
                    content: ''
                },
                thumnail: true,
                id: '{{$id}}',
                user_data: {},
                auth: {},
                token: '',
                thumbnails: '',
                file_path: '',
                type_selected: [],
                list_format_all_post: [],
                edit_data: [],

            },
            created() {
                let vm = this;
            },
            mounted() {
                let vm = this;
                vm.getAllType();
                vm.getAllPostUser();

                // this.options.push(vm.edit_data.type_of_post)
                // this.value.push(vm.edit_data.type_of_post)
                // vm.value = vm.type_selected;
            },

            methods: {
                addTag(newTag) {
                    const tag = {
                        name: newTag,
                        // code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                    }
                    this.options.push(tag)
                    this.value.push(tag)
                },
                getAllType() {
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
                    axios.get(`http://blog.com/api/type`, {
                            headers: headers,
                            token: vm.token
                        })
                        .then(response => {
                            vm.options = response.data
                        })
                        .catch(e => {
                            this.errors.push(e)

                        })
                },

                formatDate(date) {
                    return moment(date).format('DD-MM-YYYY');
                },
                save_post() {
                    let vm = this;
                },
                add_item_type() {
                    let vm = this;
                    vm.item_type.list_type_name.push({
                        name: ''
                    });

                },
                changeImages(e) {
                    let vm = this;
                    vm.thumnail = false;
                    this.$emit('input', e.target.files[0]);
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.thumbnails = e.target.result;
                    }
                    reader.readAsDataURL(e.target.files[0]);
                    vm.file_path = e.target.files[0];
                    vm.edit_data.thumbnail_image = vm.file_path;

                },
                showTypeInput() {
                    let vm = this;
                    vm.flag_type = true;
                },
                substr(string) {
                    return this.string.substring(0, 8) + ".."
                },
                loadAllTypes() {
                    let vm = this;


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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    };
                    axios.get(`http://blog.com/api/me/post `, {
                            headers: headers,
                            token: vm.token,
                        })
                        .then(response => {
                            vm.list_format_all_post = response.data;
                            vm.edit_data = vm.list_format_all_post.find((value) => {
                                if (value.id == vm.id) {
                                    return value;
                                }
                            })
                            console.log('edit', vm.edit_data.type_of_post);
                            vm.value = vm.edit_data.type_of_post;
                        })
                        .catch(e => {
                            this.errors.push(e)

                        })
                },
                save() {
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
                    vm.type_selected = vm.value.map(value => value.name);
                    axios.put(`http://blog.com/api/post/{{$id}}`, {
                            // id: vm.id,
                            token: vm.token,
                            topic: vm.edit_data.topic,
                            contents: vm.edit_data.contents,
                            thumbnail_image: vm.thumbnails,
                            type: vm.type_selected,
                        })
                        .then(response => {
                            // window.location.href = '{{route('list_user_blog')}}';
                            console.log(response.data);
                        })
                        .catch(e => {
                            this.errors.push(e)
                        })
                }

            }
        })
    })
</script>
<script src="{{ asset('js/app.js')}}"></script>


@endsection
@section('footer')
@includeIf('_partials.footer')
@endsection
