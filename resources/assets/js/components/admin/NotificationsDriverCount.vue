<template>
<li><!-- start notification -->
    <a :href="href">
        <i class="ion-model-s text-aqua"></i> {{ getCount }} new driver registered
    </a>
</li>
<!-- end notification -->
</template>

<script>
    export default {
        props: {
            userId: {
                type: String
            },
            href: {
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
                            if (e.user.role == 'driver') {
                                this.getCount = Number(this.getCount) + 1;
                            }
                        });
            }
        }
    }
</script>
