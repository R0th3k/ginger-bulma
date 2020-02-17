<template>
  <form @submit.prevent="submit" class="p-2 mb-4 mt-4">

    <div class="field">
      <label for="name">Nombre *</label>
      <input type="text" class="input is-rounded" 
      :class="{'is-invalid' : $v.name.$error , 'is-valid' : $v.name.required && !$v.name.$invalid}"
      id="name"  v-model="$v.name.$model">
    </div>

    <div class="field">
      <label for="email">Email *</label>
      <input type="email" class="input is-rounded" 
      :class="{'is-invalid' : $v.email.$error, 'is-valid' : !$v.email.$error && $v.email.required}" 
      id="email"  v-model="$v.email.$model">
      <small class="c-danger" v-if="!$v.email.email ">Asegurate de escribir un email correcto</small>
      
    </div>

    <div class="field">
      <label for="phone">Teléfono</label>
      <input type="tel" class="input is-rounded" 
      :class="{'is-invalid' : $v.phone.$model.length >= 1 && $v.phone.$model.length <= 9, 'is-valid': $v.phone.$model.length >=10}" id="phone"  v-model="$v.phone.$model">

      <small class="c-danger" v-if="!$v.phone.minLength">Minimo 10 digitos</small>
    </div>

    <div class="field">
      <label for="subject">Asunto *</label>
      <input type="text" class="input is-rounded" :class="{'is-invalid' : $v.subject.$error , 'is-valid' : $v.subject.required && !$v.subject.$invalid}" id="subject"  v-model="$v.subject.$model">
    </div>

    <div class="field">
      <label for="message">Tu mensaje *</label>
      <textarea class="textarea" :class="{'is-invalid' : $v.message.$error , 'is-valid' : $v.message.required && !$v.message.$invalid}" id="message" rows="3" v-model="$v.message.$model"></textarea>
    </div>
    

    <div class="notification is-warning is-light" v-if="emptyFields">
      Asegurate de llenar todos los campos requeridos
    </div>
    <div class="notification is-success is-light" v-if="sent">
      Gracias por tu mensaje, en breve te responderé.
    </div>

  

    <button type="submit" class="button is-primary is-rounded is-inverted is-outlined is-large" v-if="!sent">Enviar mensaje </button>
    <button class="button is-loading is-rounded" v-if="sending"></button>
    <button type="submit" class="button is-primary is-rounded is-inverted is-outlined is-large" v-if="sent" disabled>Enviar mensaje </button>


    

  </form>
</template>

<script>
  import { required, email, minLength  } from 'vuelidate/lib/validators';
  export default{
    name:'contact',
    data(){
      return{
        name:'',
        email:'',
        phone:'',
        subject:'',
        message:'',
        emptyFields:false,
        sending:false,
        sent:false,
      }
    },
    validations: {
      name: {
        required, 
      },
      email:{
        required,
        email
      },
      phone:{
        minLength: minLength(10),
      },
      subject:{
        required,
      },
      message:{
        required,
      },
    },
    methods:{
      success(){
        this.sent = true;
      },
      warning(response){
        alert(response);
      },
      send(){
          const axios = require('axios');
          const self = this;
          axios.post(this.url+'templates/includes/sendMail.php', {
          name: this.$v.name.$model,
          email: this.$v.email.$model,
          phone: this.$v.phone.$model,
          subject: this.$v.subject.$model, 
          message: this.$v.message.$model
        })
        .then(function (response) {
          console.log(response);
          self.success();
          //this.success = 'Data saved successfully';
        })
        .catch(function (error) {
          console.log(error);
          self.warning(response);
          //this.response = 'Error: ' + error.response.status
        });
      },
      submit() {
        this.$v.$touch()
        if (this.$v.$invalid) {
          this.emptyFields = true;
        } else {
          this.sending = true;
          setTimeout(() => {
            this.sending = false;
            this.send();
          }, 500)
        }
      },
      
      }
    }
  
</script>

<style lang="scss" scoped>
  
</style>