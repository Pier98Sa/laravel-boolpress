<template>
 <div class="container">
    <div class="row">
      <div class="col-12">
        <div v-if="post">
          <h1>{{post.title}}</h1>
          <img class="img-fluid" :src="post.cover" :alt="post.title">
          <h3 v-if="post.category">Categoria: {{post.category.name}}</h3>
          <p>{{post.content}}</p>

          <p>Tags: </p>
          <ul>
            <li v-for="tag in post.tags" :key="tag.id">
              {{tag.name}}
            </li>
          </ul>
          
        </div>
        
        
      </div>

    </div>

    <div class="row">
      <div class="col">
        <router-link class="btn btn-primary text-uppercase" :to="{name: 'blog'}">Go Back</router-link>
      </div>
    </div>
    
  </div>
</template>

<script>
export default {
  name: 'SinglePost',

  data(){
    return{
      slug : this.$route.params.slug,
      post : null,
    }
  },
  methods: {
    getSinglePost(){
      axios.get('/api/posts/' + this.slug)
      .then(response =>{
        if (response.data.success == false){
          this.$router.push({name: 'errorPage'});
        }else{
          this.post = response.data.result;
        }
      })
    }
  },
  mounted(){
    this.getSinglePost();
  }
}
</script>

<style>

</style>