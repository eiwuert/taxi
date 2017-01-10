<template>
    <button :type="type" :class="'btn btn-danger ' + addClass"><i :class="'fa fa-' + icon"></i> {{ text }}</button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit'
            },
            addClass: {
                type: String,
                default: ''
            },
            text: {
                type: String,
                default: ''
            },
            icon: {
                type: String,
                default:''
            }
        }
    }
</script>