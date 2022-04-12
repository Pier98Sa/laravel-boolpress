<template>
  <div>
    <MyHeader/>
    <Main/>
    <MyFooter/>
  </div>
</template>

<script>
  import Main from '../components/Main.vue';
  import MyHeader from '../components/MyHeader.vue';
  import MyFooter from '../components/MyFooter.vue';
  
  export default {
    name: 'App',
    components:{
      Main,
      MyHeader,
      MyFooter
    }
  }
</script>

<style>

</style>