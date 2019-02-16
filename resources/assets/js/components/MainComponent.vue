<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default" v-for="post in posts">
                    <div class="card-header">{{post.title}}</div>
                    <div class="card-body" v-html="post.content">
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button class="btn btn-primary" @click="update">Получить еще</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                posts: [],
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
