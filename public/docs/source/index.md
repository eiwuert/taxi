---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:

---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_8ad860d24dc1cc6dac772d99135ad13e -->
## Send a reset link to the given user.

> Example request

```bash
curl "http://localhost/api/password/reset" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/password/reset",
    "method": "POST",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST api/password/reset`


<!-- END_8ad860d24dc1cc6dac772d99135ad13e -->
<!-- START_afa573efcb404c394e835b474f167e56 -->
<!--
## Access token

> Example request

```bash
curl "http://localhost/api/oauth/token" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/oauth/token",
    "method": "POST",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    password | string |  required  | Minimum: `6` Maximum: `255`
    username | numeric |  required  | phone number
    client_id | numeric |  required  | 
    client_secret | string |  required  | 
    grant_type | string |  required  | `password`


### HTTP Request
`POST api/oauth/token`

> Example respons


```json
{
    "success": true,
    "data": [
        {
            "token_type": "Bearer",
            "expires_in": 1296000,
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjNkNWJjMGEwY2M4NDg1OTZkNjJkODk0ZmRmZjE0NGU1NmE1NjcyMzZiYTlhNWFlNjEwY2M3N2I5NTMwYTdmYzBiMDFjNzllYjZiZGI5MGFkIn0.eyJhdWQiOiIxIiwianRpIjoiM2Q1YmMwYTBjYzg0ODU5NmQ2MmQ4OTRmZGZmMTQ0ZTU2YTU2NzIzNmJhOWE1YWU2MTBjYzc3Yjk1MzBhN2ZjMGIwMWM3OWViNmJkYjkwYWQiLCJpYXQiOjE0Nzk5MDEzNzMsIm5iZiI6MTQ3OTkwMTM3MywiZXhwIjoxNDgxMTk3MzczLCJzdWIiOiI0MDYiLCJzY29wZXMiOltdfQ.QKuKmcQokZ23UEvTCoH7JlSOheSXEN0-rDuIYRhUSjY6ndx4IqaKNhYwrCzH5A2HLPjwWyUVH5ulKCw5gbwPUUH5s2K0P-XsLBHEhaNm0hlUYHuO6wnIFj1cJXszH-5cufqA8hyu7BAaIRJTRWYUJYxFXUe-h04anzeoxky7vF65ULreB-Snb1gT41Fx36Scg6F3qfOQwITlIKiZDOu0zBZ-mIdbIgCcresAm5cczYJJ_e0R6nVF9WrF1v4xSDBjU8EVcknZlO1l8_w3d8tVw3N86njscYIk1PW3WpunW8-ye7gRufE0wxkLhmL1pPK5GFbOy4-POekdwhZhC7JeyCTbpscE0TapkZ0TIXsMLYcHhM6spR3C7h0QXn6hGXsBEk-1Mxe3Jq4AO7_Ip30NJvQWOavBNZyimmPXGPfccAkX1c1MTIDtHO6Id7nHpMqn0YBW1Ov_ajuSWBd9llaUllKauWd4Yem5Pvg1SdhAlxaCb5w8iSiJzwwOubJL3T6e0LmZ19-NpgX-xtzd8wM1ccZt1AniMVBoEciDum9nI5tzmYWE6DiryHJ8oZbEloAJ-teHxFXFE-CTSvhOcx9C9c4EA3qiG2x5Emp1bH15tTu7Nouzcx9qVo_DNyh8cTIkVkz-uSQEWtBy5_DyN2JerkWB8dhOQnJm6HiJJzxkK3w",
            "refresh_token": "g0n+3TQGaHGXYQhCUP76m4OGqtMNHmoeYHsu73kxdSXKp0lbbbbxrKzKdzImZ55WwxMPb3XU7dUZwidLUR57p28F4DH5hrhKLe9r8yE43fRbaKXi0whnexxjsf7iNWv3FC1hrKQrglFGSUN9rHw+z47nbscer9oR2HHbnsqPtwMbkkI8oZr7K7/NhpTFAanzN/HNcSmFvHVQER6/mWPHP3WUHeJourakKAIhldOQ6xjzaanY6QUalPftsr6ZHXVc0r32tpm2XFd02eDOG3CHItZak+j533GxcqzEEzGJNk2ZdE/kSArGSpIXY4cggHjsTAzOsxw1Jol9IF4yKIVV1eeeD4uu+Hakjfs0d5edaCX+gfsG0jAt9JhahDqsVFzgWlFNrVAyqp9NkhjmthhNX1Q+e3KyI/0wxFp5T71dvdVxV52Cvj/+KOOYhle0D2cri/EIquFovcjgMtYumwtDS4ycmpREiwv2DwKfup4fsCH3S20eZ/tssnOEKyYWLo3M94KE+vtMbKiA2Bx5CBS5TQ2/tq1k3ajamqbE0Bv04nxFoUE4TReKC8aaKymeE9GgIJhxswWnqFDV3s+QIoOjxBU++51AW635r9F3PZX4QsCjrd6xow/btAUrLn84KFkUXRN80xvkmMFzQIiy3lF1N++a47FSIkfdeGGmrbaAVJY="
        }
    ]
}
```

> Example response - wrong `client_id` and/or `client_secret`

```json
{
    "success": false,
    "data": [
        {
            "title": {
                "error": "invalid_client",
                "message": "Client authentication failed"
            },
            "detail": "You have entered not valid data.",
            "status": 401
        }
    ]
}
```

> Example response - wrong `grant_type`

```json
{
    "success": false,
    "data": [
        {
            "title": {
                "error": "unsupported_grant_type",
                "message": "The authorization grant type is not supported by the authorization server.",
                "hint": "Check the `grant_type` parameter"
            },
            "detail": "You have entered not valid data.",
            "status": 400
        }
    ]
}
```

> Example response - wrong `username`

```json
{
    "success": false,
    "data": [
        {
            "title": "Unhandled error",
            "detail": "Unhandled error occured during issue token, please make sure you have entered username",
            "status": 500
        }
    ]
}
```

> Example response - wrong `password`

```json
{
    "success": false,
    "data": [
        {
            "title": {
                "error": "invalid_credentials",
                "message": "The user credentials were incorrect."
            },
            "detail": "You have entered not valid data.",
            "status": 401
        }
    ]
}
```
-->
<!-- END_afa573efcb404c394e835b474f167e56 -->
<!-- START_786684a27e8f23727a33ce6bbf1f5a4f -->
## Client registration

Initial step for client to register, using phone no. as the primary param
for login and validation. phone must be unique among all registered
clients.

> Example request

```bash
curl "http://localhost/api/client/register" \
-H "Accept: application/json" \
    -d "phone"="sunt" \
    -d "login_by"="manual" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/register",
    "method": "POST",
    "data": {
        "phone": "sunt",
        "login_by": "manual"
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
    login_by | string |  required  | `manual`, `ios`, `android`
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


<!-- END_786684a27e8f23727a33ce6bbf1f5a4f -->
<!-- START_8c58924b654ca8b9de1761fb81b7cff1 -->
## Client social registraion

Initial step for client to register, using phone no. as the primary param
for login and validation. phone must be unique among all registered
clients.

> Example request

```bash
curl "http://localhost/api/client/register/social" \
-H "Accept: application/json" \
    -d "social_id"="dolorem" \
    -d "login_by"="google" \
    -d "phone"="dolorem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/register/social",
    "method": "POST",
    "data": {
        "social_id": "dolorem",
        "login_by": "google",
        "phone": "dolorem"
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
`POST api/client/register/social`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    social_id | string |  required  | Minimum: `6` Maximum: `255`
    login_by | string |  required  | `google` or `facebook`
    phone | numeric |  required  | Must have a length between `9` and `255`
    lang | string |  required  | `fa`, `en`, `ar`
    device_type | string |  required  | Maximum: `255`
    device_token | string |  required  | Maximum: `255`

<!-- END_8c58924b654ca8b9de1761fb81b7cff1 -->
<!-- START_03f72b6b5cad60cb93852896e72d4bf8 -->
## Driver/Client login

Handle driver and client login with phone and password.

> Example request

```bash
curl "http://localhost/api/client/login" \
-H "Accept: application/json" \
    -d "password"="consequuntur" \
    -d "phone"="consequuntur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/login",
    "method": "POST",
    "data": {
        "password": "consequuntur",
        "phone": "consequuntur"
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
`POST api/client/login`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    password | string |  required  | Minimum: `6` Maximum: `255`
    phone | numeric |  required  | Must have a length between `9` and `255` Valid user phone

<!-- END_03f72b6b5cad60cb93852896e72d4bf8 -->
<!-- START_735c882a06055470755680aea2345366 -->
## Login social.

Login client using social ID.

> Example request

```bash
curl "http://localhost/api/client/login/social" \
-H "Accept: application/json" \
    -d "social_id"="alias" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/login/social",
    "method": "POST",
    "data": {
        "social_id": "alias"
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
`POST api/client/login/social`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    social_id | string |  required  | Minimum: `6` Maximum: `255` Valid user social_id

<!-- END_735c882a06055470755680aea2345366 -->
<!-- START_73599da836df4931c2d145cd98155958 -->
## Set user location.

> Example request

```bash
curl "http://localhost/api/client/location" \
-H "Accept: application/json" \
    -d "latitude"="neque" \
    -d "longitude"="neque" \
    -d "user_id"="20" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/location",
    "method": "POST",
    "data": {
        "latitude": "neque",
        "longitude": "neque",
        "user_id": 20
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
`POST api/client/location`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    latitude | string |  required  | 
    longitude | string |  required  | 
    user_id | integer |  optional  | Valid user id

<!-- END_73599da836df4931c2d145cd98155958 -->
<!-- START_8b73bf0d9887dc53ca0a2fac86602a8e -->
## Get location for given id.

> Example request

```bash
curl "http://localhost/api/client/location/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/location/{id}",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[]
```

### HTTP Request
`GET api/client/location/{id}`

`HEAD api/client/location/{id}`


<!-- END_8b73bf0d9887dc53ca0a2fac86602a8e -->
<!-- START_5982e383118f2ad860c9ccf4234e620f -->
## Get all available car types.

> Example request

```bash
curl "http://localhost/api/client/car/types" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/car/types",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[]
```

### HTTP Request
`GET api/client/car/types`

`HEAD api/client/car/types`


<!-- END_5982e383118f2ad860c9ccf4234e620f -->
<!-- START_a4d4e238a0a91af4f684bf5579b6a990 -->
## Search car types.

> Example request

```bash
curl "http://localhost/api/client/car/search/{term}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/car/search/{term}",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[]
```

### HTTP Request
`GET api/client/car/search/{term}`

`HEAD api/client/car/search/{term}`


<!-- END_a4d4e238a0a91af4f684bf5579b6a990 -->
<!-- START_6756c814f606e970af7f12dbc16954f6 -->
## Get profile data.

> Example request

```bash
curl "http://localhost/api/client/profile" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/profile",
    "method": "GET",
        "headers": {
    "accept": "application/json"
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
`GET api/client/profile`

`HEAD api/client/profile`


<!-- END_6756c814f606e970af7f12dbc16954f6 -->
<!-- START_ff3c3c34c0013f2818261a3c81cf76bc -->
## Update profile data.

Update authenticated user profile data.

> Example request

```bash
curl "http://localhost/api/client/profile" \
-H "Accept: application/json" \
    -d "first_name"="et" \
    -d "last_name"="et" \
    -d "gender"="male" \
    -d "device_token"="et" \
    -d "device_type"="et" \
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
        "device_token": "et",
        "device_type": "et",
        "lang": "fa",
        "address": "et",
        "state": "et",
        "country": "et",
        "zipcode": 2,
        "picture": "et"
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
`POST api/client/profile`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  optional  | Maximum: `255`
    last_name | string |  optional  | Maximum: `255`
    gender | string |  optional  | `male`, `female` or `not specified`
    device_token | string |  optional  | Maximum: `255`
    device_type | string |  optional  | Maximum: `255`
    lang | string |  optional  | `fa` or `en`
    address | string |  optional  | Minimum: `3`
    state | string |  optional  | Minimum: `2` Maximum: `255`
    country | string |  optional  | Minimum: `2` Maximum: `255`
    zipcode | numeric |  optional  | 
    picture | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg) Maximum: `512`

<!-- END_ff3c3c34c0013f2818261a3c81cf76bc -->
<!-- START_758c5ce4b6de7437277c2d4b3b90b245 -->
## Driver registration

Initial step for driver to register, using phone no. as the primary param
for login and validation. phone must be unique among all registered
drivers.

> Example request

```bash
curl "http://localhost/api/driver/register" \
-H "Accept: application/json" \
    -d "phone"="eaque" \
    -d "login_by"="manual" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/register",
    "method": "POST",
    "data": {
        "phone": "eaque",
        "login_by": "manual"
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

<!-- END_758c5ce4b6de7437277c2d4b3b90b245 -->
<!-- START_8f84a574765c547365e6dc7ddbfe763a -->
<!--
## Driver/Client login

Handle driver and client login with phone and password.

> Example request

```bash
curl "http://localhost/api/driver/login" \
-H "Accept: application/json" \
    -d "password"="consequuntur" \
    -d "phone"="consequuntur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/login",
    "method": "POST",
    "data": {
        "password": "consequuntur",
        "phone": "consequuntur"
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
`POST api/driver/login`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    password | string |  required  | Minimum: `6` Maximum: `255`
    phone | numeric |  required  | Must have a length between `9` and `255` Valid user phone
-->
<!-- END_8f84a574765c547365e6dc7ddbfe763a -->
<!-- START_592dbad5f2c258af41de0cf2b034f7ce -->
## Driver online

Make a driver online, when a driver goes online his/her availability will
set to true as well. An approved drvier can go to online mode.

> Example request

```bash
curl "http://localhost/api/driver/online" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/online",
    "method": "GET",
        "headers": {
    "accept": "application/json"
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
`GET api/driver/online`

`HEAD api/driver/online`


<!-- END_592dbad5f2c258af41de0cf2b034f7ce -->
<!-- START_6d462c67159910a72526551ed62c271b -->
## Driver offline

Make a driver offline, when a driver goes offline his/her availability will
set to false as well. An approved drvier can go to offline mode.

> Example request

```bash
curl "http://localhost/api/driver/offline" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/offline",
    "method": "GET",
        "headers": {
    "accept": "application/json"
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
`GET api/driver/offline`

`HEAD api/driver/offline`


<!-- END_6d462c67159910a72526551ed62c271b -->
<!-- START_265f5314de7713e75152bce68e4705ce -->
## Driver onway

Make a driver onway, when a driver goes onway his/her availability will
set to false while he/she is still online An approved drvier can go
to onway mode.

> Example request

```bash
curl "http://localhost/api/driver/onway" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/onway",
    "method": "GET",
        "headers": {
    "accept": "application/json"
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
`GET api/driver/onway`

`HEAD api/driver/onway`


<!-- END_265f5314de7713e75152bce68e4705ce -->
<!-- START_6d9aee0e3694270647c488b26897e57b -->
## Driver available

Make a driver available, when a driver goes available his/her availability
will set to true while he/she is still online An approved drvier can go
to available mode.

> Example request

```bash
curl "http://localhost/api/driver/available" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/available",
    "method": "GET",
        "headers": {
    "accept": "application/json"
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
`GET api/driver/available`

`HEAD api/driver/available`


<!-- END_6d9aee0e3694270647c488b26897e57b -->
<!-- START_28b0526949c652e7a8cb170247076950 -->
## Set user location.

> Example request

```bash
curl "http://localhost/api/driver/location" \
-H "Accept: application/json" \
    -d "latitude"="atque" \
    -d "longitude"="atque" \
    -d "user_id"="30381" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/location",
    "method": "POST",
    "data": {
        "latitude": "atque",
        "longitude": "atque",
        "user_id": 30381
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
`POST api/driver/location`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    latitude | string |  required  | 
    longitude | string |  required  | 
    user_id | integer |  optional  | Valid user id

<!-- END_28b0526949c652e7a8cb170247076950 -->
<!-- START_e9bfa7d80c1cbb29b9ac9200a9e80fa6 -->
## Get location for given id.

> Example request

```bash
curl "http://localhost/api/driver/location/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/location/{id}",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[]
```

### HTTP Request
`GET api/driver/location/{id}`

`HEAD api/driver/location/{id}`


<!-- END_e9bfa7d80c1cbb29b9ac9200a9e80fa6 -->
<!-- START_5a2c9026e3a5e6897db7efe4d2e3ea33 -->
## Register new car.

> Example request

```bash
curl "http://localhost/api/driver/car/register" \
-H "Accept: application/json" \
    -d "number"="maiores" \
    -d "color"="maiores" \
    -d "type_id"="maiores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/car/register",
    "method": "POST",
    "data": {
        "number": "maiores",
        "color": "maiores",
        "type_id": "maiores"
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
`POST api/driver/car/register`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    number | string |  required  | 
    color | string |  required  | 
    type_id | string |  required  | Valid car_type id

<!-- END_5a2c9026e3a5e6897db7efe4d2e3ea33 -->
<!-- START_588c97e97ca360afae401f16d00ae027 -->
## Get driver car info.

> Example request

```bash
curl "http://localhost/api/driver/car/info" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/car/info",
    "method": "GET",
        "headers": {
    "accept": "application/json"
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

`HEAD api/driver/car/info`


<!-- END_588c97e97ca360afae401f16d00ae027 -->
<!-- START_0eb81262ddf2345b12ddd00157d2bae7 -->
## Get profile data.

> Example request

```bash
curl "http://localhost/api/driver/profile" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/profile",
    "method": "GET",
        "headers": {
    "accept": "application/json"
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

`HEAD api/driver/profile`


<!-- END_0eb81262ddf2345b12ddd00157d2bae7 -->
<!-- START_df243d0fcaae3817217c20b411deca06 -->
## Update profile data.

Update authenticated user profile data.

> Example request

```bash
curl "http://localhost/api/driver/profile" \
-H "Accept: application/json" \
    -d "first_name"="amet" \
    -d "last_name"="amet" \
    -d "gender"="male" \
    -d "device_token"="amet" \
    -d "device_type"="amet" \
    -d "lang"="fa" \
    -d "address"="amet" \
    -d "state"="amet" \
    -d "country"="amet" \
    -d "zipcode"="30" \
    -d "picture"="amet" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/profile",
    "method": "POST",
    "data": {
        "first_name": "amet",
        "last_name": "amet",
        "gender": "male",
        "device_token": "amet",
        "device_type": "amet",
        "lang": "fa",
        "address": "amet",
        "state": "amet",
        "country": "amet",
        "zipcode": 30,
        "picture": "amet"
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
`POST api/driver/profile`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  optional  | Maximum: `255`
    last_name | string |  optional  | Maximum: `255`
    gender | string |  optional  | `male`, `female` or `not specified`
    device_token | string |  optional  | Maximum: `255`
    device_type | string |  optional  | Maximum: `255`
    lang | string |  optional  | `fa` or `en`
    address | string |  optional  | Minimum: `3`
    state | string |  optional  | Minimum: `2` Maximum: `255`
    country | string |  optional  | Minimum: `2` Maximum: `255`
    zipcode | numeric |  optional  | 
    picture | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg) Maximum: `512`

<!-- END_df243d0fcaae3817217c20b411deca06 -->
<!-- START_df243d0fcaafasfsad817217c2gks86dDca06 -->
## Verify Clinet

Verify registered client

> Example request

```bash
curl "http://localhost/api/client/verify" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

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
<!-- END_df243d0fcaafasfsad817217c2gks86dDca06 -->
<!-- START_df243d0fcaajs8rubvzdd817217c2gks86dDca06 -->
## Verify Driver

Verify registered driver

> Example request

```bash
curl "http://localhost/api/driver/verify" \
-H "Accept: application/json" \
-H "Authorization: Bearer LONG_ACCESS_TOKEN" \

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
<!-- END_df243d0fcaajs8rubvzdd817217c2gks86dDca06 -->
<!-- START_df243d0fcaajs8rubvzdd817217c2gks86dDca06 -->
## Resend driver SMS

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
`POST api/driver/resend`
    
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
## Request taxi

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
            "status": 500
        }
    ]
}
```
> Example response - Asked for resend less than 2 minutes ago

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
lat | numeric |  required  | 
long | numeric |  required  | 
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



<!-- END_df243d0fcaajs8rubvzdd817217c2gks86dDca06 -->

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
