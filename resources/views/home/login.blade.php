@extends('_layout.layout')
@section('menu')
    @includeIf('_partials.menu')
@endsection
@section('content')
    <div class="login-cover mt-5">

        <div id="login" class="login">
            <div class="container">
                <div v-if="flag_loading == true" class="spinner-border text-success spinner-login" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="login-logo">
                    <img src="{{ asset('images/layout/logo.png') }}" alt="">
                </div>
                <div class="login-block">
                    <div class="login-title">
                        <span>ĐĂNG NHẬP</span>
                    </div>
                    <div class="login-content">Đăng nhập tài khoản ITBlog</div>
                </div>
                <form class="form" action="">
                    <div class="form-group">
                        <label class="label-input" for="username">Tài khoản</label>
                        <input v-model="username" id="username" class="form-input" type="text">
                    </div>
                    <div class="form-group">
                        <label class="label-input" for="password">Mật khẩu</label>
                        <input v-model="password" id="password" class="form-input" type="password">
                    </div>
                </form>
                <p class="forgot">Quên mật khẩu</p>
                <div class="btn-login">
                    <span @click="login">ĐĂNG NHẬP</span>
                </div>
                <!-- <p class="login-with">Đăng nhập với</p>
                <div class="block-login-with">
                    <div class="block-login-with-fb">
                        <i class="fa-brands fa-facebook"></i>
                    </div>
                    <div class="block-login-with-google">
                        <i class="fa-brands fa-google"></i>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            let app = new Vue({
                el: '#login',
                data: {
                    text: '213123',
                    username: '',
                    password: '',
                    postBody: '',
                    errors: [],
                    flag_loading: false,
                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;
                    // vm.postPost();
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
                    login() {
                        let vm = this;
                        vm.flag_loading = true;
                        axios.post(`api/login`, {
                                email: vm.username,
                                password: vm.password,
                            })
                            .then(response => {
                                vm.flag_loading = false;
                                let result = JSON.stringify(response);
                                localStorage.setItem("user", result);
                                console.log(result);
                                if (response.data.user.role_id == 1) {
                                    window.location.href = '{{ route('dashboard') }}';
                                } else if (response.data.user.role_id == 2) {
                                    window.location.href = '{{ route('admin_user') }}';
                                }
                            }).catch(e => {
                                vm.flag_loading = false;
                                console.log('Error', e.response.data.message)
                            })
                    }

                }
            })

        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer')
@endsection
