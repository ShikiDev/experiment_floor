<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card mb-3" v-for="project in projects">
              <img class="card-img-top" :src="project.img_url" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{project.title}}</h5>
                <p class="card-text">{{project.description}}a</p>
                <p class="card-text"><small class="text-muted">{{project.created_at}}</small></p>
              </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function(){
            return {
            }
        },
        props:[
            'projects'
        ],
        mounted() {
        }
    }
</script>