<template>
<label>
    <input type="checkbox" :name="name"> {{ label }}
</label>
</template>
<script>
export default {
    props: {
        name: {
            type: String
        },
        label: {
            type: String,
            default: ''
        }
    }
}
</script>