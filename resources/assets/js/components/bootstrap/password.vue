<template>
<div :class="'form-group has-feedback ' + addClass">
  <input type="password" 
          class="form-control" 
          :placeholder="placeholder" 
          :name="name"
          dir="ltr">
  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  <span class="help-block" v-show="error != ''">
    <strong v-text="error"></strong>
  </span>
</div>
</template>

<script>
  export default {
    props: {
      placeholder: {
        type: String,
        default: 'Password'
      },
      name: {
        type: String,
        default: 'password'
      },
      addClass: {
        type: String,
        default: ''
      },
      error: {
        type: String,
        default: '',
      }
    }
  }
</script>