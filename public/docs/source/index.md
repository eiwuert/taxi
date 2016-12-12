---
title: API Reference

language_tabs:
- bash
- javascript

includes:

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
            "expires_in": 129600000,
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM3NWI4OTQ1OWRlNzllNTZlNzlhOTViY2RiYWI3MjFkMjQ3OTAyN2E5NjYzMzk1NzJlZTQ4MGI4OWZiMDQ1OTBiYmNhNDhiZDgyMjdlOTE5In0.eyJhdWQiOiIzIiwianRpIjoiYzc1Yjg5NDU5ZGU3OWU1NmU3OWE5NWJjZGJhYjcyMWQyNDc5MDI3YTk2NjMzOTU3MmVlNDgwYjg5ZmIwNDU5MGJiY2E0OGJkODIyN2U5MTkiLCJpYXQiOjE0ODEyMDUyNjMsIm5iZiI6MTQ4MTIwNTI2MywiZXhwIjoxNjEwODA1MjYzLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.oEGk7El5FE3rpFC3QH70exU9VxK6sFhyvxaGtqwK69OGoWu1AxmbD5gne2aKdnZt3fhXPnlq-viL6edHesZ-BGm0E8SvqzT6-WwhIAzjXfgSxJjvm1n2WWy0RgRjYjFaMpgPkp6kA8jSHoztJuPUEqsdRDUBPNaVCCOLv-Ob7YzAEH8g6BG3SqWhEy5FHdyyKjPKIVA4VIQpCmsElplYU178HkW-kEbJouakjAkDk5bkhdgtW8JZDxuj2febcs3GTw-BACB_moGzSuIgiyImNwcjalPWhpBHroUaDYWlm_5lAsnNR5VyDjCmPVzUqvKTSxtj-WXIQGUpi5Vw5AaEXu1oeTMzzvJIiWytEUWm6FHQ8oFFaP_Iqh90sT0T5Dp0DFu9RDk12H90dSGWzgxXunWnmItOFPwe_zkHGjYZmEMFjRqn3ragvBpmAfa3hmCARNOy2izoGIPuK1d1lXxctwaQozkRsCRxwuhAm0NTs6pmGbYL_mzZJ6RFjt8riaHHtDglHP32JYXCgiSRmHPNVv_kLmTr9MOUWB31pDFDj1fpX8bDReMwYmTUs97pabteiFM7Spu5YYh8rgr05p-s2x8M0455JSq5R1z_hgmSzp_LwqgHLEHSTwTxq8pWHGR6dA0m3gc1aAS6wbZIGbtFK6QgTteAfidmRL094vIzdMc",
            "refresh_token": "sr0DHgrtPb0rX2s+fsc6UAaIC05JwCcXJlPMlRSZvsyD9e4ZA/d86rhi+3CFw7amWH9W6oYJYYoae3sd1AYGKcA0cRj/bw3X0vDjbmqxUNVdivb0e+iL/ikxZ1v4LoNqLbnbZ6L3GvjG/uUc9A2SHu5f4K4J8zsQcsZ3WETPUVXFGgljR+eI2EuHB9Zc8aJpJ1kgRFAImoGWVEAMgl2a1kkR1x1B9jdrmzCLAR+62Kz0n4HAtCUgcRw/U75bHh4KyeHjjuWuvdwUX+chsUHdJdtZ2wI8nxUJqmqZoqIjinf1pti8NnT3NIIySexwJ1IcVV1w5G4hugbXnLKvRUN8fLcywX0WarwZp3EHS16IDRh/KH75REhNBEDg7rEde6OcBbRmRB2uDF1TLmbw5Zj0CxC6EJfxy2ipyms/2xk0dHblhoDMX8Nebgjyl4D0GWx/jysrlGeGScT4wB/dnl+iCCkbEU+DxMMV/TMfIpgOwrOALsODdmD3+Vw2QTFjiFC5z4+F5Bipc6ZrVTEtAw64DMLekklW+/8XI5bXjscktV18MbyA8h9LkCbM9WMctNxv9t8Ox6SBvsogMBw8i4OOdr+ktN/yYv2VXhJWDaV5SREXoXP/GNKV+dSdjDV9y8/kRDNZnCgyTF31/+nVQYVaqbpwrVshxlPMlAVHAlZ4b9k="
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
            "status": 422
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
            "status": 422
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
            "expires_in": 129600000,
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImYxN2YzODY5MDhmMGQ2ZDlkMzEwY2RmY2NjZDBjZWY4NDFkYmM3Mjc3YjY1N2Y2ZjkxZmNiNWI0ZjUyYmVkYmExYzJlY2IyODM0NmI4N2NjIn0.eyJhdWQiOiI0IiwianRpIjoiZjE3ZjM4NjkwOGYwZDZkOWQzMTBjZGZjY2NkMGNlZjg0MWRiYzcyNzdiNjU3ZjZmOTFmY2I1YjRmNTJiZWRiYTFjMmVjYjI4MzQ2Yjg3Y2MiLCJpYXQiOjE0ODEyMDU0MDksIm5iZiI6MTQ4MTIwNTQwOSwiZXhwIjoxNjEwODA1NDA5LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.XPwFDi0kp9AIUMF8iW2g0jyYKmwIzF0UWc-qIepaFFLJ0vV7maXNJLNcTTx2PqXRY0O62wQmTMxTEqKkX0k0uYAqDBC02TZ6rwyM4JJCqyj5EdYhA0HZzZYDc2hA5nyEnFWR7nSqJkUYxLBZl7Uc9a7c9mT-kV6WikStETmvJhsMRYwLVyokdEpMRxixAmCYAQ4mR8mgSopcRz5f1oOPemndOyJP1TAoGeMk0yYe-R9AkD8GSEv4SLU4kIPC6j193OYOY_B3FFplM8_M9XfoPrdAdV3bxecl9Wx_ZKrGl1nq8Hi22Q8v1FwAsWyuxguyegK6BzRx_mO6a1X0WpEyZsCY_RTwpaZv1Ftkn_rgkDHluzoPentwaS7YVUmmG-HyeZrTVFyRljSJj7oHpaAYIiNfrgMvD4HF8asYF2_Ns1M2pXZTCqDAPE4dYauZ0PRaX9kytCzKQoA2XP9Qk9C5ayXCf21KDqWxsYurkH08LrK4KmD9qtJ7Mf_ZYyPitDL5coy-CWrWONr89m12SZya8URNLxGEp7ni8IMIlZuV1CI3RsAnqLVyYMY1y52Wy3q0zLWaVlCPK15CeZbLIfXvAxhNhfNrCyLLX7vHY32tHykhmQiwvDeCDZ8u9UK4jgexd2BNsM7ErVGC4L2SYlkv8ItWyoEQ-tUOBG-5DFUSspQ",
            "refresh_token": "ozaq8Ssd/Vvh8tmhyVs4L5w7N3f/6V6/nS0dMkqlm5waEPKdqgHGIPcbTqXTTEmcpV/YYrBN7tuFmFE/iju9s0aiLnP/lbHbNG77+Td9j1M8zGzYp3LUJkboJW9bh3AdfqAOxUWjFjg/jUko4VaNUjbqO3ZsEjLsd06elwIyLi3NB/WwSH57rBoBMo23HZMqQVKNwpeekCJq1Q8zxECQhyN5kCojc9PTOfRovw1NQw/4EHluc76OVkgcHiAEzp6m/OX1dWOKpPqmXko6CX+19AFktvWbrgaOty75sPhM2d9CzUWvToL47eq2jtA0xNiTm/UNLV5y7R6sTbhNq+7ec3RKBOTvXY4Nn9AkRn8KK7wAOJYdQJ7pn4T73SlY94Gh05ioX1mtm4PyzZeZK6m9rredD/GPgIgJW1y7eahY4ifUCdy5fW6bzEJKCMaDtoi9QJuqg/lhiG8dnYynZo6Vx3XJqow+QOdaylGyBAV517ZQEmooftF8yMAh7nsQkxCrPpgarjH8v3FJoTtEgDEpTckUOo3i8o1c8cPg2eodUws6pyCTDV9xppb5WM9PVIEcS5+S2ibm6VoYa74oi9WPc9bwgNXKlb6IOynwvciB+o6buYpQbz38Ydw8oPuIDvS9Zrr4VpaNN99x5f9car81fPZiJbTMWnpfonnJpT4P1Do="
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
            "status": 500
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
            "status": 404
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
            "status": 404
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
            "status": 500
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
            "status": 404
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
            "status": 404
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
            "status": 500
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
            "status": 500
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
            "status": 500
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
            "status": 500
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
        [
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
            "status": 422
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
        [
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
            "status": 422
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
            "id": 209,
            "first_name": null,
            "last_name": null,
            "gender": "not specified",
            "device_token": "kjflaj",
            "device_type": "ios",
            "lock": false,
            "lang": "fa",
            "address": null,
            "state": null,
            "country": null,
            "zipcode": null,
            "picture": "no-profile.png",
            "user_id": 416,
            "created_at": "2016-12-10 22:07:01",
            "updated_at": "2016-12-10 22:07:01"
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
null
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
            "id": 209,
            "first_name": "amirmasoud",
            "last_name": null,
            "gender": "not specified",
            "device_token": "kjflaj",
            "device_type": "ios",
            "lock": false,
            "lang": "fa",
            "address": null,
            "state": null,
            "country": null,
            "zipcode": null,
            "picture": "no-profile.png",
            "user_id": 416,
            "created_at": "2016-12-10 22:07:01",
            "updated_at": "2016-12-11 00:28:30"
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
            "status": 422
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
            "status": 500
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
            "status": 500
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
   -d "type": "maiores", \ 

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
        "type": "amet",
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
type	| string | opional |
    
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
            "status": 500
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
            "status": 422
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
            "status": 500
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
`GET api/driver/cancel`
    
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
            "status": 500
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
            "status": 500
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
            "status": 500
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
            "status": 500
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
            "status": 500
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
            "status": 500
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
            "status": 401
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
            "status": 401
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
            "status": 401
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
            "status": 401
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
            "status": 401
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
            "status": 401
        }
    ]
}

```
