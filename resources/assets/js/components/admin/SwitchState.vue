<template>
<div>
    <alert-dismissible alert="warning"
        :message="error"
        v-show="hasError"></alert-dismissible>
    <button v-if="isOnline"
        class="btn btn-default btn-block btn-sm"
        :disabled="disabled == 1 ? true : false"
        @click="switchOffline">
        <i class="fa fa-circle text-green"></i> {{ goOnline }}
        <i class="fa fa-circle-o-notch fa-spin fa-fw pull-left" 
            style="margin-top: 3px"
            v-show="disabled == 1"></i>
    </button>
    <button v-else
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
            disabled: 0,
            hasError: false
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
        goOnlineUrl: {
            type: String
        },
        goOfflineUrl: {
            type: String
        },
        error: {
            type: String
        }
    },
    methods: {
        request: function (url) {
            this.disabled = (this.disabled + 1) % 2
            this.$http.post(url).then(response => {
                this.isOnline = !this.isOnline
                this.hasError = false
                this.disabled = (this.disabled + 1) % 2
            }, response => {
                this.hasError = true
                this.disabled = (this.disabled + 1) % 2
            })
        },
        switchOnline: function () {
            this.request(this.goOnlineUrl)
        },
        switchOffline: function () {
            this.request(this.goOfflineUrl)
        }
    }
  }
</script>
