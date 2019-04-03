<template>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col">
                <div class="post-container one-post-container">
                    <img :src="post.post_main_img" class="main-post-img" />
                    <div class="post-text-wrap">
                        <div class="post-hint-block">
                            <div class="post-info">
                                <div class="post-categories"><span class="category">Review</span></div>
                                <span class="post-hint">Author: Alan Simons / 24.03.2019</span>
                            </div>
                        </div>
                        <h3>{{post.title}}</h3>
                        <div v-html="post.content" class="post-text-block"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                last_id: 0
            }
        },
        props:[
            'post'
        ],
        mounted() {
        },
        methods: {
        }
    }
</script>
