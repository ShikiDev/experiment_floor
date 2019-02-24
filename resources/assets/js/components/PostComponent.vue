<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h3>{{post.title}}</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div v-html="post.content"></div>
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
