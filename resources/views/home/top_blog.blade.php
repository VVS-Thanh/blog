@extends('_layout.layout')
@section('menu')
    @includeIf('_partials.menu')
@endsection
@section('content')
    <section id="trial" class="home">
        <div class="other-blog pt-5">
            <div class="container">
                <div class="list_head_blog">
                    <h2 class="head-title">DANH SÁCH BÀI VIẾT NỔI BẬT</h2>

                    <!-- <button @click="add_new" class="btn_add_new">
                                                Thêm bài viết mới
                                            </button> -->
                </div>
                <div v-for="(item,index) in list_hot_slider" class="list_main_blog ">
                    <div class="blog_card">

                        <div class="blog_card_left">
                            <img style="cursor: pointer" @click="show_detail_blog(item.id)" :src="item.thumbnail_image"
                                alt="">
                        </div>
                        <div class="blog_card_right">
                            <div class="blog_card_right_user">
                                <img src="images/layout/logo.png" @click="redicrectProfileUser(item.user.id)"
                                    alt="avatar">
                                <span class="blog_card_right_user_name" @click="redicrectProfileUser(item.user.id)"
                                    v-text="item.user.name">name</span>
                                <span class="blog_card_right_user_created" @click="redicrectProfileUser(item.user.id)"
                                    v-text="item.created_at">ngày thêm vào</span>
                            </div>
                            <div class="blog_card_right_detail">
                                <div class="block_type">
                                    <span @click="viewTypeKeywords(value.name)" v-for="(value,index) in item.type_of_post"
                                        v-text="value.name" class="type_item">ReactJs</span>
                                </div>
                                <span @click="show_detail_blog(item.id)" class="blog_card_right_detail_title"
                                    v-text="item.topic"></span>
                                <span @click="show_detail_blog(item.id)" class="blog_card_right_detail_content"
                                    v-text="item.contents"></span>
                            </div>
                        </div>
                        <!-- <div class="btn-group btn-list-data-group">
                                                <button type="button" class="btn dropdown-toggle btn-data-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item " href="#">Sữa</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item " href="#">Xóa</a>
                                                </div>
                                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {

            $('.group-left-slider').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true

            });
            $('.head-group').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
            });
            $('.head-group-2').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                prevArrow: $('.prev-1'),
                nextArrow: $('.next-1'),
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let app = new Vue({

                el: '#trial',
                data: {
                    list_posts: [],
                    errors: [],
                    item_post: {
                        content: ''
                    },

                    user_credentials: {
                        avatar: 'https://unsplash.it/100/100'
                    },
                    content: '<h1>Some initial content</h1>',
                    list_all_posts: [1, 2, 3, 4],
                    list_text_all_post: [1, 2, 3],
                    list_hot_slider: [1, 2, 3],
                    list_format_all_post: [],
                    list_hot_all_post: [],
                    list_data: [],


                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;
                    localStorage.removeItem("data_click");

                    vm.getAllBlog();
                    console.log(vm.extractContent('<h1>Some initial content</h1>'));
                },
                methods: {
                    getAllBlog() {
                        let vm = this;

                        const headers = {
                            Authorization: `Bearer ${vm.token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        };

                        axios.get(`api/post`, {
                                // token: vm.token
                            })
                            .then(response => {
                                vm.list_all_posts = response.data;
                                vm.list_sort_posts = response.data;
                                const sortedArray = vm.list_sort_posts.sort(function(a, b) {
                                    return new Date(b.created_at || b.updated_at) - new Date(a
                                        .created_at || a.updated_at);
                                });
                                const sortedLikeArray = vm.list_all_posts.sort(function(a, b) {
                                    return b.likes.length - a.likes.length;
                                });
                                let slider_new_arr = sortedArray.map((value, index) => {
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
                                        id: value.id,
                                        user: value.user,
                                        user_id: value.user_id,
                                    }
                                })
                                let all_post_arr = sortedArray.map((value, index) => {
                                    return {
                                        contents: vm.extractContent(value.contents).substring(0,
                                            50),
                                        topic: vm.extractContent(value.topic).substring(0, 50),
                                        id: value.id,
                                        created_at: vm.formartDate(value.created_at),
                                        updated_at: vm.formartDate(value.updated_at),
                                        like: value.like,
                                        type_of_post: value.type_of_post,
                                        thumbnail_image: value.thumbnail_image,
                                        id: value.id,
                                        user: value.user,
                                        user_id: value.user_id,
                                    }
                                })
                                let all_data = sortedLikeArray.map((value, index) => {
                                    return {
                                        contents: vm.extractContent(value.contents).substring(0,
                                            50),
                                        topic: vm.extractContent(value.topic).substring(0, 50),
                                        id: value.id,
                                        created_at: vm.formartDate(value.created_at),
                                        updated_at: vm.formartDate(value.updated_at),
                                        like: value.like,
                                        type_of_post: value.type_of_post,
                                        thumbnail_image: value.thumbnail_image,
                                        id: value.id,
                                        user: value.user,
                                        user_id: value.user_id,
                                    }
                                })
                                let list_all_data = vm.list_all_posts.map((value, index) => {
                                    return {
                                        contents: vm.extractContent(value.contents).substring(0,
                                            50),
                                        topic: vm.extractContent(value.topic).substring(0, 50),
                                        id: value.id,
                                        created_at: vm.formartDate(value.created_at),
                                        updated_at: vm.formartDate(value.updated_at),
                                        like: value.like,
                                        type_of_post: value.type_of_post,
                                        thumbnail_image: value.thumbnail_image,
                                        id: value.id,
                                        user: value.user,
                                        user_id: value.user_id,
                                    }
                                })

                                vm.list_format_all_post = all_post_arr.splice(0, 3);
                                vm.list_text_all_post = slider_new_arr.splice(1, 3);



                                vm.list_hot_slider = all_data.slice(0, 3);
                                vm.list_hot_all_post = all_data.slice(0, 3);
                                vm.list_data = list_all_data.splice(0, 10);
                                console.log(vm.list_text_all_post);
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },
                    redicrectProfileUser(id) {
                        let vm = this;
                        window.location.href = '{{ route('profile_user') }}/' + id;

                    },
                    viewTypeKeywords(name) {
                        let vm = this;
                        window.location.href = '{{ route('list_blog_search') }}/' + name;
                    },
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
                    show_detail_blog(id) {
                        let vm = this;
                        window.location.href = '{{ route('blog_detail') }}/' + id;
                    },

                }
            })
        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer')
@endsection
