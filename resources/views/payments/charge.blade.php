<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>@lang('payment.invoice')</title>
    
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

    .text-center {
        text-align: center;
        margin-top: 40px;
    }

    a {
        color: #333;
        text-decoration: none;
        padding: 10px 15px;
        border: 1px solid #eee;
        border-radius: 5px;
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
        <div class="noti noti-success">
            @lang('payment.successful')
        </div>
        @else
        <div class="noti noti-danger">
            @lang('payment.unsuccessful') <b>{{ $response->State }}</b>
        </div>
        @endif
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                {{ HTML::image('images/logo.png') }}
                            </td>
                            
                            <td>
                                #<b>{{ $payment->id }}</b> :@lang('payment.invoice')<br>
                                {{ $payment->created_at->toDateString() }} :@lang('payment.date')<br>
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
                            
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    {{ $response->ResNum }}
                </td>
                
                <td>
                    @lang('payment.resNo')
                </td>
            </tr>
            
            @if (@isset($response->RefNum))
            <tr class="item">
                <td>
                    {{ $response->RefNum }}
                </td>
                
                <td>
                    @lang('payment.ref')
                </td>
            </tr>
            @endif
            
            @if (@isset($response->TraceNo))
            <tr class="item">
                <td>
                    {{ $response->TraceNo }}
                </td>
                
                <td>
                    @lang('payment.trackNo')
                </td>
            </tr>
            @endif

            @if (@isset($response->TraceNo))
            <tr class="item">
                <td>
                    {{ $response->CustomerRefNum }}
                </td>
                
                <td>
                    @lang('payment.refNum')
                </td>
            </tr>
            @endif

            <tr class="item">
                <td>
                    @if ($response->State == 'OK')
                        <span class="label label-success">@lang('payment.successful')</span>
                    @else
                         <span class="label label-fail">@lang('payment.unsuccessful') {{ $response->State }}</span>
                    @endif
                </td>
                
                <td>
                    @lang('payment.status')
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
        @if ($href != '#')
        <p class="text-center">
            <a href="{{ $href }}">@lang('payment.back')</a>
        </p>
        @endif
    </div>
</body>
</html>