<template>
    <div class="form-group">
        <label :for="id">{{ label }}</label>
        <input :type="type" :class="className" :id="id" :placeholder="placeholder" :name="name">
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                type: String
            },
            type: {
                type: String,
                default: 'text'
            },
            id: {
                type: String
            },
            placeholder: {
                type: String,
                default: ''
            },
            className: {
                type: String,
                default: 'form-control'
            },
            name: {
                type: String
            }
        }
    }
</script>
