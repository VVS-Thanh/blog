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
                        <h3 class="post_detail_title text-left">List Type</h3>
                        <button class="add_new_btn bg-success text-light" @click="addNew">Add new</button>
                    </div>
                    <div class="row">
                        <div id="no-more-tables">
                            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                    <tr class="group_item_table">
                                        <th>ID</th>
                                        <th class="numeric">Name</th>
                                        <th class="numeric">Created at</th>
                                        <th class="numeric">Updated at</th>
                                        <th class="numeric">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in list_types" class="group_item_table">
                                        <td v-text="index"></td>
                                        <td v-text="_.get(item,'name','')" class="numeric"></td>
                                        <td v-text="formartDate(item.created_at)" class="numeric"></td>
                                        <td v-text="formartDate(item.updated_at)" class="numeric"></td>
                                        <td class="numeric">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle bg-success" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li @click="edit(item.id)"><a class="dropdown-item">Sửa</a></li>
                                                    <li @click="remove(item.id)"><a class="dropdown-item">Xóa</a></li>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới</h5>
                                    <!-- <button @click="hideModal" type="button" class="btn-close" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body">
                                    <form class="form" action="">
                                        <div class="form-group">
                                            <label class="label-input text-dark" for="username">Tên danh mục</label>
                                            <input v-model="item_new.name" id="item_new.email" class="form-input"
                                                type="text">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button @click="addNew" type="button" class="btn btn-primary bg-success">Save</button>
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
                                    <button @click="hideModal" type="button" class="btn-close" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" action="">
                                        <div class="form-group">
                                            <label class="label-input text-dark" for="username">Tên danh mục</label>
                                            <input v-model="item_edit.name" id="item_new.email" class="form-input"
                                                type="text">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="addNew">Close</button> -->
                                    <button @click="saveEdit" type="button"
                                        class="btn btn-primary bg-success">Save</button>
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
                    list_types: [],
                    item_new: {},
                    item_edit: {
                        name: '',
                    },
                    id_changes: '',
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
                        axios.get(`/api/type`, {

                            })
                            .then(response => {
                                console.log('123', response.data);
                                vm.list_types = response.data;
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

                }
            })

        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer_admin')
@endsection
