<template>
<span :class="'label label-' + color"><slot>null</slot></span>
</template>

<script>
    export default {
        props: {
            color: {
                type: String,
                default: 'success'
            }
        }
    }
</script>