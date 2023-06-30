@extends('_layout.layout')
@section('menu')
    @includeIf('_partials.menu')
@endsection
@section('content')
    <section style="min-height: 90vh" id="register" class="register-cover">
        <div class="notification mt-5">
            <div :style="flag_success == true ? 'opacity: 1; background: green' : 'background: red'"
                v-if="flag_success == true" class="success">
                <span>Successfully</span>
                <span class="close_notification_success" @click="flag_success = false">X</span>
            </div>
            <div v-show="flag_error == true" class="errors"
                :style="flag_error == true ? 'opacity: 1; background: red' : 'background: green'">
                <span v-text="message_errors"></span>
                <span class="close_notification" @click="flag_error = false">X</span>
            </div>
        </div>
        <div style="padding-top: 200px" class="register">

            <div class="container">
                <div class="login-logo">
                    <img src="{{ asset('images/layout/logo.png') }}" alt="">
                </div>
                <div class="login-block">
                    <div class="login-title">
                        <span>Register</span>
                        <span v-text="message_errors.messages"></span>
                    </div>
                    <div class="login-content">Register for ITBlog</div>
                </div>
                <form class="form" action="">
                    <!-- <div class="form-group">
                                        <label class="label-input" for="full_name">Họ Và Tên</label>
                                        <input v-model="full_name" id="full_name" class="form-input" type="text">
                                    </div> -->
                    <div class="form-group">
                        <label class="label-input" for="email">Email</label>
                        <input v-model="email" id="email" class="form-input" type="text">
                    </div>
                    <div class="form-group">
                        <label class="label-input" for="username">Username</label>
                        <input v-model="username" id="username" class="form-input" type="text">
                    </div>
                    <div class="form-group">
                        <label class="label-input" for="username">Phone</label>
                        <input v-model="phone" id="username" class="form-input" type="text">
                    </div>
                    <div class="form-group">
                        <label class="label-input" for="password">Password</label>
                        <input v-model="password" id="password" class="form-input" type="password">
                    </div>
                    <div class="form-group">
                        <label class="label-input" for="confirm-password">Comfirm Password</label>
                        <input v-model="confirm_password" id="confirm-password" class="form-input" type="password">
                    </div>
                    <div style="flex-direction: row" class="form-group">
                        <label class="label-input" for="confirm">Accept privacy and policy</label>
                        <input style="margin-left:12px" id="confirm" class="form-input" type="checkbox">
                    </div>

                </form>
                <p class="forgot">LOG IN</p>
                <div class="btn-login">
                    <span @click="register">REGISTER</span>
                </div>
                <!-- <p class="login-with">Register with</p>
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
    </section>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let app = new Vue({
                el: '#register',
                data: {
                    text: '213123',
                    full_name: '',
                    firstname: '',
                    lastname: '',
                    username: '',
                    email: '',
                    phone: '',
                    password: '',
                    confirm_password: '',
                    postBody: '',
                    message_errors: '',
                    flag_error: false,
                    flag_success: false,
                    flag_hide: false,
                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;

                },
                methods: {
                    register() {
                        let vm = this;
                        axios.post(`api/register`, {
                                name: vm.username,
                                firstname: vm.firstname,
                                lastname: vm.lastname,
                                email: vm.email,
                                password: vm.password,
                                comfirmPassword: vm.confirm_password,
                                phone: vm.phone,
                                role_id: 1,

                            })
                            .then(response => {
                                console.log('lỗi', response);
                                vm.flag_success = true;
                                window.location.href = '{{ route('login') }}';
                            })
                            .catch(error => {
                                // this.message_errors.push(e)
                                this.flag_error = true;
                                if (error.response) {
                                    // alert(error.response.data.message);
                                    this.message_errors = error.response.data.message;
                                    console.log(this.message_errors);
                                } else if (error.request) {
                                    console.log('request', error.request);
                                } else {
                                    console.log('Error', error.message);
                                }
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
