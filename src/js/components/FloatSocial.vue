<template>
  <div class="fs-buttons on-bottom on-right">
   <!-- extra classes on-top on-left-->

   <a class="fs-button is-twitter" :href="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
   
   <a class="fs-button is-instagram" :href="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
   
   <a class="fs-button is-facebook" :href="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
   
   <a class="fs-button is-whatsapp" :href="'whatsapp://send?text='+ mensaje + '&amp;phone=+52' + telefono"><i class="fab fa-whatsapp"></i></a>
</div>
</template>

<script>
  export default{
    name:'float-social',
    props:{
      twitter:String,
      facebook:String,
      instagram:String,
      mensaje:String,
      telefono:String,
    },
    data(){
      return{
        
      }
    }
  }
</script>

<style lang="scss" scoped>
  .fs-buttons{
  position:fixed;
  width:42px;
  .fs-button{
    display:block;
    width:42px;
    height:42px;
    border-radius:50%;
    overflow:hidden;
    display:flex;
    justify-content: center;
    align-items:center;
    background:silver;
    color:white;
    text-decoration:none;
    margin-top:.5rem;
    transition:all ease-out .25s;
    font-size: 20px;
    a{
      color:white!important;
    }
    &:hover{
      transform:scale(1.10);
      transition:all ease-in .25s;
    }
  }
  &.on-bottom{
    bottom:1rem;
  }
  &.on-right{
    right:1rem;
  }
    &.on-top{
    top:1rem;
  }
  &.on-left{
    left:1rem;
  }
  .is-instagram{
      background:radial-gradient(circle farthest-corner at 35% 90%, #fec564, transparent 50%),radial-gradient(circle farthest-corner at 0 140%, #fec564, transparent 50%),radial-gradient(ellipse farthest-corner at 0 -25%, #5258cf, transparent 50%),radial-gradient(ellipse farthest-corner at 20% -50%, #5258cf, transparent 50%),radial-gradient(ellipse farthest-corner at 100% 0, #893dc2, transparent 50%),radial-gradient(ellipse farthest-corner at 60% -20%, #893dc2, transparent 50%),radial-gradient(ellipse farthest-corner at 100% 100%, #d9317a, transparent),linear-gradient(#6559ca, #bc318f 30%, #e33f5f 50%, #f77638 70%, #fec66d 100%);
      color:white!important;
    } 
  .is-twitter{
    background:#00aced;
    color:white!important;
  }  
  .is-facebook{
    background:#3B5998;
    color:white!important;
  }  
  .is-whatsapp{
    background:#128C7E;
    color:white!important;
  }
}
</style>