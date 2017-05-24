<template>
<a class="btn btn-link" :href="href">
    {{ text }}
</a>
</template>

<script>
    export default {
        props: {
            href: {
                type: String,
                default: '/'
            },
            text: {
                type: String,
                default: ''
            }
        }
    }
</script>
