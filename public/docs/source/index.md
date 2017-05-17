---
title: API Reference

language_tabs:
- bash
- javascript

includes:
    - status
    - fcm

search: true

toc_footers:

---

# Change log

<aside class="notice">
HEAD UP! new changes to API will be here as reference.
</aside>

* Add pusher
* Add contact to call center
* Add states to the client registration 
* Remove 'ar' from lang param in client and driver registration
* Add register, payment and logout flow chart
* Add FCM keys
* Add angle to nearby and `client/trip` routes. angle starts from 6 o'clock in counter clockwise
* Income route for driver
* created_at and updated_at property removed from client and driver profile
* History order fixed (desc)
* Payment updated
* Payment with card removed
* Add trip status on driver set location
* Added payment GET route
* `d2_lat` and `d2_long` added to `v1/client/trip`
* Add payment type to `v1/client/trip`
* Trip ID added to GET `client/trip` API
* pended trip list removed from request API
* New FCM states for payments
* Payment type and status added to current trip API

#Change language

![Image of change language](https://image.ibb.co/cDZJO5/Change_Language.png)

## Client

Change language for client

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/lang/{lang}" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/lang/{lang}",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "Authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/client/lang/{lang}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    lang | string |  required  | Must be 'fa' or 'en'


> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "Success",
            "detail": "Language changed successfully."
        }
    ]
}
```

```json
{
    "success": true,
    "data": [
        {
            "title": "موفق",
            "detail": "زبان با موفقیت تغییر کرد."
        }
    ]
}
```


> Example response - Validation error(s)

```json
{
    "success": false,
    "data": [
        {
            "title": "Failed",
            "detail": "Changing language failed."
        }
    ]
}
```

```json
{
    "success": false,
    "data": [
        {
            "title": "ناموفق",
            "detail": "تغییر زبان ناموفق بود."
        }
    ]
}
```

## Driver

Change language for driver

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/lang/{lang}" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/lang/{lang}",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "Authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/lang/{lang}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    lang | string |  required  | Must be 'fa' or 'en'


> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "Success",
            "detail": "Language changed successfully."
        }
    ]
}
```

```json
{
    "success": true,
    "data": [
        {
            "title": "موفق",
            "detail": "زبان با موفقیت تغییر کرد."
        }
    ]
}
```


> Example response - Validation error(s)

```json
{
    "success": false,
    "data": [
        {
            "title": "Failed",
            "detail": "Changing language failed."
        }
    ]
}
```

```json
{
    "success": false,
    "data": [
        {
            "title": "ناموفق",
            "detail": "تغییر زبان ناموفق بود."
        }
    ]
}
```


#Contact

## Client

contact to call center.

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/contact" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/contact",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "Authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/client/contact`

> Example response

```json
{
    "success": true,
    "data": [
        {
            "head": {
                "phone": "۰۲۱۵۵۵۹۸۷۶۱\r\n۰۹۱۳۱۲۳۴۵۵۴\r\n۰۹۱۳۱۲۳۴۵۵۴\r\n۰۹۱۳۱۲۳۴۵۵۴",
                "address": "خیابان چهارباغ بالا، کوچه نگار، ساختمان، پلاک ۱۰۵"
            },
            "branch": {}
        }
    ]
}
```

## Driver

contact to call center.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/contact" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/contact",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "Authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/contact`

> Example response

```json
{
    "success": true,
    "data": [
        {
            "head": {
                "phone": "۰۲۱۵۵۵۹۸۷۶۱\r\n۰۹۱۳۱۲۳۴۵۵۴\r\n۰۹۱۳۱۲۳۴۵۵۴\r\n۰۹۱۳۱۲۳۴۵۵۴",
                "address": "خیابان چهارباغ بالا، کوچه نگار، ساختمان، پلاک ۱۰۵"
            },
            "branch": {}
        }
    ]
}
```


#Register

![Image of registration](http://1.1m.yt/_R4OUR7.png)

## Client

Initial step for client to register, using phone no. as the primary param
for login and validation.

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/register" \
-H "Accept: application/json" \
    -d "phone"="sunt" \
    -d "login_by"="sunt" \
    -d "lang"="sunt" \
    -d "device_type"="sunt" \
    -d "device_token"="sunt" \
    -d "state"="sunt" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/register",
    "method": "POST",
    "data": {
        "phone": "sunt",
        "login_by": "sunt",
        "lang": "sunt",
        "device_type": "sunt",
        "device_token": "sunt",
        "state": "sunt",
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/client/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    phone | numeric |  required  | Must have a length between `9` and `255`
    login_by | string |  required  | `manual`, `facebook`, `google`
    lang | string |  required  | `fa`, `en`
    device_type | string |  required  | Maximum: `255`
    device_token | string |  required  | Maximum: `255`
    state | numeric |  required  | Maximum: `255`, exists in states
    


#### States

ID | Name | Name
--------- | ------- | -------
    1     | Azerbaijan, East | آذربایجان شرقی
    2     | Azerbaijan, West | آذربایجان غربی
    3     | Ardabil | اردبیل
    4     | Isfahan | اصفهان
    5     | Alborz | البرز
    6     | Ilam | ایلام
    7     | Bushehr | بوشهر
    8     | Tehran | تهران
    9     | Chahar Mahaal and Bakhtiari | چهارمحال و بختیاری
    10    | Khorasan, South | خراسان جنوبی
    11    | Khorasan, Razavi | خراسان رضوی
    12    | Khorasan, North | خراسان شمالی
    13    | Khuzestan  | خوزستان
    14    | Zanjan | زنجان
    15    | Semnan | سمنان
    16    | Sistan and Baluchestan | سیستان و بلوچستان
    17    | Fars | فارس
    18    | Qazvin | قزوین
    19    | Qom | قم
    20    | Kurdistan | کردستان
    21    | Kerman | کرمان
    22    | Kermanshah | کرمانشاه
    23    | Kohgiluyeh and Boyer-Ahmad | کهگیلویه و بویراحمد
    24    | Golestan | گلستان
    25    | Gilan | گیلان
    26    | Luristan | لرستان
    27    | Mazandaran | مازندران
    28    | Markazi | مرکزی
    29    | Hormozgan | هرمزگان
    30    | Hamadan | همدان
    31    | Yazd | یزد


> Example response

```json
{
    "success": true,
    "data": [
        {
            "token_type": "Bearer",
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMwNDI2MTc1NWFiYTc0NjA2YTM3NWQzMGY5YzA2NmM4ZmU2Yjk2YTMyOTRkMWY1MmZmZGNhZGM4MWQzNTBlMjZiOGQ5MTM2MGM4MGRiZmYxIn0.eyJhdWQiOiIyOSIsImp0aSI6IjMwNDI2MTc1NWFiYTc0NjA2YTM3NWQzMGY5YzA2NmM4ZmU2Yjk2YTMyOTRkMWY1MmZmZGNhZGM4MWQzNTBlMjZiOGQ5MTM2MGM4MGRiZmYxIiwiaWF0IjoxNDgxNjE3NjkyLCJuYmYiOjE0ODE2MTc2OTIsImV4cCI6MTc5NzE1MDQ5Miwic3ViIjoiNDQwIiwic2NvcGVzIjpbXX0.rln8f7BLZ7cU2I1YBGCnrpxozhB5mVndacjIaz5zB7jfUxapguk2gx2Fdp9s5dc0628zEze7lmrIzuvBqxn4g9IwsxQhJzLfcw_oGdQN2rz0okraZS30fRspvBJ4FNDeYc4JzkCgxNWHWtIKdj0Jdl8M9IbI1hi0sq6MUh9cjODUMMLLJFb2Jx6oddYiFGBab0YTu98n7aBaJQ2h449fuxBfXlf67I5EZCoiFP20myd8JzteuZaAPQcVasvXTkejakpLLfK7y8OyKhrjti5Qytei73TmltY7NlKzTiYtRIzDTgJtPPPofOFZESha-6JxXFsAQ34--fIfYpFeUrnRHb8BJXfpaA5bzFKsRDSPUvMajlgJr2qDQhLUD9hlumBQDV881JN_V-zt_0QpI6LKOSzD2w4Gp9WQ02_Ib9Co8c57uVheX_vbSGUN2eemM5FTnP3ll9gNU6VgZOPjm8jbzLJ5ziVrxscKIbN5pjf6PSrmi7Jz1Ykl2GZoQiJHrfY5q-TWz-PpcnQu9c8_FnRKH3I9pCradOEZfaQjmMoes_AG8Wr5XyWlg-j930dhp6l5jF4KRKgprR4VMScBkVzyZAmGqdOuOjPPWM0i0uIQEnaJOcMXnjuYEsIcDkKFBo_tjKtbn1joT8W6hTo60Kt6xkjOfFCMn5IqTAwCALaPrGM",
            "expires_at": {
                "date": "2026-12-13 08:18:58.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
}
```


> Example response - Validation error(s)

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```
```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

## Driver

Initial step for driver to register, using phone no. as the primary param
for login and validation.


> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/register" \
-H "Accept: application/json" \
    -d "phone"="eaque" \
    -d "login_by"="manual" \
    -d "lang"="eaque" \
    -d "state"="eaque" \
    -d "country"="eaque" \
    -d "device_token"="eaque" \
    -d "device_type"="eaque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/register",
    "method": "POST",
    "data": {
        "phone": "eaque",
        "login_by": "manual",
        "lang": "manual",
        "state": "manual",
        "country": "manual",
        "device_token": "manual",
        "device_type": "manual"
},
    "headers": {
         "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/driver/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    phone | numeric |  required  | Must have a length between `9` and `255`
    lang | string |  required  | `fa`, `en`
    country | string |  required  |  Maximum: `255`
    state | string |  required  |  numeric
    device_token | string |  required  |  Maximum: `255`
    device_type | string |  required  |  Maximum: `255`
    login_by | string |  required  |  `manual`


#### States

ID | Name | Name
--------- | ------- | -------
    1     | Azerbaijan, East | آذربایجان شرقی
    2     | Azerbaijan, West | آذربایجان غربی
    3     | Ardabil | اردبیل
    4     | Isfahan | اصفهان
    5     | Alborz | البرز
    6     | Ilam | ایلام
    7     | Bushehr | بوشهر
    8     | Tehran | تهران
    9     | Chahar Mahaal and Bakhtiari | چهارمحال و بختیاری
    10    | Khorasan, South | خراسان جنوبی
    11    | Khorasan, Razavi | خراسان رضوی
    12    | Khorasan, North | خراسان شمالی
    13    | Khuzestan  | خوزستان
    14    | Zanjan | زنجان
    15    | Semnan | سمنان
    16    | Sistan and Baluchestan | سیستان و بلوچستان
    17    | Fars | فارس
    18    | Qazvin | قزوین
    19    | Qom | قم
    20    | Kurdistan | کردستان
    21    | Kerman | کرمان
    22    | Kermanshah | کرمانشاه
    23    | Kohgiluyeh and Boyer-Ahmad | کهگیلویه و بویراحمد
    24    | Golestan | گلستان
    25    | Gilan | گیلان
    26    | Luristan | لرستان
    27    | Mazandaran | مازندران
    28    | Markazi | مرکزی
    29    | Hormozgan | هرمزگان
    30    | Hamadan | همدان
    31    | Yazd | یزد
    
> Example response:

```json
{
    "success": true,
    "data": [
        {
            "token_type": "Bearer",
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMwNDI2MTc1NWFiYTc0NjA2YTM3NWQzMGY5YzA2NmM4ZmU2Yjk2YTMyOTRkMWY1MmZmZGNhZGM4MWQzNTBlMjZiOGQ5MTM2MGM4MGRiZmYxIn0.eyJhdWQiOiIyOSIsImp0aSI6IjMwNDI2MTc1NWFiYTc0NjA2YTM3NWQzMGY5YzA2NmM4ZmU2Yjk2YTMyOTRkMWY1MmZmZGNhZGM4MWQzNTBlMjZiOGQ5MTM2MGM4MGRiZmYxIiwiaWF0IjoxNDgxNjE3NjkyLCJuYmYiOjE0ODE2MTc2OTIsImV4cCI6MTc5NzE1MDQ5Miwic3ViIjoiNDQwIiwic2NvcGVzIjpbXX0.rln8f7BLZ7cU2I1YBGCnrpxozhB5mVndacjIaz5zB7jfUxapguk2gx2Fdp9s5dc0628zEze7lmrIzuvBqxn4g9IwsxQhJzLfcw_oGdQN2rz0okraZS30fRspvBJ4FNDeYc4JzkCgxNWHWtIKdj0Jdl8M9IbI1hi0sq6MUh9cjODUMMLLJFb2Jx6oddYiFGBab0YTu98n7aBaJQ2h449fuxBfXlf67I5EZCoiFP20myd8JzteuZaAPQcVasvXTkejakpLLfK7y8OyKhrjti5Qytei73TmltY7NlKzTiYtRIzDTgJtPPPofOFZESha-6JxXFsAQ34--fIfYpFeUrnRHb8BJXfpaA5bzFKsRDSPUvMajlgJr2qDQhLUD9hlumBQDV881JN_V-zt_0QpI6LKOSzD2w4Gp9WQ02_Ib9Co8c57uVheX_vbSGUN2eemM5FTnP3ll9gNU6VgZOPjm8jbzLJ5ziVrxscKIbN5pjf6PSrmi7Jz1Ykl2GZoQiJHrfY5q-TWz-PpcnQu9c8_FnRKH3I9pCradOEZfaQjmMoes_AG8Wr5XyWlg-j930dhp6l5jF4KRKgprR4VMScBkVzyZAmGqdOuOjPPWM0i0uIQEnaJOcMXnjuYEsIcDkKFBo_tjKtbn1joT8W6hTo60Kt6xkjOfFCMn5IqTAwCALaPrGM",
            "expires_at": {
                "date": "2026-12-13 08:18:58.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
}
```

#Verify
 
## Clinet

Verify registered client

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/verify" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "code"="55555" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/verify",
    "method": "POST",
    "data": {
        "code": "amet",
},
    "headers": {
         "accept": "application/json",
         "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/client/verify`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    code | numeric |  required  | length of code: `5`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "Phone verified successfully"
        }
    ]
}
```

> Example response - Already verified

```json
{
    "success": false,
    "data": [
        {
            "title": "You are already verified",
            "detail": "You are verified, there is no need for verify again.",
            "code": 500
        }
    ]
}
```
> Example response - Expired verification code

```json
{
    "success": false,
    "data": [
        {
            "title": "Please ask for verification again",
            "detail": "There is no active code for verifying this phone number.",
            "code": 404
        }
    ]
}
```
> Example response - Wrong code

```json
{
    "success": false,
    "data": [
        {
            "title": "Wrong code",
            "detail": "You have entered wrong verification code, please check your code again.",
            "code": 404
        }
    ]
}
```

> Example response - Too many attemps

```json
{
    "success": false,
    "data": [
        {
            "title": "Exceed attempts tries",
            "detail": "You've entered verification code wrong for too many times.",
            "code": 500
        }
    ]
}
```

## Driver

Verify registered driver

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/verify" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "code"="eaque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/verify",
    "method": "POST",
    "data": {
        "code": "amet",
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/driver/verify`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    code | numeric |  required  | length of code: `5`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "Phone verified successfully"
        }
    ]
}
```

> Example response - Already verified

```json
{
    "success": false,
    "data": [
        {
            "title": "You are already verified",
            "detail": "You are verified, there is no need for verify again.",
            "code": 500
        }
    ]
}
```
> Example response - Expired verification code

```json
{
    "success": false,
    "data": [
        {
            "title": "Please ask for verification again",
            "detail": "There is no active code for verifying this phone number.",
            "code": 404
        }
    ]
}
```
> Example response - Wrong code

```json
{
    "success": false,
    "data": [
        {
            "title": "Wrong code",
            "detail": "You have entered wrong verification code, please check your code again.",
            "code": 404
        }
    ]
}
```

#Resend


## Client

Resend SMS for client

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/resend" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/resend",
    "method": "GET",
    "data": {},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/client/resend`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "SMS code re-sent successfully"
        }
    ]
}
```

> Example response - Already verified

```json
{
    "success": false,
    "data": [
        {
            "title": "You are already verified",
            "detail": "You are verified, there is no need for verify again.",
            "code": 500
        }
    ]
}
```
> Example response - Asked for resend less than 2 minutes ago

```json
{
    "success": false,
    "data": [
        {
            "title": "You have requested for sms before",
            "detail": "You have asked for resending sms less than 2 minutes ago.",
            "code": 500
        }
    ]
}
```

## Driver

Resend SMS for driver

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/resend" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/resend",
    "method": "GET",
    "data": {},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/resend`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "SMS code re-sent successfully"
        }
    ]
}
```

> Example response - Already verified

```json
{
    "success": false,
    "data": [
        {
            "title": "You are already verified",
            "detail": "You are verified, there is no need for verify again.",
            "code": 500
        }
    ]
}
```
> Example response - Asked for resend less than 2 minutes ago

```json
{
    "success": false,
    "data": [
        {
            "title": "You have requested for sms before",
            "detail": "You have asked for resending sms less than 2 minutes ago.",
            "code": 500
        }
    ]
}
```


#Location


## Client V1

Set current location of client.


> Example request

```bash
curl "http://flipapp.ir/api/v1/client/location" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "lat"="neque" \
    -d "long"="neque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/location",
    "method": "POST",
    "data": {
        "lat": "neque",
        "long": "neque",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/client/location`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    lat | string |  required  | 
    long | string |  required  | 


> Example response

```json
{
    "success": true,
    "data": [
            {
                "latitude": "32.637724",
                "longitude": "51.682108",
                "name": "استان اصفهان، اصفهان، خیابان کمال اسماعیل، ایران",
                "user_id": 416,
                "updated_at": "2016-12-10 22:26:25",
                "created_at": "2016-12-10 22:26:25",
                "id": 418
            }
    ]
}

```

> Example response - missing parameter

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```


## Driver V1

Set current location of driver.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/location" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "lat"="atque" \
    -d "long"="atque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/location",
    "method": "POST",
    "data": {
        "lat": "atque",
        "long": "atque",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/driver/location`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    lat | string |  required  | 
    long | string |  required  | 


> Example response

```json
{
    "success": true,
    "data": [
            {
                "latitude": "32.637724",
                "longitude": "51.682108",
                "name": "استان اصفهان، اصفهان، خیابان کمال اسماعیل، ایران",
                "user_id": 416,
                "updated_at": "2016-12-10 22:26:25",
                "created_at": "2016-12-10 22:26:25",
                "id": 418,
                "status": 7
            }
    ]
}

```


> Example response - missing parameter

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```


## Client V2

Set current location of client. in `v2` of API you can send `lng` instead of `long`


> Example request

```bash
curl "http://flipapp.ir/api/v2/client/location" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "lat"="neque" \
    -d "lng"="neque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/client/location",
    "method": "POST",
    "data": {
        "lat": "neque",
        "lng": "neque",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v2/client/location`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    lat | string |  required  | 
    lng | string |  required  | 


> Example response

```json
{
    "success": true,
    "data": [
            {
                "latitude": "32.637724",
                "longitude": "51.682108",
                "name": "استان اصفهان، اصفهان، خیابان کمال اسماعیل، ایران",
                "user_id": 416,
                "updated_at": "2016-12-10 22:26:25",
                "created_at": "2016-12-10 22:26:25",
                "id": 418
            }
    ]
}

```

> Example response - missing parameter

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```


## Driver V2

Set current location of driver. in `v2` of API you can send `lng` instead of `long`

> Example request

```bash
curl "http://flipapp.ir/api/v2/driver/location" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "lat"="atque" \
    -d "lng"="atque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/driver/location",
    "method": "POST",
    "data": {
        "lat": "atque",
        "lng": "atque",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v2/driver/location`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    lat | string |  required  | 
    lng | string |  required  | 


> Example response

```json
{
    "success": true,
    "data": [
            {
                "latitude": "32.637724",
                "longitude": "51.682108",
                "name": "استان اصفهان، اصفهان، خیابان کمال اسماعیل، ایران",
                "user_id": 416,
                "updated_at": "2016-12-10 22:26:25",
                "created_at": "2016-12-10 22:26:25",
                "id": 418,
                "status": null
            }
    ]
}

```


> Example response - missing parameter

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```



# Car types

## Get all

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/car/types" \
-H "Accept: application/json"
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/car/types",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "data": [
            {
                "id": 1,
                "name": "luxury",
                "created_at": "2016-12-09 22:22:17",
                "updated_at": "2016-12-09 22:22:17"
            },
            {
                "id": 2,
                "name": "van",
                "created_at": "2016-12-09 22:22:17",
                "updated_at": "2016-12-09 22:22:17"
            },
            {
                "id": 3,
                "name": "sport",
                "created_at": "2016-12-09 22:22:17",
                "updated_at": "2016-12-09 22:22:17"
            },
            {
                "id": 4,
                "name": "sedans",
                "created_at": "2016-12-09 22:22:17",
                "updated_at": "2016-12-09 22:22:17"
            },
            {
                "id": 5,
                "name": "economy",
                "created_at": "2016-12-09 22:22:17",
                "updated_at": "2016-12-09 22:22:17"
            },
            {
                "id": 6,
                "name": "off-roader",
                "created_at": "2016-12-09 22:22:17",
                "updated_at": "2016-12-09 22:22:17"
            },
            {
                "id": 7,
                "name": "motorcycle",
                "created_at": "2016-12-09 22:22:17",
                "updated_at": "2016-12-09 22:22:17"
            }
    ]
}
```

### HTTP Request
`GET api/v1/client/car/types`


# Profile

## Client

Get client profile data.

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/profile" \
-H "Accept: application/json"
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/profile",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "first_name": null,
            "last_name": null,
            "email": "amir@gmail.com",
            "gender": "not specified",
            "device_token": "kjlfajl",
            "device_type": "ios",
            "lock": false,
            "lang": "fa",
            "address": null,
            "state": null,
            "country": null,
            "zipcode": null,
            "picture": "http://92.222.150.222/saam/public/storage/profile/client/1c192ae561e6c5aa9dd29301728c95de.jpeg",
            "balance": 10,
            "user_id": 3,
            "created_at": "2016-12-25 11:43:19",
            "updated_at": "2016-12-25 11:45:16",
            "phone": "0987897582"
        }
    ]
}
```

### HTTP Request
`GET api/v1/client/profile`


## Balance

Get client balance

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/balance" \
-H "Accept: application/json"
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/balance",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "data": [
        {
            "balance": 100
        }
    ]
}
```

### HTTP Request
`GET api/v1/client/balance`



## Driver

Get driver profile data.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/profile" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/profile",
    "method": "GET",
    "headers": {
       "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "first_name": null,
            "last_name": null,
            "email": null,
            "gender": "not specified",
            "device_token": "kjlfajl",
            "device_type": "ios",
            "online": false,
            "approve": false,
            "available": false,
            "lang": "fa",
            "address": null,
            "state": "esfahan",
            "country": "iran",
            "zipcode": null,
            "picture": "http://92.222.150.222/saam/public/storage/profile/driver/1c192ae561e6c5aa9dd29301728c95de.jpeg",
            "user_id": 3,
            "created_at": "2016-12-25 11:46:36",
            "updated_at": "2016-12-25 11:46:36",
            "phone": "0987897582"
        }
    ]
}
```

### HTTP Request
`GET api/v1/driver/profile`


## Update - Driver

Update `driver` profile data. Returned image is croped 128 by 128 pixels from center.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/profile" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "picture"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/profile",
    "method": "POST",
    "data": {
        "picture": "et"
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/driver/profile`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    picture | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg) Maximum: `512`


> Example response

```json
{
    "success": true,
    "data": [
        {
            "id": 102,
            "first_name": "Amirmasoud",
            "last_name": "Sheidayi",
            "email": "amirmasoud@mysite.com",
            "gender": "male",
            "device_token": "qqqqqqqq5",
            "device_type": "ios",
            "online": true,
            "approve": true,
            "available": true,
            "lang": "fa",
            "address": "Iran",
            "state": "Tehran",
            "country": "Iran",
            "zipcode": "123456",
            "picture": "http://92.222.150.222/saam/public/storage/profile/driver/1c192ae561e6c5aa9dd29301728c95de.jpeg",
            "user_id": 207,
            "created_at": "2017-01-15 06:56:04",
            "updated_at": "2017-01-15 12:41:36",
            "deleted_at": null,
            "phone": "098789000001"
        }
    ]
}
```

> Example response - Validation failed

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "status": 422
        }
    ]
}
```

## Update - Client

Update `client` profile data. Returned image is croped 128 by 128 pixels from center.


> Example request

```bash
curl "http://flipapp.ir/api/v1/client/profile" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
    -d "first_name"="et" \
    -d "last_name"="et" \
    -d "email"="et" \
    -d "gender"="male" \
    -d "lang"="fa" \
    -d "address"="et" \
    -d "state"="et" \
    -d "country"="et" \
    -d "zipcode"="2" \
    -d "picture"="et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/profile",
    "method": "POST",
    "data": {
        "first_name": "et",
        "last_name": "et",
        "email": "et",
        "gender": "male",
        "lang": "fa",
        "address": "et",
        "state": "et",
        "country": "et",
        "zipcode": 2,
        "picture": "et"
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/client/profile`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  optional  | Maximum: `255`
    last_name | string |  optional  | Maximum: `255`
    email | email | optional | Maximum: `255`, Minimum: `6`, `unique`
    gender | string |  optional  | `male`, `female` or `not specified`
    address | string |  optional  | Minimum: `3`
    state | string |  optional  | Minimum: `2` Maximum: `255`
    country | string |  optional  | Minimum: `2` Maximum: `255`
    zipcode | numeric |  optional  | 
    picture | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg) Maximum: `512`


> Example response

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "first_name": null,
            "last_name": null,
            "email": null,
            "gender": "not specified",
            "device_token": "kjlfajl",
            "device_type": "ios",
            "lock": false,
            "lang": "fa",
            "address": null,
            "state": null,
            "country": null,
            "zipcode": null,
            "picture": "no-profile.png",
            "balance": 10,
            "user_id": 1,
            "created_at": "2016-12-25 11:43:19",
            "updated_at": "2016-12-25 11:43:19",
            "phone": "0987897582"
        }
    ]
}
```

> Example response - Validation failed

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```



# Driver


## Go online v1

Make a driver online, when a driver goes online his/her availability will
set to true as well. An approved drvier can go to online mode.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/online" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/online",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "data": [
        {
            "result": "Driver is online."
        }
    ]
}
```

> Example response - currently online

```json
{
    "success": false,
    "data": [
        {
            "title": "Driver cannot go online",
            "detail": "You are currently online.",
            "code": 500
        }
    ]
}
```

### HTTP Request
`GET api/v1/driver/online`


## Go online v2

Make a driver online, when a driver goes online his/her availability will
set to true as well. An approved drvier can go to online mode.

> Example request

```bash
curl "http://flipapp.ir/api/v2/driver/online" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/driver/online",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "data": [
        {
            "title": "Online",
            "detail": "You're online now."
        }
    ]
}
```

> Example response - onway driver

```json
{
    "success": false,
    "data": [
        {
            "title": "Onway",
            "detail": "You're onway."
        }
    ]
}
```

### HTTP Request
`GET api/v2/driver/online`



## Go offline v1

Make a driver offline, when a driver goes offline his/her availability will
set to false as well. An approved drvier can go to offline mode.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/offline" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/offline",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true
}
```

> Example response - currently offline

```json
{
    "success": false,
    "data": [
        {
            "title": "Driver cannot go offline",
            "detail": "An onway or currently online driver cannot go offline.",
            "code": 500
        }
    ]
}
```

### HTTP Request
`GET api/v1/driver/offline`


## Go offline v2

Make a driver offline, when a driver goes offline his/her availability will
set to false as well. An approved drvier can go to offline mode.

> Example request

```bash
curl "http://flipapp.ir/api/v2/driver/offline" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/driver/offline",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "data": [
        {
            "title": "Offline",
            "detail": "You're offline now."
        }
    ]
}
```

> Example response - onway driver

```json
{
    "success": false,
    "data": [
        {
            "title": "Onway",
            "detail": "You're onway."
        }
    ]
}
```

### HTTP Request
`GET api/v2/driver/offline`



## Get status v1

Get status of the driver, Online or Offline

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/status" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/status",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response - Online driver

```json
{
    "success": true,
    "data": [
        {
            "online": true
        }
    ]
}
```

> Example response - Offline driver

```json
{
    "success": true,
    "data": [
        {
            "online": false
        }
    ]
}
```

### HTTP Request
`GET api/v2/driver/status`


## Get status v2

Get status of the driver, Online or Offline

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/status" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/driver/status",
    "method": "GET",
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response - Online driver

```json
{
    "success": true,
    "data": [
        {
            "title": "Online",
            "detail": "You're online"
        }
    ]
}
```

> Example response - Offline driver

```json
{
    "success": false,
    "data": [
        {
            "title": "Offline",
            "detail": "You're offline"
        }
    ]
}
```

### HTTP Request
`GET api/v2/driver/status`


# Car

## Info

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/car/info" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/car/info",
    "method": "GET",
    "headers": {
         "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/driver/car/info`


# Trip - Client

## Request v1


Request new taxi by client

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/trip" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
   -d "s_lat": "maiores", \
   -d "s_long": "maiores", \
   -d "d_lat": "maiores", \
   -d "d_long": "maiores", \ 
   -d "d2_lat": "maiores", \
   -d "d2_long": "maiores", \ 
   -d "payment": "maiores", \ 
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/trip",
    "method": "POST",
    "data": {
        "s_lat": "amet",
        "s_long": "amet",
        "d_lat": "amet",
        "d_long": "amet",
        "d2_lat": "amet",
        "d2_long": "amet",
        "payment": "amet",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/client/trip`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
s_lat | numeric |  required  | 
s_long | numeric |  required  | 
d_lat | numeric |  required  | 
d_long | numeric |  required  | 
d2_lat | numeric |  required with d2_long  | 
d2_long | numeric |  required with d2_lat  | 
payment | string |  optional  | `cash`(default), `card` and `wallet`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "Trip request created successfully, waiting for driver(s) to accept.",
            "eta_text": "8 mins",
            "eta_value": 500,
            "distance_text": "5.1 km",
            "distance_value": 5051,
            "trip_status": 2,
            "source_name": "استان تهران، تهران، بزرگراه شهید حقانی، ایران",
            "destination_name": "استان تهران، تهران، پل پارک وی، ایران"
        }
    ]
}
```

> Example response - Have pending request

```json
{
    "success": false,
    "data": [
        {
            "title": "You have pending request",
            "detail": "Please address your pending trip request at first",
            "code": 500
        }
    ]
}
```

> Example response - cannot find distance


```json
{
    "success": true,
    "data": [
        {
            "title": "Not valid trip",
            "detail": "You cannot trip there!"
        }
    ]
}

```


## Request v2

Request new taxi by client. in `v2` of API you can send `s_lng` instead of `s_long` and
`d_lng` instead of `d_long`

> Example request

```bash
curl "http://flipapp.ir/api/v2/client/trip" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
   -d "s_lat": "maiores", \
   -d "s_lng": "maiores", \
   -d "d_lat": "maiores", \
   -d "d_lng": "maiores", \ 
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/client/trip",
    "method": "POST",
    "data": {
        "s_lat": "amet",
        "s_lng": "amet",
        "d_lat": "amet",
        "d_lng": "amet",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v2/client/trip`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
s_lat | numeric |  required  | 
s_lng | numeric |  required  | 
d_lat | numeric |  required  | 
d_lng | numeric |  required  | 
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "Trip request created successfully, waiting for driver(s) to accept.",
            "eta_text": "8 mins",
            "eta_value": 500,
            "distance_text": "5.1 km",
            "distance_value": 5051,
            "trip_status": 2,
            "source_name": "استان تهران، تهران، بزرگراه شهید حقانی، ایران",
            "destination_name": "استان تهران، تهران، پل پارک وی، ایران"
        }
    ]
}
```

> Example response - Have pending request

```json
{
    "success": false,
    "data": [
        {
            "title": "You have pending request",
            "detail": "Please address your pending trip request at first",
            "code": 500
        }
    ]
}
```

> Example response - cannot find distance


```json
{
    "success": true,
    "data": [
        {
            "title": "Not valid trip",
            "detail": "You cannot trip there!"
        }
    ]
}

```


## Nearby taxis v1

Find near by taxis

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/nearby" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
   -d "lat": "maiores", \
   -d "long": "maiores", \
   -d "distance": "maiores", \
   -d "limit": "maiores", \ 

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/nearby",
    "method": "POST",
    "data": {
        "lat": "amet",
        "long": "amet",
        "distance": "amet",
        "limit": "amet",
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST api/v1/client/nearby`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
lat | numeric |  required  | `(d+).(d+)`
long | numeric |  required  | `(d+).(d+)`
distance | numeric |  min: `1`, max: `5`  | 
limit | numeric |  min: `5`, max: `100`  | 
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "id": 20,
            "distance": "0.245001059497561",
            "longitude": "51.409909",
            "latitude": "35.757580",
            "name": "استان تهران، تهران، میدان ونک، 1517943413، ایران",
            "user_id": 3,
            "angle": 350
        },
        {
            "id": 4,
            "distance": "0.563525245388979",
            "longitude": "51.406401",
            "latitude": "35.757223",
            "name": "استان تهران، تهران، خیابان ملاصدرا، ایران",
            "user_id": 1,
            "angle": 12
        }
    ]
}
```

> Example response - Validation fails

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```



## Nearby taxis v2

Find near by taxis. in `v2` of API you can send `lng` instead of `long`.

> Example request

```bash
curl "http://flipapp.ir/api/v2/client/nearby" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
   -d "lat": "maiores", \
   -d "lng": "maiores", \
   -d "distance": "maiores", \
   -d "limit": "maiores", \ 

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/client/nearby",
    "method": "POST",
    "data": {
        "lat": "amet",
        "lng": "amet",
        "distance": "amet",
        "limit": "amet",
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST api/v2/client/nearby`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
lat | numeric |  required  | `(d+).(d+)`
lng | numeric |  required  | `(d+).(d+)`
distance | numeric |  min: `1`, max: `5`  | 
limit | numeric |  min: `5`, max: `100`  | 
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "id": 20,
            "distance": "0.245001059497561",
            "longitude": "51.409909",
            "latitude": "35.757580",
            "name": "استان تهران، تهران، میدان ونک، 1517943413، ایران",
            "user_id": 3,
            "anlge": 350
        },
        {
            "id": 4,
            "distance": "0.563525245388979",
            "longitude": "51.406401",
            "latitude": "35.757223",
            "name": "استان تهران، تهران، خیابان ملاصدرا، ایران",
            "user_id": 1,
            "angle": 12
        }
    ]
}
```

> Example response - Validation fails

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

## Current

Current state of the client trip.



> Example request

```bash
curl "http://flipapp.ir/api/v1/client/trip" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/trip",
    "method": "GET",
    "data": {
},
    "headers": {
        "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/client/trip`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "paid": false,
            "payment": "to select",
            "driver": {
                "first_name": "Giuseppe",
                "last_name": "Ledner",
                "email": null,
                "gender": "not specified",
                "picture": "no-profile.png",
                "phone": "+3820566651175"
            },
            "trip": {
                "id": 337,
                "eta_value": "144914",
                "eta_text": "1 day 16 hours",
                "distance_value": "3086029",
                "distance_text": "3,086 km",
                "etd_value": "753",
                "etd_text": "13 mins",
                "driver_distance_value": "6299",
                "driver_distance_text": "6.3 km"
            },
            "status": {
                "name": "client_found",
                "value": 2
            },
            "car": {
                "number": "00000",
                "color": "black",
                "type_id": 1
            },
            "type": {
                "name": "luxury"
            },
            "source": {
                "latitude": "35.737758",
                "longitude": "51.481955",
                "name": "استان تهران، تهران، بزرگراه رسالت، ایران"
            },
            "destination": {
                "latitude": "51.650262",
                "longitude": "32.654306",
                "name": "Unnamed Road, Chernihivs'ka oblast, اوکراین"
            },
            "angle": 12,
            "driver_location": {
                "latitude": "35.714693",
                "longitude": "51.481892",
                "name": "NOT SET"
            },
            "total": "2886.8"
        }
    ]
}

```

> Example response - Not on an active trip

```json
{
    "success": false,
    "data": [
        {
            "title": "Not on trip",
            "detail": "Not on an active trip right now",
            "code": 500
        }
    ]
}
```


## Cancel taxi

Cancel taxi by client.


> Example request

```bash
curl "http://flipapp.ir/api/v1/client/cancel" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/cancel",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/v1/client/cancel`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "Trip cancelled.",
            "detail": "Trip status changed from 2 to 10"
        }
    ]
}
```



> Example response - Fail to cancel

```json
{
    "success": false,
    "data": [
        {
            "title": "You cannot do this.",
            "detail": "You cannot cancel your ride on this status.",
            "code": 500
        }
    ]
}

```


## Calculate V1

Calculate trip fare(cost), distance and time. Take care of `NO RESULT` on source and destination.


> Example request

```bash
curl "http://flipapp.ir/api/v1/client/calculate" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
   -d "s_lat": "maiores", \
   -d "s_long": "maiores", \
   -d "d_lat": "maiores", \
   -d "d_long": "maiores", \ 

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/calculate",
    "method": "POST",
    "data": {
        "s_lat": "amet",
        "s_long": "amet",
        "d_lat": "amet",
        "d_long": "amet",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/client/calculate`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
s_lat | numeric |  required  | [+-]?\d+\.\d+
s_long | numeric |  required  | [+-]?\d+\.\d+
d_lat | numeric |  required  | [+-]?\d+\.\d+
d_long | numeric |  required  | [+-]?\d+\.\d+

    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "source": "NO RESULT",
            "destination": "Tehran Province, Tehran, Alami, ایران",
            "distance": {
                "text": "3 m",
                "value": 3
            },
            "duration": {
                "text": "1 min",
                "value": 1
            },
            "transactions": [
                {
                    "car_type": "luxury",
                    "car_type_id": 1,
                    "currency": "USD",
                    "entry": 2,
                    "distance": 3,
                    "per_distance": 0.7,
                    "distance_unit": "kilometer",
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0.3,
                    "time_unit": "minute",
                    "time_value": 0,
                    "surcharge": 1.1,
                    "timezone": "Asia/Tehran",
                    "total": 2.2
                },
                {
                    "car_type": "van",
                    "car_type_id": 2,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "sport",
                    "car_type_id": 3,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "sedans",
                    "car_type_id": 4,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "economy",
                    "car_type_id": 5,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "off-roader",
                    "car_type_id": 6,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "motorcycle",
                    "car_type_id": 7,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                }
            ]
        }
    ]
}
```



> Example response - Fail to fetch data from Google Maps

```json
{
    "success": false,
    "data": [
        {
            "title": "Failed",
            "detail": "Failed to intact with Google Maps",
            "code": 500
        }
    ]
}
```



## Calculate V2

Calculate trip fare(cost), distance and time. Take care of `NO RESULT` on source and destination. in `v2` of API 
you can send `s_lng` instead of `s_long` and `d_lng` instead of `d_long`.


> Example request

```bash
curl "http://flipapp.ir/api/v2/client/calculate" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \
   -d "s_lat": "maiores", \
   -d "s_lng": "maiores", \
   -d "d_lat": "maiores", \
   -d "d_lng": "maiores", \ 

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v2/client/calculate",
    "method": "POST",
    "data": {
        "s_lat": "amet",
        "s_lng": "amet",
        "d_lat": "amet",
        "d_lng": "amet",
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v2/client/calculate`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
s_lat | numeric |  required  | [+-]?\d+\.\d+
s_lng | numeric |  required  | [+-]?\d+\.\d+
d_lat | numeric |  required  | [+-]?\d+\.\d+
d_lng | numeric |  required  | [+-]?\d+\.\d+

    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "source": "NO RESULT",
            "destination": "Tehran Province, Tehran, Alami, ایران",
            "distance": {
                "text": "3 m",
                "value": 3
            },
            "duration": {
                "text": "1 min",
                "value": 1
            },
            "transactions": [
                {
                    "car_type": "luxury",
                    "car_type_id": 1,
                    "currency": "USD",
                    "entry": 2,
                    "distance": 3,
                    "per_distance": 0.7,
                    "distance_unit": "kilometer",
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0.3,
                    "time_unit": "minute",
                    "time_value": 0,
                    "surcharge": 1.1,
                    "timezone": "Asia/Tehran",
                    "total": 2.2
                },
                {
                    "car_type": "van",
                    "car_type_id": 2,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "sport",
                    "car_type_id": 3,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "sedans",
                    "car_type_id": 4,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "economy",
                    "car_type_id": 5,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "off-roader",
                    "car_type_id": 6,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                },
                {
                    "car_type": "motorcycle",
                    "car_type_id": 7,
                    "currency": "USD",
                    "entry": 0,
                    "distance": 3,
                    "per_distance": 0,
                    "distance_unit": 0,
                    "distance_value": 0,
                    "time": 1,
                    "per_time": 0,
                    "time_unit": 0,
                    "time_value": 0,
                    "surcharge": 1,
                    "timezone": "Asia/Tehran",
                    "total": 0
                }
            ]
        }
    ]
}
```



> Example response - Fail to fetch data from Google Maps

```json
{
    "success": false,
    "data": [
        {
            "title": "Failed",
            "detail": "Failed to intact with Google Maps",
            "code": 500
        }
    ]
}
```




# Trip - driver


## Accept ride

Accept ride by driver.


> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/accept" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/accept",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/accept`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "You are onway.",
            "detail": "Trip status changed from 2 to 7"
        }
    ]
}
```

> Example response - Fail accept

```json
{
    "success": false,
    "data": [
        {
            "title": "Fail",
            "detail": "You have no trip to start",
            "code": 500
        }
    ]
}

```

## Start ride

Start the trip by the driver.


> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/start" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/start",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/start`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "Trip started.",
            "detail": "Trip status changed from 2 to 6"
        }
    ]
}
```

> Example response - Fail start

```json
{
    "success": false,
    "data": [
        {
            "title": "Wait",
            "detail": "You still do not have trip, please wait.",
            "code": 500
        }
    ]
}

```

> Example response - Fail start

```json
{
    "success": false,
    "data": [
        {
            "title": "Fail",
            "detail": "You have no trip to start",
            "code": 500
        }
    ]
}

```

## End trip

End the trip by the driver.


> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/end" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/end",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/end`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "Trip ended.",
            "detail": "Trip status changed from 6 to 9"
        }
    ]
}
```

> Example response - Fail start

```json
{
    "success": false,
    "data": [
        {
            "title": "Fail",
            "detail": "You have no trip to end or you cannot end trip now.",
            "code": 500
        }
    ]
}

```

> Example response - Trip has not been paid

```josn
{
    "success": true,
    "data": [
        {
            "title": "Trip ended.",
            "detail": "Trip status changed from 6 to 9, You can rate trip now."
        }
    ]
}
```


## Cancel ride

Cancel trip by driver.


> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/cancel" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/cancel",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/cancel`
    
> Example response - trip cancelled

```json
{
    "success": true,
    "data": [
        {
            "title": "Trip cancelled.",
            "detail": "Trip status changed from 6 to 8"
        }
    ]
}
```

> Example response - trip rejected

```json
{
    "success": true,
    "data": [
        {
            "title": "Trip rejected.",
            "detail": "Trip status changed from 2 to 4"
        }
    ]
}
```



> Example response - Fail to cancel

```json
{
    "success": false,
    "data": [
        {
            "title": "You cannot do this.",
            "detail": "You cannot cancel your ride on this status.",
            "code": 500
        }
    ]
}

```

## Arrive

When drive arrives at departure point.


> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/arrived" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/arrived",
    "method": "GET",
    "data": {},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/arrived`
    
> Example response - driver arrived

```json
{
    "success": true,
    "data": [
        {
            "title": "Waiting for client.",
            "detail": "Trip status changed from 7 to 12."
        }
    ]
}
```


> Example response - Fail to go on arrived status

```json
{
    "success": false,
    "data": [
        {
            "title": "Fail",
            "detail": "You cannot got to this status from your current state",
            "code": 500
        }
    ]
}

```

> Example response - validation failed

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

## Current

Current state of driver trip.



> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/trip" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/trip",
    "method": "GET",
    "data": {
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/trip`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "paid": false,
            "payment": "to select",
            "client": {
                "first_name": "amir",
                "last_name": "amiri",
                "gender": "not specified",
                "picture": "no-profile.png",
                "phone": "+0983832063488"
            },
            "trip": {
                "eta_value": "909",
                "eta_text": "15 mins",
                "distance_value": "14910",
                "distance_text": "14.9 km",
                "etd_value": "434",
                "etd_text": "7 mins",
                "driver_distance_value": "5602",
                "driver_distance_text": "5.6 km"
            },
            "status": {
                "name": "client_found",
                "value": 2
            },
            "source": {
                "latitude": "34.015588",
                "longitude": "51.363886",
                "name": "استان اصفهان، کاشان، بلوار علامه قطب راوندی، ایران"
            },
            "destination": {
                "latitude": "33.946671",
                "longitude": "51.373260",
                "name": "استان اصفهان، کاشان، خیابان امیرکبیر، ایران"
            },
            "total": "5.6"
        }
    ]
}
```

> Example response - Not on an active trip

```json
{
    "success": false,
    "data": [
        {
            "title": "Not on trip",
            "detail": "Not on an active trip right now",
            "code": 500
        }
    ]
}

```

## Income
Get driver income.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/income" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/income",
    "method": "GET",
    "data": {
},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/income`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "income": "0"
        }
    ]
}
```



# Rate

## Driver

Rate of driver to client.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/rate" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/rate",
    "method": "POST",
    "data": {},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/driver/rate`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
stars | numeric |  required  | float between `1.0` to `5.0`
comment | text |  optional  | max: `5000`

    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "Thanks for rating"
        }
    ]
}
```


> Example response - Fail


```json
{
    "success": false,
    "data": [
        {
            "title": "You cannot rate",
            "detail": "You cannot rate this trip",
            "code": 500
        }
    ]
}

```


> Example response - validation failed

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

> Example response - validation failed

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

## Client

Rate of client to driver.

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/rate" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/rate",
    "method": "POST",
    "data": {},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/client/rate`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
stars | numeric |  required  | float between `1.0` to `5.0`
comment | text |  optional  | max: `5000`

    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "title": "Thanks for rating"
        }
    ]
}
```


> Example response - Fail


```json
{
    "success": false,
    "data": [
        {
            "title": "You cannot rate",
            "detail": "You cannot rate this trip",
            "code": 500
        }
    ]
}

```

> Example response - validation failed

```json
{
    "success": false,
    "data": [
        {
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

# Payment

![Image of payment](http://1.1m.yt/pmMfED.png)

## Charge

Charge the wallet/balance with given ClientID and Amount. Client ID (id) can be fetched from `client/profile`

> Example request

```bash
curl "http://flipapp.ir/fa/payment/charge/{CLIENT_ID}/{AMOUNT}" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/fa/payment/charge/{CLIENT_ID}/{AMOUNT}",
    "method": "GET",
    "data": {}
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET http://flipapp.ir/payment/charge/{CLIENT_ID}/{AMOUNT}`


##Pay cash

Pay trip cost in cash. this shall be called by client. take note that this route is bind to `inTrip` and `notPaid` middlewares. keep in mind their responses as well. user cannot revert back to wallet.

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/pay/cash" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/pay/cash",
    "method": "GET",
    "data": {}
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET http://flipapp.ir/api/v1/client/pay/cash`

> Example Response

```json
{
    "success": true,
    "data": [
        {
            "title": "Pay cash",
            "detail": "Please pay trip cost to the driver."
        }
    ]
}

```


##Pay wallet

Pay trip cost by wallet. this shall be called by client. take note that this route is bind to `inTrip` and `notPaid` middlewares. keep in mind their responses as well. In case of not enough balance, user can switch to cash, still.

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/pay/wallet" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/pay/wallet",
    "method": "GET",
    "data": {}
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET http://flipapp.ir/api/v1/client/pay/wallet`

> Example Response

```json
{
    "success": true,
    "data": [
        {
            "title": "Pay wallet",
            "detail": "Your trip paid with your wallet balance."
        }
    ]
}

```


> Example response - not enough balance 

```json

{
    "success": false,
    "data": [
        {
            "title": "Not enough balance",
            "detail": "You don't have enough balance in your wallet."
        }
    ]
}

```


#History

##Client

History of client trips.

> Example request

```bash
curl "http://flipapp.ir/api/v1/client/history" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/client/history",
    "method": "GET",
    "data": {},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/client/history`

    
> Example response

```json

{
    "success": true,
    "data": [
        {
            "id": 7,
            "status_name": "no_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [],
            "rate": [],
            "driver": []
        },
        {
            "id": 8,
            "status_name": "no_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [],
            "rate": [],
            "driver": []
        },
        {
            "id": 9,
            "status_name": "no_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [],
            "rate": [],
            "driver": []
        },
        {
            "id": 11,
            "status_name": "cancel_onway_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [
                {
                    "id": 7,
                    "trip_id": 11,
                    "car_type_id": 1,
                    "entry": "2",
                    "distance": "1289",
                    "per_distance": "0.7",
                    "distance_unit": "kilometer",
                    "distance_value": "0.9",
                    "time": "249",
                    "per_time": "0.3",
                    "time_unit": "minute",
                    "time_value": "1.2",
                    "surcharge": "1",
                    "currency": "USD",
                    "timezone": "Asia/Tehran",
                    "total": "4.1",
                    "created_at": "2017-02-15 12:18:07",
                    "updated_at": "2017-02-15 12:18:07"
                }
            ],
            "rate": [],
            "driver": [
                {
                    "id": 101,
                    "first_name": "Driver",
                    "last_name": "One",
                    "email": "one@email.com",
                    "gender": "male",
                    "device_token": "qqqqqqqq5",
                    "device_type": "ios",
                    "online": false,
                    "approve": true,
                    "available": false,
                    "lang": "fa",
                    "address": "Iran",
                    "state": "tehran",
                    "country": "iran",
                    "zipcode": "12345",
                    "picture": "no-profile.png",
                    "user_id": 207,
                    "created_at": "2017-02-14 14:47:57",
                    "updated_at": "2017-02-16 03:34:28",
                    "deleted_at": null,
                    "car": {
                        "number": "000000",
                        "color": "pink",
                        "type": "luxury"
                    },
                    "phone": "1"
                }
            ],
            "driver_location": [
                {
                    "name": "TEST",
                    "lat": "32.623239",
                    "long": "51.636149"
                }
            ]
        },
        {
            "id": 12,
            "status_name": "trip_is_over",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [
                {
                    "id": 8,
                    "trip_id": 12,
                    "car_type_id": 1,
                    "entry": "2",
                    "distance": "1289",
                    "per_distance": "0.7",
                    "distance_unit": "kilometer",
                    "distance_value": "0.9",
                    "time": "249",
                    "per_time": "0.3",
                    "time_unit": "minute",
                    "time_value": "1.2",
                    "surcharge": "1",
                    "currency": "USD",
                    "timezone": "Asia/Tehran",
                    "total": "4.1",
                    "created_at": "2017-02-15 14:38:43",
                    "updated_at": "2017-02-15 14:38:43"
                }
            ],
            "rate": [
                {
                    "client": "5",
                    "client_comment": "hello"
                }
            ],
            "driver": [
                {
                    "id": 101,
                    "first_name": "Driver",
                    "last_name": "One",
                    "email": "one@email.com",
                    "gender": "male",
                    "device_token": "qqqqqqqq5",
                    "device_type": "ios",
                    "online": false,
                    "approve": true,
                    "available": false,
                    "lang": "fa",
                    "address": "Iran",
                    "state": "tehran",
                    "country": "iran",
                    "zipcode": "12345",
                    "picture": "no-profile.png",
                    "user_id": 207,
                    "created_at": "2017-02-14 14:47:57",
                    "updated_at": "2017-02-16 03:34:28",
                    "deleted_at": null,
                    "car": {
                        "number": "000000",
                        "color": "pink",
                        "type": "luxury"
                    },
                    "phone": "1"
                }
            ],
            "driver_location": [
                {
                    "name": "TEST",
                    "lat": "32.623239",
                    "long": "51.636149"
                }
            ]
        },
        {
            "id": 15,
            "status_name": "no_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [],
            "rate": [],
            "driver": [],
            "driver_location": [
                {
                    "name": "TEST",
                    "lat": "32.623239",
                    "long": "51.636149"
                }
            ]
        },
        {
            "id": 16,
            "status_name": "no_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [],
            "rate": [],
            "driver": [],
            "driver_location": [
                {
                    "name": "TEST",
                    "lat": "32.623239",
                    "long": "51.636149"
                }
            ]
        },
        {
            "id": 19,
            "status_name": "no_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [],
            "rate": [],
            "driver": [],
            "driver_location": [
                {
                    "name": "TEST",
                    "lat": "32.623239",
                    "long": "51.636149"
                }
            ]
        },
        {
            "id": 20,
            "status_name": "no_driver",
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": [],
            "rate": [],
            "driver": [],
            "driver_location": [
                {
                    "name": "TEST",
                    "lat": "32.623239",
                    "long": "51.636149"
                }
            ]
        }
    ]
}

```

##Driver

History of driver trips.

> Example request

```bash
curl "http://flipapp.ir/api/v1/driver/history" \
-H "Accept: application/json" \
-H "Authorization: Bearer ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://flipapp.ir/api/v1/driver/history",
    "method": "GET",
    "data": {},
    "headers": {
        "accept": "application/json",
        "authorization": "Bearer ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`GET api/v1/driver/history`

    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "status_id": 17,
            "source": "استان اصفهان، اصفهان، بلوار کشاورز، ایران",
            "destination": "استان اصفهان، اصفهان، چهارراه مارنان، ایران",
            "eta_value": "249",
            "eta_text": "4 mins",
            "distance_value": "1289",
            "distance_text": "1.3 km",
            "etd_value": "0",
            "etd_text": "1 min",
            "driver_location": {
                "id": 20204,
                "latitude": "32.623239",
                "longitude": "51.636149",
                "name": "TEST",
                "user_id": 207,
                "created_at": "2017-02-14 14:58:34",
                "updated_at": "2017-02-14 14:58:34"
            },
            "driver_distance_value": "0",
            "driver_distance_text": "1 m",
            "created_at": "2017-02-15 14:38:32",
            "status_name": "trip_is_over",
            "s_lat": "32.623239",
            "s_long": "51.636149",
            "d_lat": "32.634100",
            "d_long": "51.639282",
            "transaction": {
                "id": 8,
                "trip_id": 12,
                "car_type_id": 1,
                "entry": "2",
                "distance": "1289",
                "per_distance": "0.7",
                "distance_unit": "kilometer",
                "distance_value": "0.9",
                "time": "249",
                "per_time": "0.3",
                "time_unit": "minute",
                "time_value": "1.2",
                "surcharge": "1",
                "currency": "USD",
                "timezone": "Asia/Tehran",
                "total": "4.1",
                "created_at": "2017-02-15 14:38:43",
                "updated_at": "2017-02-15 14:38:43"
            },
            "rate": {
                "id": 1,
                "client": "5",
                "driver": "4.5",
                "client_comment": "hello",
                "driver_comment": "hello",
                "trip_id": 12,
                "created_at": "2017-02-15 14:39:28",
                "updated_at": "2017-02-15 14:39:28"
            }
        }
    ]
}
```


# Middleware
##Authenticate
Authorize the access token for continue using protected routes. Given on `Authorization` header.

> Example response - on failed authenticate

```json
{
    "success": false,
    "data": [
        {
            "title": "You are not authorized to access",
            "detail": "You're not authorized to access this route of the application, please check your token privileges.",
            "code": 401
        }
    ]
}
```

##Check approve driver
Check if the current driver is an approved driver to go online.
```json
{
    "success": false,
    "data": [
        {
            "title":  "Not an approved driver",
            "detail": "You should contact your area call center to begin approving proccess.",
            "code": 401
        }
    ]
}
```

##Check role
Client access token and driver access token are different and a client cannot access routes of drivers with his/her access token and vice versa.

> Example response - using driver access token to get response form client routs

```json
{
    "success": false,
    "data": [
        {
            "title"  : "You are not authorized to access",
            "detail" : "You're not authorized to access this route of the application, please check your token privileges.",
            "code": 401
        }
    ]
}
```

##Check verified user
Check if the current user(driver or client) has verified phone number.

> Example response - not verified

```json
{
    "success": false,
    "data": [
        {
            "title"  : "Not a verified user",
            "detail" : "You should verify your phone number first.",
            "code": 401
        }
    ]
}
```

##Check online driver
Check if the current driver is online.

> Example response - not online (offline)

```json
{
    "success": false,
    "data": [
        {
            "title"  : "Not an online driver",
            "detail" : "You should go online first.",
            "code": 401
        }
    ]
}
```

##Check driver car
Check if the current driver has a registered car.

> Example response - does not own a car

```json
{
    "success": false,
    "data": [
        {
            "title": "No car",
            "detail": "You should contact your area call center to register your car.",
            "code": 401
        }
    ]
}

```

##Check POST size
Check the max POST content size. in case of failure:

> Exceed POST content size

```json
{
  "success": false,
  "data": [
    {
      "title": "Exceed file size",
      "detail": "Post size exceed allowed size",
      "code": 500
    }
  ]
}
```

##In trip
Check if the user is in a trip.
if not:

```json
{
  "success": false,
  "data": [
    {
      "title": "Not on trip",
      "detail": "Not on an active trip right now",
      "code": 500
    }
  ]
}
```

##Paid or can't change

Payment record is already been paid or choose something else and now cannot be modified.

```json

{
    "success": false,
    "data": [
        {
            "title": "You already paid",
            "detail": "You paid your trip cost or cannot change payment method"
        }
    ]
}

```


#Errors
##404
Requested route is not registered within the app.

> Example response

```json
{
    "success": false,
    "data": [
        {
            "title": "Not found",
            "detail": "Requested route not found",
            "code": 404
        }
    ]
}

```

#State Diag.

## Driver state diagram
States that a driver can go to.



![Image of driver state diagram](http://sl.uploads.im/d/wPNeh.png)

## Client state diagram

States that a client can go to.



![Image of client state diagram](http://sl.uploads.im/d/y3S57.png)
