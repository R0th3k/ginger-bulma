<template>
  <div>
    <h1 class="subtitle">{{title}}</h1>
  </div>
</template>

<script>
  export default{
    name:'hola-mundo',
    data(){
      return{
        title:'Lorem ipsum desde el componente hola-mundo dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
      }
    }
  }
</script>

<style lang="scss" scoped>
  h1{
    color:red;
  }
</style>