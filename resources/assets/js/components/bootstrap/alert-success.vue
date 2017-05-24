<template>
<div class="alert alert-success">
    {{ text }}
</div>
</template>

<script>
    export default {
        props: {
            text: {
                type: String
            }
        }
    }
</script>