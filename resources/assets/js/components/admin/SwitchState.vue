<template>
<div>
    <button v-show="isOnline"
        class="btn btn-default btn-block btn-sm"
        :disabled="disabled == 1 ? true : false"
        @click="switchOffline">
        <i class="fa fa-circle text-green"></i> {{ goOnline }}
        <i class="fa fa-circle-o-notch fa-spin fa-fw pull-left" 
            style="margin-top: 3px"
            v-show="disabled == 1"></i>
    </button>
    <button v-show="!isOnline"
        class="btn btn-default btn-block btn-sm"
        :disabled="disabled == 1 ? true : false"
        @click="switchOnline">
        <i class="fa fa-circle text-orange"></i> {{ goOffline }}
        <i class="fa fa-circle-o-notch fa-spin fa-fw pull-left" 
            style="margin-top: 3px"
            v-show="disabled == 1"></i>
    </button>
</div>
</template>

<script>
  export default {
    data: function () {
        return {
            isOnline: this.online == 1 ? true : false,
            disabled: 0
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
            this.disabled = (this.disabled + 1) % 2
            this.$http.post('/fa/admin/drivers/online/' + this.driver).then(response => {
                this.isOnline = !this.isOnline
                this.disabled = (this.disabled + 1) % 2
            }, response => {
                alert('in trip')
                this.disabled = (this.disabled + 1) % 2
            })
        },
        switchOffline: function () {
            this.disabled = (this.disabled + 1) % 2
            this.$http.post('/fa/admin/drivers/offline/' + this.driver).then(response => {
                this.isOnline = !this.isOnline
                this.disabled = (this.disabled + 1) % 2
            }, response => {
                alert('in trip')
                this.disabled = (this.disabled + 1) % 2
            })
        }
    }
  }
</script>
