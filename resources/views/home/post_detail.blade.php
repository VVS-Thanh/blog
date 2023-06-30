@extends('_layout.layout')
@section('menu')
    @includeIf('_partials.menu')
@endsection
@section('content')
    <section id="post_detail" class="post_detail position-relative">
        {{-- <div v-show="flag_loading == true" class="loading_page">
            <div class="spinner-border text-success loading-spinner" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <div class="container">

            <div class="head_user">
                <div>
                    <span class="head_img">
                        <img src="{{ asset('images/champion/yasuobg.png') }}" alt="">
                    </span>
                </div>
                <div>
                    <span v-text="blog_data.user.name" class="head_name">name user</span>
                    <span class="head_name">----</span>
                    <span class="like_text">Tổng số lượt like</span>
                    <span class="like_text" v-text="count_of_like"></span>
                </div>
                <span>
                    <div v-if="flag_like == false" @click="likePost" class="icon_like"><i
                            class="fa-regular fa-thumbs-up"></i></div>
                    <div v-else @click="likePost" class="icon_like"><i class="fa-solid fa-thumbs-up"></i></i></div>
                </span>
            </div>
            <div class="head-title">
                <h3 class="post_detail_title" v-text="_.get(blog_data,'topic','Tiêu đề')"></h3>
            </div>
            <div class="block_type block_type_detail">
                <span v-for="(item,index) in blog_data.type_of_post" v-text="item.name" class="type_item "></span>
            </div>
            <div class="head-img">
                <img :src="_.get(blog_data, 'thumbnail_image', 'http://dotnetguru.org/wp-content/uploads/2022/02/reactjs.png')"
                    alt="">
            </div>

            <div class="head-content">
                <div class="post_detail_content" v-html="_.get(blog_data,'contents','nội dung')"></div>
            </div>

            <div id="userComment" class="vertical-line"></div>
            <h2 class="head-title">Bình luận</h2>
            <div class="box_comment">
                <textarea v-model="comment" class="comment-text" name="" id="" cols="30" rows="10"></textarea>
                <div class="action_button">
                    <span @click="sendComment" class="type_item button_comment">Send</span>
                </div>
            </div>
            <div class="vertical-line mt-5"></div>
            <h2 class="head-title">Bình luận của bài viết</h2>
            <div v-for="(item,index) in list_comments" class="user_comment">
                <div class="user_comment_profile">
                    <div class="comment_profile_left">
                        <img :src="item.user[0].profile.avatar" alt="">
                    </div>
                    <div class="comment_profile_right">
                        <span v-text="item.user[0].name" class="name"></span>
                        <span class="created_at">
                            <span>Thời gian bình luận:</span>
                            <span v-text="formatDate(item.created_at)"></span>
                        </span>
                    </div>
                </div>
                <div class="vertical-line-comment"></div>

                <div v-text="_.get(item,'content','')" class="user_comment_main">
                </div>
            </div>
            <div>
            </div>
        </div>

        <div class="right_bar_1599">

        </div>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('libs/vue-validate.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            let app = new Vue({
                el: '#post_detail',
                data: {
                    text: '213123',
                    username: '',
                    password: '',
                    postBody: '',
                    errors: [],
                    blog_data: {

                    },
                    list_all_posts: [],
                    id: '{{ $id }}',
                    comment: '',
                    list_comments: [],
                    list_like: [],
                    count_of_like: '',
                    user_data: [],
                    flag_like: false,
                    // flag_loading: false,
                },
                created() {
                    let vm = this;
                },
                mounted() {
                    let vm = this;
                    vm.getAllBlog();
                    vm.checkFlagLike();

                    // vm.getBlogAfterClick();
                },
                methods: {
                    getUser() {
                        let vm = this;

                        var url_string = window.location.href;
                        var url = new URL(url_string);
                        var token = url.searchParams.get("token");
                        const rawData = localStorage.getItem("user") || "[]";
                        vm.auth = JSON.parse(rawData);
                        const headers = {
                            Authorization: `Bearer ${vm.token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        };
                        axios.get(`/api/users/` + vm.blog_data.user.id, {
                                headers: headers,
                                token: vm.token
                            })
                            .then(response => {

                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },
                    formatDate(date) {
                        return moment(date).format('hh:mm:ss - DD-MM-YYYY');
                    },
                    save_post() {
                        let vm = this;
                        console.log('data', vm.item_post.content);
                    },
                    substr(string) {
                        return this.string.substring(0, 8) + ".."
                    },

                    getBlogAfterClick() {
                        let vm = this;
                        vm.blog_data = localStorage.getItem("data_click");

                    },
                    sendComment() {
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
                        axios.post(`/api/post/` + vm.id + '/comment', {
                                headers: headers,
                                token: vm.token,
                                contents: vm.comment,
                            }).then(response => {

                                vm.getAllBlog();
                                // location.reload();
                                // vm.list_all_posts = response.data;
                                // vm.blog_data = vm.list_all_posts.find((value) => {
                                //     if (value.id == vm.id) {
                                //         return value;
                                //     }
                                // })
                                // console.log(vm.list_all_posts);


                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },
                    getAllBlog() {
                        let vm = this;
                        vm.flag_loading = true;
                        var url_string = window.location.href;
                        var url = new URL(url_string);
                        var token = url.searchParams.get("token");
                        const rawData = localStorage.getItem("user") || "[]";
                        vm.auth = JSON.parse(rawData);
                        const headers = {
                            Authorization: `Bearer ${vm.token}`,
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute("content")
                        };
                        axios.get(`/api/post/` + vm.id, {
                                headers: headers,
                                token: vm.token
                            })
                            .then(response => {

                                vm.list_all_posts = response.data;
                                vm.blog_data = response.data;
                                console.log('blog', vm.blog_data);
                                vm.list_comments = response.data.comments;
                                vm.list_likes = response.data.likes;
                                vm.count_of_like = vm.list_likes.length;

                                vm.user_data = vm.auth.data.user;


                                vm.getUser();
                                let checkLiked = vm.list_likes.find((value) => {
                                    if (value.pivot.user_id == vm.user_data.id) {
                                        return value;
                                    }
                                })
                                if (!checkLiked) {
                                    vm.flag_like = false;
                                } else {
                                    vm.flag_like = true;
                                }
                                // setTimeout(() => {
                                //     vm.flag_loading = false;
                                // }, 1000);
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },
                    likePost() {
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
                        axios.post(`/api/post/` + vm.id + '/like', {
                                headers: headers,
                                token: vm.token,
                                contents: vm.comment,
                            }).then(response => {
                                location.reload();
                            })
                            .catch(e => {
                                this.errors.push(e)
                            })
                    },
                    checkFlagLike() {

                    }
                }
            })

        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer')
@endsection
