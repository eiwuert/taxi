<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>رسید پرداخت</title>
    
    <style>
    @import url(http://awebfont.ir/css?id=1776);
    .label {
        padding: 3px 7px;
        border-radius: 11px;
        color: #fff;
    }

    .label-success {
        background: #5cb85c;
    }

    .label-fail {
        background: #d9534f;
    }

    .noti {
        direction: rtl;
        text-align: center;
        padding: 15px;
        color: #fff;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .noti-success {
        background: #5cb85c;
    }

    .noti-danger {
        background: #d9534f;
    }

    .noti-warning {
        background: #f0ad4e;
    }

    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'BBCNassim', Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
        font-weight: 200;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        @if ($response->State == 'OK')
        @if ($repeat)
        <div class="noti noti-success">
            شما قبلا هزینه این سفر را پرداخت کرده بودید، مبلغ پرداخت شده به کیف پول شما منتثل شد.
        </div>
        @else
        @if ($amount == 'less')
        <div class="noti noti-danger">
            مبلغ پرداخت شده شما کمتر از هزینه سفر می باشد، مبلغ کنونی پرداخت شده به کیف پول شما منتقل شد.
        </div>
        @elseif ($amount == 'more')
        <div class="noti noti-warning">
            مبلغ پرداختی شما بیشتر از هزینه سفر است، ما به تقاوت هزینه به کیف پول شما منتقل شد.
        </div>
        @else
        <div class="noti noti-success">
            هزینه سفر با موفقیت پرداخت شد.
        </div>
        @endif
        @endif
        @else
        <div class="noti noti-danger">
            پرداخت ناموفق بود. {{ $response->State }}
        </div>
        @endif
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                SAAMTaxi
                            </td>
                            
                            <td>
                                #<b>{{ $payment->id }}</b> :فاکتور<br>
                                {{ $payment->created_at->toDateString() }} :تاریخ<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                شبکه نسل نوین<br>
                                ونک، برج نگار، طبقه ۱۶ واحد ۲<br>
                                تهران، ایران
                            </td>
                            
                            <td>
                                {{ $client->first_name }}<br>
                                {{ $client->last_name }}<br>
                                {{ $client->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    {{ $response->ResNum }}
                </td>
                
                <td>
                    شماره رزرو
                </td>
            </tr>
            
            @if (@isset($response->RefNum))
            <tr class="item">
                <td>
                    {{ $response->RefNum }}
                </td>
                
                <td>
                    شماره ارجاع
                </td>
            </tr>
            @endif
            
            @if (@isset($response->TraceNo))
            <tr class="item">
                <td>
                    {{ $response->TraceNo }}
                </td>
                
                <td>
                    شماره پیگیری
                </td>
            </tr>
            @endif

            @if (@isset($response->TraceNo))
            <tr class="item">
                <td>
                    {{ $response->CustomerRefNum }}
                </td>
                
                <td>
                    شماره ارجاع مشتری
                </td>
            </tr>
            @endif

            <tr class="item">
                <td>
                    @if ($response->State == 'OK')
                        <span class="label label-success">موفق</span>
                    @else
                         <span class="label label-fail">ناموفق | {{ $response->State }}</span>
                    @endif
                </td>
                
                <td>
                    وضعیت پرداخت
                </td>
            </tr>
            
            @if (@isset($response->transactionAmount))
            <tr class="total">
                <td></td>
                
                <td>
                   پرداخت شده: <i>{{ number_format($response->transactionAmount) }}</i> <sup>ریال</sup>
                </td>
            </tr>
            @endif
        </table>
    </div>
</body>
</html>