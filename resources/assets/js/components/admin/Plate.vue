<template>
<div id="plate">
    <img :src="plate" class="img-responsive center-block">
    <div class="plate">
        <div class="platePart1"><span>{{ platePart1 }}</span></div>
        <div class="platePart2"><span>{{ platePart2 }}</span></div>
        <div class="platePart3"><span>{{ platePart3 }}</span></div>
        <div class="platePart4"><span>{{ platePart4 }}</span></div>
    </div>
    <div class="form-group plate-form">
        <div class="col-sm-3">
            <input maxlength="2" v-model="platePart1" name="platePart1" class="form-control">
        </div>
        <div class="col-sm-3">
            <input maxlength="1" v-model="platePart2" name="platePart2" class="form-control">
        </div>
        <div class="col-sm-3">
            <input maxlength="3" v-model="platePart3" name="platePart3" class="form-control">
        </div>
        <div class="col-sm-3">
            <input maxlength="2" v-model="platePart4" name="platePart4" class="form-control">
        </div>
    </div>
</div>
</template>

<script>
export default {
  props: {
    parts: {
      type: String
    },
      plate: {
        type: String
    }
  },
  data: function () {
    return {
      platePart1: '',
      platePart2: '',
      platePart3: '',
      platePart4: '',
      parsedParts: ''
    }
  },
  mounted: function () {
    this.parsedParts = JSON.parse(this.parts)
    this.platePart1 = this.parsedParts[0]
    this.platePart2 = this.parsedParts[1]
    this.platePart3 = this.parsedParts[2]
    this.platePart4 = this.parsedParts[3]
  }
}
</script>

<style>
#plate {
    text-align: center;
    color: #2c3e50;
}
.plate {
    position: relative;
    top: -165px;
    font-size: 70px;
    width: 600px;
    margin: 0 auto;
}
div.platePart1,
div.platePart2,
div.platePart3,
div.platePart4 {
    font-family: IRANSans !important;
    direction: rtl;
    display: inline-block;
    margin-top: 60px;
    margin-bottom: -140px;
}
div.platePart1 {
    width: 133px;
    float: left;
    margin-left: 59px;
}
div.platePart2 {
    width: 117px;
    text-align: center;
    float: left;
    margin-left: 0px;
}
div.platePart3 {
    width: 110px;
    float: left;
    margin-left: 30px;
}
div.platePart4 {
    width: 128px;
    float: left;
    margin-left: 13px;
}
.plate-form {
    display: inline-block;
}
</style>
