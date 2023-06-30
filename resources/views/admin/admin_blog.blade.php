@extends('_layout.layout_admin')
@section('menu')
    @includeIf('_partials.menu_admin')
@endsection
@section('content')
    <section id="ad_blog">

        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2  px-0 admin_dashboard group_head">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 group_head">

                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start group_item_sidebar group_head"
                            id="menu">
                            <li class="nav-item item_sidebar">
                                <a href="{{ route('admin_user') }}" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">List User</span>
                                </a>
                            </li>
                            <li class="item_sidebar">
                                <a href="{{ route('admin_blog') }}" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">List Blog</span>
                                </a>
                            </li>
                            <li class="item_sidebar">
                                <a href="{{ route('admin_type') }}" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">List Type</span>
                                </a>
                            </li>
                        </ul>
                        <hr>

                    </div>
                </div>
                <div class="col py-3">

                    <div class="d-flex justify-content-md-between pb-3 pt-3">
                        <h3 class="post_detail_title text-left">List Blog</h3>
                        <!-- <button class="add_new_btn bg-success text-light" @click="addNew">Add new</button> -->
                    </div>
                    <div class="row">
                        <div id="no-more-tables">
                            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                    <tr class="group_item_table">
                                        <th>ID</th>
                                        <th class="numeric">Title</th>
                                        <th class="numeric">Content</th>
                                        <th class="numeric">User upload</th>
                                        <th class="numeric">Type</th>
                                        <th class="numeric">Like</th>
                                        <th class="numeric">Comment</th>
                                        <th class="numeric">Created at</th>
                                        <th class="numeric">Updated at</th>
                                        <th class="numeric">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in list_blog" class="group_item_table">
                                        <td v-text="index + 1"></td>
                                        <td v-text="_.get(item,'topic','')" class="numeric"></td>
                                        <td v-text="_.get(item,'contents','')" class="numeric"></td>
                                        <td v-text="_.get(item,'user.name','')" class="numeric"></td>
                                        <td class="numeric">
                                            <span v-for="(data,i) in item.type_of_post"> <span> <br> </span>
                                                <span v-text="i + ' - ' + data.name  "></span>
                                            </span>
                                        </td>
                                        <td v-text="_.get(item,'like','')" class="numeric"></td>
                                        <td v-text="_.get(item,'comments','')" class="numeric"></td>
                                        <td v-text="item.created_at" class="numeric"></td>
                                        <td v-text="item.updated_at" class="numeric"></td>
                                        <td class="numeric">
                                            <div class="dropdown">
                                                <button @click="removeBlog(item.id)" class="btn btn-secondary bg-danger"
                                                    type="button" id="dropdownMenuButton1" aria-expanded="false">
                                                    Delete
                                                </button>
                                                <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                        <li @click="edit(item.id)"><a class="dropdown-item">Sữa</a></li>
                                                                        <li @click="remove(item.id)"><a class="dropdown-item">Xóa</a></li>
                                                                    </ul> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Modal add new -->
                    <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div style="max-width: 1200px" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới</h5>
                                    <!-- <button @click="hideModal" type="button" class="btn-close" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body">
                                    <div class="detail-group">
                                        <h2 class="head-title">TẠO MỚI BÀI VIẾT</h2>
                                        <div class="form-detail-group pb-5">
                                            <div>
                                                <label class="typo__label">Simple select / dropdown</label>
                                                <multiselect tag-placeholder="Add this as new tag" :taggable="true"
                                                    @tag="addTag" v-model="value" :options="options"
                                                    :multiple="true" :close-on-select="false" :clear-on-select="false"
                                                    :preserve-search="true" placeholder="Pick some" label="name"
                                                    track-by="name" :preselect-first="true">
                                                    <template slot="selection"
                                                        slot-scope="{ values, search, isOpen }"><span
                                                            class="multiselect__single"
                                                            v-if="values.length &amp;&amp; !isOpen">@{{ values.length }}
                                                            options selected</span></template>
                                                </multiselect>
                                            </div>

                                        </div>
                                        <div style="align-items: unset"
                                            class="form-detail-group pb-5 d-flex flex-column justify-content-start">
                                            <label class="typo__label" for="">Người đăng tải</label>
                                            <select v-model="user_selected" name="" id="">
                                                <option v-for="(item,index) in list_user" value="item.id">
                                                    @{{ item.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label class="input-label" for="tittle">Tiêu đề</label>
                                                        <input name="Title" v-validate="'required'"
                                                            style="height: 100px" v-model="title" id="tittle"></input>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="box-thumbnail">
                                                        <img :src="thumbnails" alt="Thumbnail" class="avatar-trial">
                                                        <div class="form-element pt-3 ps-5">
                                                            <input @change="changeImages" class="file-upload file-avt"
                                                                type="file" accept="image/*" ref="file" />
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
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button @click="save" type="button"
                                        class="btn btn-primary bg-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sửa Danh mục</h5>
                                    <button @click="hideModal" type="button" class="btn-close"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="detail-group">
                                        <h2 class="head-title">TẠO MỚI BÀI VIẾT</h2>
                                        <div class="form-detail-group pb-5">
                                            <div>
                                                <label class="typo__label">Simple select / dropdown</label>
                                                <multiselect tag-placeholder="Add this as new tag" :taggable="true"
                                                    @tag="addTag" v-model="value" :options="options"
                                                    :multiple="true" :close-on-select="false"
                                                    :clear-on-select="false" :preserve-search="true"
                                                    placeholder="Pick some" label="name" track-by="name"
                                                    :preselect-first="true">
                                                    <template slot="selection"
                                                        slot-scope="{ values, search, isOpen }"><span
                                                            class="multiselect__single"
                                                            v-if="values.length &amp;&amp; !isOpen">@{{ values.length }}
                                                            options selected</span></template>
                                                </multiselect>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label class="input-label" for="tittle">Tiêu đề</label>
                                                        <input name="Title" v-validate="'required'"
                                                            style="height: 100px" v-model="title" id="tittle"></input>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="box-thumbnail">
                                                        <img :src="thumbnails" alt="Thumbnail" class="avatar-trial">
                                                        <div class="form-element pt-3 ps-5">
                                                            <input @change="changeImages" class="file-upload file-avt"
                                                                type="file" accept="image/*" ref="file" />
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
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button @click="saveEdit" type="button"
                                        class="btn btn-primary bg-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('libs/vue-validate.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Vue.use(CKEditor);
            Vue.use(VeeValidate);
            let app = new Vue({
                el: '#ad_blog',
                data: {
                    text: '213123',
                    username: '',
                    password: '',
                    postBody: '',
                    flag_loading: false,
                    list_types: [],
                    item_new: {},
                    item_edit: {
                        name: '',
                    },
                    user_selected: '',
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
                    id_changes: '',
                    role: [{
                            id: 1,
                            name: 'User'
                        },
                        {
                            id: 2,
                            name: 'Admin'
                        }
                    ],
                    list_user: [],
                    list_blog: [],
                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;
                    vm.loadAllUser();
                    vm.getAllType();
                    vm.loadAllBlog();

                    // vm.postPost();
                },
                methods: {
                    formatDate(date) {
                        return moment(date).format('DD-MM-YYYY');
                    },
                    save_post() {
                        let vm = this;
                    },
                    substr(string) {
                        return this.string.substring(0, 8) + ".."
                    },
                    removeBlog(id) {
                        let vm = this;
                        axios.delete(`/api/post/` + id, {

                            })
                            .then(response => {
                                location.reload();
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },
                    loadAllUser() {
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
                        axios.get(`/api/users/all`, {

                            })
                            .then(response => {
                                vm.list_user = response.data;
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })

                    },
                    loadAllBlog() {
                        let vm = this;

                        const headers = {
                            Authorization: `Bearer ${vm.token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        };

                        axios.get(`/api/post`, {
                                // token: vm.token
                            })
                            .then(response => {
                                console.log(response.data);
                                vm.list_blog = response.data.map((value, index) => {
                                    return {
                                        contents: vm.extractContent(value.contents).substring(0,
                                            80),
                                        topic: vm.extractContent(value.topic).substring(0, 80),
                                        id: value.id,
                                        created_at: vm.formartDate(value.created_at),
                                        updated_at: vm.formartDate(value.updated_at),
                                        like: value.like,
                                        thumbnail_image: value.thumbnail_image,
                                        type_of_post: value.type_of_post,
                                        like: value.likes.length,
                                        comments: value.comments.length,
                                        id: value.id,
                                        user: value.user,
                                        user_id: value.user_id,
                                    }
                                })
                                console.log('lisst', vm.list_blog);

                            })
                            .catch(e => {
                                // this.errors.push(e)

                            })
                    },
                    substr(string) {
                        return this.string.substring(0, 8) + ".."
                    },
                    extractContent(html) {
                        return new DOMParser().parseFromString(html, "text/html").documentElement
                            .textContent;

                    },
                    converHtmlToString(html) {
                        var strippedHtml = html.replace(/<[^>]+>/g, '');
                        return strippedHtml.substring(0, 100);
                    },
                    formartDate(date) {
                        let vm = this;
                        return moment(date).format('DD-MM-YYYY');
                    },
                    addNew() {
                        let vm = this;
                        var myModal = new bootstrap.Modal(document.getElementById('addNew'), {
                            keyboard: false
                        })
                        myModal.show();

                        axios.post(`/api/type`, {
                                name: vm.item_new.name,
                            })
                            .then(response => {
                                console.log('123', response.data);
                                vm.list_types = response.data;
                                location.reload();
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })

                    },
                    edit(id) {
                        let vm = this;
                        let edit_value = vm.list_types.find((value) => {
                            if (value.id === id) {
                                return value;
                            }
                        })
                        vm.item_edit = edit_value;
                        console.log('123', vm.edit_value);
                        var myModal = new bootstrap.Modal(document.getElementById('edit'), {
                            keyboard: false
                        })
                        vm.id_changes = id;
                        console.log('', vm.id_changes);
                        myModal.show();

                    },
                    remove(id) {
                        let vm = this;
                        let text;
                        if (confirm("Do you want to Delete !") == true) {
                            text = "OK!";
                            axios.delete(`/api/type/` + id, {})
                                .then(response => {
                                    location.reload();
                                })
                                .catch(e => {
                                    this.errors.push(e)

                                })
                        } else {
                            text = "canceled!";
                        }

                    },
                    saveEdit() {
                        let vm = this;
                        axios.put(`/api/type/` + vm.id_changes, {
                                name: vm.item_edit.name,
                            })
                            .then(response => {
                                vm.list_types = response.data;
                                location.reload();
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },

                    hideModal() {
                        let vm = this;
                        var myModalEl = document.getElementById('addNew');
                        var modal = bootstrap.Modal(myModalEl)
                        modal.hide();
                    },
                    formartDate(date) {
                        let vm = this;
                        return moment(date).format('hh:mm - DD-MM-YYYY');
                    },
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
                        console.log(vm.content);
                        vm.type_selected = newType.map(value => value.name);
                        console.log(vm.type_selected);
                        axios.post(`/api/post`, {
                                token: vm.token,
                                topic: vm.title,
                                contents: vm.content,
                                thumbnail_image: vm.thumbnails,
                                user: vm.user_selected,
                                type: vm.type_selected,
                            })
                            .then(response => {
                                // window.location.href = '{{ route('list_user_blog') }}';
                                location.reload();
                            })
                            .catch(e => {
                                // this.errors.push(e)
                            })
                    }
                }
            })

        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer_admin')
@endsection
