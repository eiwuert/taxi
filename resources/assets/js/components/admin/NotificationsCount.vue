<template>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning">{{ getCount }}</span>
    </a>
</template>

<script>
    export default {
        props: {
            userId: {
                type: String
            },
            count: {
                type: String
            }
        },
        mounted: function () {
            this.listen();
        },
        data: function () {
            return {
                getCount: this.count
            }
        }, 
        methods: {
            listen() {
                Echo.private('App.User.' + this.userId)
                    .listen('UserRegistered', (e) => {
                            this.getCount = Number(this.getCount) + 1;
                        });
            }
        }
    }
</script>
