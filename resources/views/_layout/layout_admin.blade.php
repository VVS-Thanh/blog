<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick/slick-theme.css') }}">

    <script src="https://unpkg.com/vue@2"></script>
    <script src="https://unpkg.com/jquery@3.1.1/dist/jquery.js"></script>
    <script src="https://unpkg.com/select2@4.0.3/dist/js/select2.js"></script>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/select2@4.0.3/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/web/index.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/layout/logo.png') }}" type="images/x-icon">

    <title>IT Blog</title>
</head>
<?php header('Access-Control-Allow-Origin: *'); ?>

<body>


    @yield('menu')
    <main>
        @yield('content')
    </main>
    @yield('footer')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('slick/slick/slick.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            let app = new Vue({
                el: '#header',
                data: {
                    name: '',
                    user_flag: false,
                    user_data: {},
                    user_data_local_storage: {},
                    errorMessage: '',
                    successMessage: '',
                    keywords: '',
                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;
                    const rawData = localStorage.getItem("user");
                    vm.user_data_local_storage = JSON.parse(rawData);
                    console.log(vm.user_data_local_storage.data.user);
                    // console.log(vm.user_data_local_storage.data.user.name);
                    vm.user_data = vm.user_data_local_storage.data.user;
                    if (vm.user_data != [] && vm.user_data.role_id == 2) {
                        vm.user_flag = true;
                        console.log('có user');

                    } else {
                        return window.location.href = '{{route('dashboard')}}' + '/' + 'login';
                        vm.user_flag = false;
                        console.log('không user');
                    }
                    // console.log(rawData);
                    // vm.postPost();
                },
                methods: {

                    logOut: function() {
                        let vm = this;
                        window.localStorage.removeItem('token');
                        window.localStorage.removeItem('user');
                        window.localStorage.removeItem('redirect_url');
                        vm.redirectLoginPage();
                        alert('logout success')
                    },
                    redirectLoginPage: function() {
                        return window.location.href = '{{route('dashboard')}}' + '/' + 'login';
                    },
                    redirectProfile(id) {
                    let vm = this;
                    // localStorage.setItem("data_click", JSON.stringify(vm.saving_data.id));
                    // console.log(vm.saving_data);
                    window.location.href = '{{ route('profile') }}/' + id;
                    },
                    redirectSearch(keyword) {
                        let vm = this;
                        window.location.href = '{{ route('list_blog_search') }}/' + keyword;
                        console.log(keyword);
                    },
                }
            })
        })
    </script>



</body>



</html>
