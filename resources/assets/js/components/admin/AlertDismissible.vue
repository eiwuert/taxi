<template>
<div :class="'alert alert-dismissible alert-' + alert" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{ message }}
</div>
</template>

<script>
    export default {
        props: {
            alert: {
                type: String,
            },
            message: {
                type: String
            }
        }
    }
</script>

<style>
div.alert-dismissible {
    padding: 8px 10px;
}
</style>