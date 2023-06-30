@extends('_layout.layout_admin')
@section('menu')
    @includeIf('_partials.menu_admin')
@endsection
@section('content')
    <section id="ad_type">

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
                        <h3 class="post_detail_title text-left">List User</h3>
                        <button class="add_new_btn bg-success text-light" @click="addNew">Add new</button>
                    </div>
                    <div class="row">
                        <div id="no-more-tables">
                            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                    <tr class="group_item_table">
                                        <th>id</th>
                                        <th class="numeric">Email</th>
                                        <th class="numeric">Phone</th>
                                        <th class="numeric">Name</th>
                                        <th class="numeric">Password</th>
                                        <th class="numeric">Created at</th>
                                        <th class="numeric">Updated at</th>
                                        <th class="numeric">Role id</th>
                                        <th class="numeric">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in list_users" class="group_item_table">
                                        <td v-text="index"></td>
                                        <td v-text="_.get(item,'email','')" class="numeric"></td>
                                        <td v-text="_.get(item,'phone','')" class="numeric"></td>
                                        <td v-text="_.get(item,'name','')" class="numeric"></td>
                                        <td v-text="_.get(item,'password','')" class="numeric"></td>
                                        <td v-text="_.get(item,'created_at','')" class="numeric"></td>
                                        <td v-text="_.get(item,'updated_at','')" class="numeric"></td>
                                        <td v-text="_.get(item,'role_id','')" class="numeric"></td>
                                        <td class="numeric">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle bg-success" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="#">Sửa</a></li>
                                                    <li><a class="dropdown-item" href="#">Xóa</a></li>
                                                </ul>
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
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button @click="hideModal" type="button" class="btn-close" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" action="">
                                        <div class="form-group">
                                            <label class="label-input text-dark" for="username">Email</label>
                                            <input v-model="item_new.email" id="item_new.email" class="form-input"
                                                type="text">
                                        </div>
                                        <div class="form-group">
                                            <label class="label-input text-dark" for="password">Phone</label>
                                            <input v-model="item_new.phone" id="password" class="form-input"
                                                type="password">
                                        </div>
                                        <div class="form-group">
                                            <label class="label-input text-dark" for="password">Name</label>
                                            <input v-model="item_new.name" id="password" class="form-input"
                                                type="password">
                                        </div>
                                        <div class="form-group">
                                            <label class="label-input text-dark" for="password">Password</label>
                                            <input v-model="item_new.phone" id="password" class="form-input"
                                                type="password">
                                        </div>
                                        <div class="form-group">
                                            <label class="label-input text-dark" for="password">Role</label>
                                            <select v-model="item_new.role" name="" id="">
                                                <option v-for="(item,index) in role" value="item.id">
                                                    @{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="addNew">Close</button> -->
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>


    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            let app = new Vue({
                el: '#ad_type',
                data: {
                    text: '213123',
                    username: '',
                    password: '',
                    postBody: '',
                    errors: [],
                    flag_loading: false,
                    list_users: [],
                    item_new: {},
                    role: [{
                            id: 1,
                            name: 'User'
                        },
                        {
                            id: 2,
                            name: 'Admin'
                        }
                    ]
                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;
                    vm.loadAllUser();
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
                                headers: headers,
                                token: vm.token,
                            })
                            .then(response => {
                                console.log('123', response.data);
                                vm.list_users = response.data;
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })

                    },
                    addNew() {
                        let vm = this;
                        var myModal = new bootstrap.Modal(document.getElementById('addNew'), {
                            keyboard: false
                        })
                        myModal.show();
                    },
                    hideModal() {
                        let vm = this;
                        var myModalEl = document.getElementById('addNew');
                        // var modal = bootstrap.Modal(myModalEl)
                        modal.hide();
                    },
                }
            })

        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer_admin')
@endsection
