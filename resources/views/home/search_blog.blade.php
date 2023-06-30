@extends('_layout.layout')
@section('menu')
    @includeIf('_partials.menu')
@endsection
@section('content')
    <section id="list_search" class="profile position-relative search_list">
        <div class="container">
            <div v-for="(item,index) in list_data" class="list_main_blog ">
                <div class="blog_card">

                    <div class="blog_card_left">
                        <img style="cursor: pointer" @click="show_detail_blog(item.id)" :src="item.thumbnail_image"
                            alt="">
                    </div>
                    <div class="blog_card_right">
                        <div class="blog_card_right_user">
                            <img :src="item.user.profile.avatar" @click="redicrectProfileUser(item.user.id)" alt="avatar">
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
                </div>
            </div>

        </div>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let app = new Vue({
                el: '#list_search',
                data: {
                    text: '213123',
                    username: '',
                    password: '',
                    postBody: '',
                    errors: [],
                    list_user_blog: {},
                    list_data: [],
                    list_format_all_post: [],
                    list_all_posts: [],
                    saving_data: [
                        data = {},
                    ],
                    id_delete: '',
                    me: [],
                    keyword: '{{ $keyword }}'
                },
                created() {
                    let vm = this;
                },

                mounted() {
                    let vm = this;
                    vm.getAllPost();
                },
                methods: {
                    getAllPost() {
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
                        axios.get(`/api/post?keyword=` + vm.keyword, {
                                keyword: vm.keyword
                            })
                            .then(response => {
                                let data = response.data.map((value, index) => {
                                    return {
                                        contents: vm.extractContent(value.contents).substring(0,
                                            50),
                                        topic: vm.extractContent(value.topic).substring(0, 50),
                                        id: value.id,
                                        created_at: value.created_at,
                                        updated_at: value.updated_at,
                                        like: value.like,
                                        type_of_post: value.type_of_post,
                                        thumbnail_image: value.thumbnail_image,
                                        id: value.id,
                                        user: value.user,
                                        // user_id: value.user_id,
                                    }
                                })
                                vm.list_data = data;
                                console.log('data', data);
                            })
                            .catch(e => {
                                this.errors.push(e)

                            })
                    },
                    pushId(id) {
                        let vm = this;
                        vm.id_delete = id;
                    },
                    extractContent(html) {
                        return new DOMParser().parseFromString(html, "text/html").documentElement
                            .textContent;

                    },
                    formatDate(date) {
                        return moment(date).format('DD / MM / YYYY');
                    },
                    formartDate(date) {
                        let vm = this;
                        return moment(date).format('DD-MM-YYYY');
                    },
                    viewMoreDetail(id) {
                        let vm = this;
                        window.location.href = '{{ route('blog_detail') }}/' + id;
                    },
                    viewTypeKeywords(name) {
                        let vm = this;
                        window.location.href = '{{ route('list_blog_search') }}/' + name;
                    },
                    show_detail_blog(id) {
                        window.location.href = '{{ route('blog_detail') }}/' + id;
                    }
                }
            })

        })
    </script>
@endsection
@section('footer')
    @includeIf('_partials.footer')
@endsection
