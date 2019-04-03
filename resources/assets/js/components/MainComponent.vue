<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 mb-2">
            <div class="mb-4" v-for="post in posts">
                <div class="post-container">
                    <div class="img-wrap">
                        <a :href="'/post/' + post.id"><img :src="post.main_img" class="img-post"></a>
                    </div>
                    <div class="link-n-time">
                        <div class="post-info">
                            <div class="post-categories"><span class="category">Review</span></div>
                            <span class="post-hint">Author: Alan Simons / 24.03.2019</span>
                        </div>
                    </div>
                    <h2 v-html="post.title"></h2>
                    <div class="short-description-block" v-html="post.content"></div>
                    <div class="lnk-btn">
                        <a :href="'/post/' + post.id">Read more</a>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-3">
                <div class="category-list">
                    <span v-for='category in categories'>{{category}}</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button type="button" class="btn btn-primary" @click="update">Получить еще</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                posts: [],
                categories: ['review','projects','discuss','posts'],
                is_refresh: false,
                last_id: 0
            }
        },
        props:[
            'post_list'
        ],
        mounted() {
            var post_list = this.post_list;
            this.last_id = post_list[post_list.length-1].id;
            this.posts = post_list;
        },
        methods: {
            update: function() {
                this.is_refresh = true;
                if(this.last_id != 0){
                    axios.post('/get-json-posts',{
                        last_id : this.last_id
                    }).then((response) => {
                        let posts = response.data;
                        let last_id = posts[posts.length-1].id;
                        let count_elem = posts.length;
                        if(last_id > 0){
                            this.is_refresh = true;
                            for(var key in posts){
                                this.posts.push(posts[key]);
                            }
                            this.last_id = last_id;
                        }
                    })
                }
            }
        }
    }
</script>
