---
title: API Reference

language_tabs:
- bash
- javascript

includes:
    - fcm

search: true

toc_footers:

---

#Register

## Client

Initial step for client to register, using phone no. as the primary param
for login and validation.

> Example request

```bash
curl "http://localhost/api/client/register" \
-H "Accept: application/json" \
    -d "phone"="sunt" \
    -d "login_by"="sunt" \
    -d "lang"="sunt" \
    -d "device_type"="sunt" \
    -d "device_token"="sunt" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/register",
    "method": "POST",
    "data": {
        "phone": "sunt",
        "login_by": "sunt",
        "lang": "sunt",
        "device_type": "sunt",
        "device_token": "sunt",
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
`POST api/client/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    phone | numeric |  required  | Must have a length between `9` and `255`
    login_by | string |  required  | `manual`, `facebook`, `google`
    lang | string |  required  | `fa`, `en`, `ar`
    device_type | string |  required  | Maximum: `255`
    device_token | string |  required  | Maximum: `255`
    
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
            "phone": [
                "The phone field is required."
            ],
            "login_by": [
                "The login by field is required."
            ],
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
            "lang": [
                "The lang field is required."
            ],
            "device_type": [
                "The device type field is required."
            ],
            "device_token": [
                "The device token field is required."
            ],
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
curl "http://localhost/api/driver/register" \
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
    "url": "http://localhost/api/driver/register",
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
`POST api/driver/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    phone | numeric |  required  | Must have a length between `9` and `255`
    lang | string |  required  | `fa`, `en`, `ar
    country | string |  required  |  Maximum: `255`
    state | string |  required  |  Maximum: `255`
    device_token | string |  required  |  Maximum: `255`
    device_type | string |  required  |  Maximum: `255`
    login_by | string |  required  |  `manual`
    
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
curl "http://localhost/api/client/verify" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
	-d "code"="55555" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/verify",
    "method": "POST",
    "data": {
        "code": "amet",
},
    "headers": {
    	 "accept": "application/json",
    	 "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/client/verify`

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
            "content": "Phone verified successfuly"
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
            "title": "You are already verfied",
            "detail": "You are verfied, there is no need for verify again.",
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
curl "http://localhost/api/driver/verify" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
	-d "code"="eaque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/verify",
    "method": "POST",
    "data": {
        "code": "amet",
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/driver/verify`

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
            "content": "Phone verified successfuly"
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
            "title": "You are already verfied",
            "detail": "You are verfied, there is no need for verify again.",
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
curl "http://localhost/api/client/resend" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/resend",
    "method": "GET",
    "data": {},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`GET api/client/resend`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "SMS code re-sent successfuly"
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
            "title": "You are already verfied",
            "detail": "You are verfied, there is no need for verify again.",
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
curl "http://localhost/api/driver/resend" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/resend",
    "method": "GET",
    "data": {},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`GET api/driver/resend`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "content": "SMS code re-sent successfuly"
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
            "title": "You are already verfied",
            "detail": "You are verfied, there is no need for verify again.",
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


## Client

Set current location of client.


> Example request

```bash
curl "http://localhost/api/client/location" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
    -d "lat"="neque" \
    -d "long"="neque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/location",
    "method": "POST",
    "data": {
        "lat": "neque",
        "long": "neque",
},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/client/location`

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
            "long": [
                "The long field is required."
            ],
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```


## Driver

Set current location of driver.

> Example request

```bash
curl "http://localhost/api/driver/location" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
    -d "lat"="atque" \
    -d "long"="atque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/location",
    "method": "POST",
    "data": {
        "lat": "atque",
        "long": "atque",
},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/driver/location`

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
            "long": [
                "The long field is required."
            ],
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
curl "http://localhost/api/client/car/types" \
-H "Accept: application/json"
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/car/types",
    "method": "GET",
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
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
`GET api/client/car/types`


# Profile

## Client

Get client profile data.

> Example request

```bash
curl "http://localhost/api/client/profile" \
-H "Accept: application/json"
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/profile",
    "method": "GET",
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
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
            "user_id": 3,
            "created_at": "2016-12-25 11:43:19",
            "updated_at": "2016-12-25 11:45:16",
            "phone": "0987897582"
        }
    ]
}
```

### HTTP Request
`GET api/client/profile`


## Driver

Get driver profile data.

> Example request

```bash
curl "http://localhost/api/driver/profile" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/profile",
    "method": "GET",
    "headers": {
	   "accept": "application/json",
      	"authorization": "Bearer LONG_ACCESS_TOKEN"
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
`GET api/driver/profile`


## Update

Update `client` profile data. please note that driver profile is not updatable.

> Example request

```bash
curl "http://localhost/api/client/profile" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
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
    "url": "http://localhost/api/client/profile",
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
     	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/client/profile`

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
            "first_name": [
                "The first name may not be greater than 255 characters."
            ],
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```


# Driver


## Go online

Make a driver online, when a driver goes online his/her availability will
set to true as well. An approved drvier can go to online mode.

> Example request

```bash
curl "http://localhost/api/driver/online" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/online",
    "method": "GET",
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
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
`GET api/driver/online`


## Go offline

Make a driver offline, when a driver goes offline his/her availability will
set to false as well. An approved drvier can go to offline mode.

> Example request

```bash
curl "http://localhost/api/driver/offline" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/offline",
    "method": "GET",
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
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
            "result": "Driver is offline."
        }
    ]
}
```

> Example response - currently offline

```json
{
    "success": false,
    "data": [
        {
            "title": "Driver cannot go offline",
            "detail": "An onway driver cannot go offline.",
            "code": 500
        }
    ]
}
```

### HTTP Request
`GET api/driver/offline`


# Car

## Info

> Example request

```bash
curl "http://localhost/api/driver/car/info" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/car/info",
    "method": "GET",
    "headers": {
    	 "accept": "application/json",
        "authorization": "Bearer LONG_ACCESS_TOKEN"
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
`GET api/driver/car/info`


# Trip - Client

## Request

Request new taxi by client

> Example request

```bash
curl "http://localhost/api/client/trip" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
   -d "s_lat": "maiores", \
   -d "s_long": "maiores", \
   -d "d_lat": "maiores", \
   -d "d_long": "maiores", \ 
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/trip",
    "method": "POST",
    "data": {
        "s_lat": "amet",
        "s_long": "amet",
        "d_lat": "amet",
        "d_long": "amet",
},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/client/trip`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
s_lat | numeric |  required  | 
s_long | numeric |  required  | 
d_lat | numeric |  required  | 
d_long | numeric |  required  | 
    
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
            "trips": [
                {
                    "id": 8,
                    "driver_id": null,
                    "client_id": 1,
                    "status_id": 1,
                    "source": 17,
                    "destination": 18,
                    "eta_value": "500",
                    "eta_text": "8 mins",
                    "distance_value": "5051",
                    "distance_text": "5.1 km",
                    "etd_value": null,
                    "etd_text": null,
                    "driver_location": null,
                    "driver_distance_value": null,
                    "driver_distance_text": null,
                    "created_at": "2016-11-29 15:24:33",
                    "updated_at": "2016-11-29 15:24:33"
                }
            ],
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


## Nearby taxis

Find near by taxis

> Example request

```bash
curl "http://localhost/api/client/nearby" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \
   -d "lat": "maiores", \
   -d "long": "maiores", \
   -d "distance": "maiores", \
   -d "limit": "maiores", \ 

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/trip",
    "method": "POST",
    "data": {
        "lat": "amet",
        "long": "amet",
        "distance": "amet",
        "limit": "amet",
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST api/client/trip`

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
            "user_id": 3
        },
        {
            "id": 4,
            "distance": "0.563525245388979",
            "longitude": "51.406401",
            "latitude": "35.757223",
            "name": "استان تهران، تهران، خیابان ملاصدرا، ایران",
            "user_id": 1
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
            "lat": [
                "The lat format is invalid."
            ],
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

## Current

Current state of the client trip

> Example request

```bash
curl "http://localhost/api/client/trip" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/trip",
    "method": "GET",
    "data": {
},
    "headers": {
    	"accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`GET api/client/trip`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "driver": {
                "first_name": "amirmasoud",
                "last_name": "sheydaei",
                "email": "amirmasood33@gmail.com",
                "gender": "male",
                "picture": "no-profile.png"
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
            "car": {
                "number": "11ب111 ایران 11",
                "color": "pink",
                "type_id": 3
            },
            "type": {
                "name": "sport"
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
            "driver_location": {
                "latitude": "34.016307",
                "longitude": "51.373416",
                "name": "TEST"
            }
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

Cancel taxi by client

> Example request

```bash
curl "http://localhost/api/client/cancel" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/cancel",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/client/cancel`
    
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


# Trip - driver


## Accept ride

Accept ride by driver

> Example request

```bash
curl "http://localhost/api/driver/accept" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/accept",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/driver/accept`
    
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

Start ride by driver

> Example request

```bash
curl "http://localhost/api/driver/start" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/start",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/driver/start`
    
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

## End ride

End ride by driver

> Example request

```bash
curl "http://localhost/api/driver/end" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/end",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/driver/end`
    
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

## Cancel ride

Cancel ride by driver

> Example request

```bash
curl "http://localhost/api/driver/cancel" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/cancel",
    "method": "GET",
    "data": {
},
        "headers": {
    "accept": "application/json",
    "authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`GET api/driver/cancel`
    
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

When drive arrives at departure location.

> Example request

```bash
curl "http://localhost/api/driver/arrived" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/arrived",
    "method": "GET",
    "data": {},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`GET api/driver/arrived`
    
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
            "comment": [
                "The comment may not be greater than 5000 characters."
            ],
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

## Current

Current state of driver trip

> Example request

```bash
curl "http://localhost/api/driver/trip" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/trip",
    "method": "GET",
    "data": {
},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`GET api/driver/trip`
    
> Example response

```json
{
    "success": true,
    "data": [
        {
            "client": {
                "first_name": "amir",
                "last_name": "amiri",
                "gender": "not specified",
                "picture": "no-profile.png"
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
            }
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



# Rate

## Driver

Rate of driver to client.

> Example request

```bash
curl "http://localhost/api/driver/rate" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/rate",
    "method": "POST",
    "data": {},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/driver/rate`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
stars | numeric |  required  | in: `1,2,3,4,5`
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
            "stars": [
                "The stars must be a number.",
                "The selected stars is invalid."
            ],
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
            "comment": [
                "The comment may not be greater than 5000 characters."
            ],
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
curl "http://localhost/api/client/rate" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/rate",
    "method": "POST",
    "data": {},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`POST api/client/rate`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
stars | numeric |  required  | in: `1,2,3,4,5`
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
            "stars": [
                "The stars must be a number.",
                "The selected stars is invalid."
            ],
            "title": "Validation failed",
            "detail": "Validation for given fields have been failed, please check your inputs.",
            "code": 422
        }
    ]
}
```

#History

##driver

History of driver trips.

> Example request

```bash
curl "http://localhost/api/driver/history" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/history",
    "method": "GET",
    "data": {},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`GET api/driver/history`

    
> Example response

```json
{
    "success": true,
    "data": [
            {
                "status_id": 17,
                "source": "استان تهران، تهران، بزرگراه چمران، ایران",
                "destination": "استان تهران، تهران، بزرگراه شیخ فضل الله نوری، ایران",
                "eta_value": "1175",
                "eta_text": "20 mins",
                "distance_value": "16734",
                "distance_text": "16.7 km",
                "etd_value": "615",
                "etd_text": "10 mins",
                "driver_location": "TEST",
                "driver_distance_value": "5668",
                "driver_distance_text": "5.7 km",
					"status_name": "trip_is_over",
					"s_lat": "35.712562",
					"s_long": "51.334494",
					"d_lat": "35.790818",
					"d_long": "51.416043",
					"created_at": "2016-12-26 12:06:21",
                "transaction": [
                    {
                        "entry": "2",
                        "distance": "16734",
                        "per_distance": "0.7",
                        "distance_unit": "kilometer",
                        "distance_value": "11.7",
                        "time": "1175",
                        "per_time": "0.3",
                        "time_unit": "minute",
                        "time_value": "5.9",
                        "surcharge": "1",
                        "currency": "USD",
                        "timezone": "Asia/Tehran",
                        "total": "19.6"
                    }
                ],
                "rate": []
            },
            {
                "status_id": 17,
                "source": "استان تهران، تهران، بزرگراه چمران، ایران",
                "destination": "استان تهران، تهران، بزرگراه شیخ فضل الله نوری، ایران",
                "eta_value": "1175",
                "eta_text": "20 mins",
                "distance_value": "16734",
                "distance_text": "16.7 km",
                "etd_value": "615",
                "etd_text": "10 mins",
                "driver_location": "TEST",
                "driver_distance_value": "5668",
                "driver_distance_text": "5.7 km",
                "status_name": "trip_is_over",
					"s_lat": "35.712562",
					"s_long": "51.334494",
					"d_lat": "35.790818",
					"d_long": "51.416043",
					"created_at": "2016-12-26 12:06:21",
                "transaction": [
                    {
                        "entry": "2",
                        "distance": "16734",
                        "per_distance": "0.7",
                        "distance_unit": "kilometer",
                        "distance_value": "11.7",
                        "time": "1175",
                        "per_time": "0.3",
                        "time_unit": "minute",
                        "time_value": "5.9",
                        "surcharge": "1",
                        "currency": "USD",
                        "timezone": "Asia/Tehran",
                        "total": "19.6"
                    }
                ],
                "rate": [
                    {
                        "driver": 4,
                        "driver_comment": "lovely passenger"
                    }
                ]
            }
    ]
}
```


##client

History of client trips.

> Example request

```bash
curl "http://localhost/api/client/history" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/history",
    "method": "GET",
    "data": {},
    "headers": {
    	"accept": "application/json",
    	"authorization": "Bearer LONG_ACCESS_TOKEN"
    }
}

$.ajax(settings).done(function (response) {
	console.log(response);
});
```


### HTTP Request
`GET api/client/history`

    
> Example response

```json
{
    "success": true,
    "data": [
            {
                "status_id": 17,
                "source": "استان تهران، تهران، بزرگراه چمران، ایران",
                "destination": "استان تهران، تهران، بزرگراه شیخ فضل الله نوری، ایران",
                "eta_value": "1175",
                "eta_text": "20 mins",
                "distance_value": "16734",
                "distance_text": "16.7 km",
                "etd_value": "615",
                "etd_text": "10 mins",
                "driver_location": "TEST",
                "driver_distance_value": "5668",
                "driver_distance_text": "5.7 km",
                "status_name": "trip_is_over",
					"s_lat": "35.712562",
					"s_long": "51.334494",
					"d_lat": "35.790818",
					"d_long": "51.416043",
					"created_at": "2016-12-26 12:06:21",
                "transaction": [
                    {
                        "entry": "2",
                        "distance": "16734",
                        "per_distance": "0.7",
                        "distance_unit": "kilometer",
                        "distance_value": "11.7",
                        "time": "1175",
                        "per_time": "0.3",
                        "time_unit": "minute",
                        "time_value": "5.9",
                        "surcharge": "1",
                        "currency": "USD",
                        "timezone": "Asia/Tehran",
                        "total": "19.6"
                    }
                ],
                "rate": [],
                "driver": []
            },
            {
                "status_id": 17,
                "source": "استان تهران، تهران، بزرگراه چمران، ایران",
                "destination": "استان تهران، تهران، بزرگراه شیخ فضل الله نوری، ایران",
                "eta_value": "1175",
                "eta_text": "20 mins",
                "distance_value": "16734",
                "distance_text": "16.7 km",
                "etd_value": "615",
                "etd_text": "10 mins",
                "driver_location": "TEST",
                "driver_distance_value": "5668",
                "driver_distance_text": "5.7 km",
                "status_name": "trip_is_over",
                "s_lat": "35.712562",
	            "s_long": "51.334494",
	            "d_lat": "35.790818",
	            "d_long": "51.416043",
                "created_at": "2016-12-26 12:06:21",
                "transaction": [
                    {
                        "entry": "2",
                        "distance": "16734",
                        "per_distance": "0.7",
                        "distance_unit": "kilometer",
                        "distance_value": "11.7",
                        "time": "1175",
                        "per_time": "0.3",
                        "time_unit": "minute",
                        "time_value": "5.9",
                        "surcharge": "1",
                        "currency": "USD",
                        "timezone": "Asia/Tehran",
                        "total": "19.6"
                    }
                ],
	            "driver": {
	                "id": 1,
	                "first_name": null,
	                "last_name": null,
	                "email": null,
	                "gender": "not specified",
	                "device_token": "kjlfajl",
	                "device_type": "ios",
	                "online": true,
	                "approve": true,
	                "available": true,
	                "lang": "fa",
	                "address": null,
	                "state": "esfahan",
	                "country": "iran",
	                "zipcode": null,
	                "picture": "no-profile.png",
	                "user_id": 4,
	                "created_at": "2016-12-25 11:46:36",
	                "updated_at": "2016-12-27 08:14:17",
	                "car": {
	                    "number": "00000",
	                    "color": "pink",
	                    "type": "van"
	                },
	                "phone": "0987897582"
	            }
                "rate": [
                    {
                        "client": 1,
                        "client_comment": "I could be dead in this fucking taxi"
                    }
                ]
            }
    ]
}
```


# Middlewares
##Authenticate
Authorize the access token for countinue using protected routes. Given on `Authorization` header.

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
            "detail": "You should contact your area car center to begin approving proccess.",
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
            "detail": "You should contact your area car center to register your car.",
            "code": 401
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