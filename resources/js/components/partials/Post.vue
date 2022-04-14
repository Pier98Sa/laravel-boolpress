<template>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-uppercase">{{title}}</h2>
            <img class="img-fluid" :src="img" alt='title'>
            <h3 class="card-text" >{{ category? category.name : '&nbsp;'}}</h3>
            <p class="card-text">{{getSummary(content)}}</p>
            <p> <strong>Autore: </strong>{{author}}</p>
            <router-link class="btn btn-primary" :to="{name: 'single-post', params:{slug: slug} }">See more</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Post',
    props: ['title','category','content','author','slug', 'tags','img'],
    data() {
        return{
            TextLength : 40,
        }
    },
    methods: {
        getSummary(text){
            let testo ;
            if(text.length > this.TextLength){

                testo = text.substring(0, this.TextLength ) + '...';
            }else{
                
                testo =  text;
            }

            return testo
        }
    }
}
</script>

<style>

</style>