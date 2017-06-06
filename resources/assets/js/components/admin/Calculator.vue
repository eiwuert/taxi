<template>
<div>
    <h1 class="text-center">{{ this.total() }}</h1>
    <hr>
    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-12">
                <small>{{ entryText }}</small><span class="pull-left formated">{{ this.number_format(theEntry, 0) }}</span>
                <input type="number" class="form-control" dir="ltr" min="0" step="1" v-model="theEntry" :placeholder="entryText">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <small>{{ discountText }}</small><span class="pull-left formated">{{ this.number_format(theDiscount, 0) }} %</span>
                <input type="number" class="form-control" dir="ltr" min="0" max="100" step="1" v-model="theDiscount" :placeholder="discountText">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <small>{{ minText }}</small><span class="pull-left formated">{{ this.number_format(theMin, 0) }}</span>
                <input type="number" class="form-control" dir="ltr" min="0" step="1" v-model="theMin" :placeholder="minText">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3 activate">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" v-model="surcharge"> {{ activateText }}
                    </label>
                </div>
            </div>
            <div class="col-sm-9">
                <small>{{ surchargeText }}</small><span class="pull-left formated">{{ this.number_format(theAmount, 0) }} %</span>
                <input type="number" class="form-control" v-model="theAmount" min="0" step="1" dir="ltr" :placeholder="surchargeText">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <small>{{ perTimeText }}</small><span class="pull-left formated">{{ this.number_format(thePerTime, 0) }}</span>
                <input type="number" class="form-control" v-model="thePerTime" min="0" step="1" dir="ltr" :placeholder="perTimeText">
            </div>
            <div class="col-sm-6">
                <small>{{ timeText }}</small><span class="pull-left formated">{{ this.number_format(theTime, 0) }}</span>
                <input type="number" class="form-control" v-model="theTime" min="0" step="1" dir="ltr" :placeholder="timeText">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <small>{{ perDistanceText }}</small><span class="pull-left formated">{{ this.number_format(thePerDistance, 0) }}</span>
                <input type="number" class="form-control" v-model="thePerDistance" min="0" step="1" dir="ltr" :placeholder="perDistanceText">
            </div>
            <div class="col-sm-6">
                <small>{{ distanceText }}</small><span class="pull-left formated">{{ this.number_format(theDistance, 0) }}</span>
                <input type="number" class="form-control" v-model="theDistance" min="0" step="1" dir="ltr" :placeholder="distanceText">
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: {
            entryText: {
                type: String,
            },
            discountText: {
                type: String,
            },
            minText: {
                type: String,
            },
            surchargeText: {
                type: String,
            },
            perTimeText: {
                type: String,
            },
            perDistanceText: {
                type: String,
            },
            timeText: {
                type: String,
            },
            distanceText: {
                type: String,
            },
            activateText: {
                text: String,
            },
            entry: {
                type: String,
                default: ''
            },
            dicount: {
                type: String,
                default: ''
            },
            min: {
                type: String,
                default: ''
            },
            amount: {
                type: String,
                default: ''
            },
            perTime: {
                type: String,
                default: ''
            },
            time: {
                type: String,
                default: ''
            },
            perDistance: {
                type: String,
                default: ''
            },
            distance: {
                type: String,
                default: ''
            },
        },
        data: function () {
            return {
                theEntry: this.entry,
                theMin: this.min,
                theDiscount: this.distance,
                theAmount: this.amount,
                thePerTime: this.perTime,
                thePerDistance: this.perDistance,
                theTime: this.time,
                theDistance: this.distance,
                surcharge: '',
            }
        },
        methods: {
            number_format: function (number, decimals, dec_point, thousands_sep) {
                // Strip all characters but numerical ones.
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            },
            total: function () {
                var timeValue = 0
                var total = parseInt(this.theEntry) + ((this.theDistance * this.thePerDistance)
                                       + (this.theTime * this.thePerTime))
                total = total * (1 - (this.theDiscount / 100))
                if (this.surcharge == true) {
                    total = total * (1 + (this.theAmount / 100))
                }

                if (total <= this.theMin) {
                    total = this.theMin
                }
                return this.number_format(total, 0)
            }
        }
    }
</script>

<style>
    input[type="checkbox"] {
        margin-right: -20px;
    }
    .activate {
        margin-top: 20px;
    }
    .formated {
        font-size: 10px;
        margin-left: 13px;
    }
</style>
