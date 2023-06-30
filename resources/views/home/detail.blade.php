@extends('_layout.layout')
@section('menu')
    @includeIf('_partials.menu')
@endsection
@section('content')
    <section id="app" class="detail position-relative">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2  px-0 admin_dashboard group_head">
                    <div style="border-right: 1px solid #284b63"
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 group_head">

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
                    </div>
                </div>
                <div class="col py-3">
                    <div class="detail-group">
                        <h2 class="head-title">TẠO MỚI BÀI VIẾT</h2>
                        <div class="form-detail-group pb-5">
                            <div>
                                <label class="typo__label">Simple select / dropdown</label>
                                <multiselect tag-placeholder="Add this as new tag" :taggable="true" @tag="addTag"
                                    v-model="value" :options="options" :multiple="true" :close-on-select="false"
                                    :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name"
                                    track-by="name" :preselect-first="true">
                                    <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                            class="multiselect__single"
                                            v-if="values.length &amp;&amp; !isOpen">@{{ values.length }} options
                                            selected</span></template>
                                </multiselect>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="input-label" for="tittle">Tiêu đề</label>
                                        <input name="Title" v-validate="'required'" style="height: 100px" v-model="title"
                                            id="tittle"></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="box-thumbnail">
                                        <img :src="thumbnails" alt="Thumbnail" class="avatar-trial">
                                        <div class="form-element pt-3 ps-5">
                                            <input @change="changeImages" class="file-upload file-avt" type="file"
                                                accept="image/*" ref="file" />
                                            <span class="text-danger"
                                                v-for="error in errors.collect('Title')">@{{ error }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="input-label" for="">Nội dung</label>
                            <ckeditor v-model="content" :config="editorConfig"></ckeditor>
                        </div>
                        <button class="btn-save" @click="save">Submit</button>
                    </div>
                </div>
            </div>



    </section>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('libs/vue-validate.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Vue.use(CKEditor);
            Vue.use(VeeValidate);
            let app = new Vue({
                el: '#app',
                components: {
                    Multiselect
                },
                data: {
                    myValue: '',
                    myOptions: ['op1', 'op2', 'op3'], // or [{id: key, text: value}, {id: key, text: value}]
                    editorData: '',
                    options: [],
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
                    item_post: {
                        content: ''
                    },
                    user_data: {},
                    auth: {},
                    token: '',
                    thumbnails: '',
                    file_path: '',
                    type_selected: [],
                    // flg_notify: false,

                    // if(vm.title.length > 20){vm.flg_notify = true}

                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;
                    vm.getAllType();

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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        };
                        axios.get(`/api/type  `, {
                                headers: headers,
                                token: vm.token
                            })
                            .then(response => {
                                vm.options = response.data
                                console.log(vm.options);
                            })
                            .catch(e => {
                                // this.errors.push(e)

                            })
                    },

                    formatDate(date) {
                        return moment(date).format('DD-MM-YYYY');
                    },
                    save_post() {
                        let vm = this;
                        console.log('data', vm.item_post.content);
                    },
                    add_item_type() {
                        let vm = this;
                        vm.item_type.list_type_name.push({
                            name: ''
                        });

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
                        console.log('file', vm.file_path);

                    },
                    showTypeInput() {
                        let vm = this;
                        console.log('123');
                        vm.flag_type = true;
                    },
                    substr(string) {
                        return this.string.substring(0, 8) + ".."
                    },
                    loadAllTypes() {
                        let vm = this;


                    },
                    viewTypeKeywords(name) {
                        let vm = this;
                        window.location.href = '{{ route('list_blog_search') }}/' + name;
                    },
                    save() {
                        let vm = this;
                        var url_string = window.location.href;
                        var url = new URL(url_string);
                        var token = url.searchParams.get("token");
                        const rawData = localStorage.getItem("user") || "[]";
                        vm.auth = JSON.parse(rawData);
                        vm.token = vm.auth.data.authorisation.token;
                        console.log(this.thumbnails);
                        const headers = {
                            Authorization: `Bearer ${vm.token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        };
                        console.log('option', vm.type_selected);
                        let newType = vm.value.map((value) => {
                            if (value.name !== vm.type_selected) {
                                return value;
                            }
                        });
                        vm.type_selected = newType.map(value => value.name);
                        console.log(vm.type_selected);
                        axios.post(`api/post`, {
                                token: vm.token,
                                topic: vm.title,
                                contents: vm.content,
                                thumbnail_image: vm.thumbnails,
                                type: vm.type_selected,
                            })
                            .then(response => {
                                window.location.href = '{{ route('list_user_blog') }}';
                            })
                            .catch(e => {
                                // this.errors.push(e)
                            })
                    }
                },
                watch: {
                    // whenever question changes, this function will run
                    title: function() {
                        let vm = this;
                        // if (vm.title === '123') {
                        //     vm.flg_notify = true;
                        // }


                    }
                },
            })
        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer')
@endsection
