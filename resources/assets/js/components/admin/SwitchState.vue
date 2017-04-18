<template>
<div>
    <button v-show="isOnline"
        class="btn btn-default btn-block btn-sm"
        @click="switchOffline">
        <i class="fa fa-circle text-green"></i> {{ goOnline }}
    </button>
    <button v-show="!isOnline"
        class="btn btn-default btn-block btn-sm"
        @click="switchOnline">
        <i class="fa fa-circle text-orange"></i> {{ goOffline }}
    </button>
</div>
</template>

<script>
  export default {
    data: function () {
        return {
            isOnline: this.online == 1 ? true : false,
        }
    },
    props: {
        goOnline: {
            type: String
        },
        goOffline: {
            type: String
        },
        online: {
            type: String
        },
        driver: {
            type: String
        }
    },
    methods: {
        switchOnline: function () {
            this.$http.post('/fa/admin/drivers/online/' + this.driver).then(response => {
                this.isOnline = !this.isOnline;
            }, response => {
                alert('in trip');
            });
        },
        switchOffline: function () {
            this.$http.post('/fa/admin/drivers/offline/' + this.driver).then(response => {
                this.isOnline = !this.isOnline;
            }, response => {
                alert('in trip');
            });
        }
    }
  }
</script>
