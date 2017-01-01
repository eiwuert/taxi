<template>
    <button :type="type" :class="'btn btn-primary ' + addClass">{{ text }}</button>
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
            }
        }
    }
</script>