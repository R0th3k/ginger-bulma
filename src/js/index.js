import Vue from 'vue/dist/vue.js'
Vue.config.productionTip = true;

import Axios from 'axios'
Vue.use(Axios)

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)




Vue.mixin({
  data: function() {
      return {
          url:'https://hektor.mx/ginger/',
      }
  },
  created: function() {},
  mounted:function(){ },
  methods:{},
})//end mixin

import HolaMundo from './components/HolaMundo.vue';
import FloatSocial from './components/FloatSocial.vue';
import Contact from './components/Contact.vue';

new Vue({
  el:'#app',
  components:{
    HolaMundo,
    FloatSocial,
    Contact
  },
  data:{
    saludo: 'Ginger Framework',
  },
  methods:{
    
  },
  mounted(){
   
  },
  created(){
    
  },
  watch:{
    
  }
  
})

import './app.js';
