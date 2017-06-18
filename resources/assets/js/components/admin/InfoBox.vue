<template>
<div class="info-box">
  <span :class="'info-box-icon bg-' + color"><i :class="icon"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">{{ text }}</span>
    <span class="info-box-number"><small>{{total}}</small> {{ number }} </span>
  </div>
</div>
</template>


<script>
    export default {
        props: {
            text: {
                type: String
            },
            number: {
                type: String,
            },
            total: {
                type: String,
                default: '',
            },
            color: {
                type: String,
            },
            icon: {
                type: String,
            }
        }
    }
</script>
