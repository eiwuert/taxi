<template>
<div :class="'form-group has-feedback ' + addClass">
  <input type="email" 
          class="form-control" 
          :placeholder="placeholder" 
          :name="name" 
          :value="value"
          dir="ltr">
  <i class="fa fa-envelope-o form-control-feedback"></i>
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
        default: 'Email'
      },
      name: {
        type: String,
        default: 'email'
      },
      addClass: {
        type: String,
        default: ''
      },
      value: {
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