---
title: API Reference

language_tabs:
- shell
- pyhton
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_8ad860d24dc1cc6dac772d99135ad13e -->
## Send a reset link to the given user.

> Example request:

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
## Authorize a client to access the user&#039;s account.

> Example request:

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


### HTTP Request
`POST api/oauth/token`


<!-- END_afa573efcb404c394e835b474f167e56 -->
<!-- START_786684a27e8f23727a33ce6bbf1f5a4f -->
## Create a new driver.

> Example request:

```bash
curl "http://localhost/api/client/register" \
-H "Accept: application/json" \
    -d "email"="mckenzie.patience@example.net" \
    -d "password"="sunt" \
    -d "social_id"="sunt" \
    -d "login_by"="manual" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/register",
    "method": "POST",
    "data": {
        "email": "mckenzie.patience@example.net",
        "password": "sunt",
        "social_id": "sunt",
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
    email | email |  required  | Minimum: `6` Maximum: `255`
    password | string |  required  | Minimum: `6` Maximum: `255`
    social_id | string |  optional  | Maximum: `255`
    login_by | string |  optional  | `manual`, `google` or `facebook`

<!-- END_786684a27e8f23727a33ce6bbf1f5a4f -->
<!-- START_8c58924b654ca8b9de1761fb81b7cff1 -->
## Register using social id.

> Example request:

```bash
curl "http://localhost/api/client/register/social" \
-H "Accept: application/json" \
    -d "email"="tillman.delaney@example.net" \
    -d "social_id"="dolorem" \
    -d "login_by"="manual" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/register/social",
    "method": "POST",
    "data": {
        "email": "tillman.delaney@example.net",
        "social_id": "dolorem",
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
`POST api/client/register/social`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Maximum: `255`
    social_id | string |  required  | Minimum: `6` Maximum: `255`
    login_by | string |  required  | `manual`, `google` or `facebook`

<!-- END_8c58924b654ca8b9de1761fb81b7cff1 -->
<!-- START_03f72b6b5cad60cb93852896e72d4bf8 -->
## Login user.

> Example request:

```bash
curl "http://localhost/api/client/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/login",
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
`POST api/client/login`


<!-- END_03f72b6b5cad60cb93852896e72d4bf8 -->
<!-- START_735c882a06055470755680aea2345366 -->
## Login social.

> Example request:

```bash
curl "http://localhost/api/client/login/social" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/client/login/social",
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
`POST api/client/login/social`


<!-- END_735c882a06055470755680aea2345366 -->
<!-- START_73599da836df4931c2d145cd98155958 -->
## Set user location.

> Example request:

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

> Example request:

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

> Example request:

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

> Example request:

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

> Example request:

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

> Example request:

```bash
curl "http://localhost/api/client/profile" \
-H "Accept: application/json" \
    -d "first_name"="et" \
    -d "last_name"="et" \
    -d "sex"="male" \
    -d "device_token"="et" \
    -d "device_type"="et" \
    -d "lang"="fa" \
    -d "phone"="2" \
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
        "sex": "male",
        "device_token": "et",
        "device_type": "et",
        "lang": "fa",
        "phone": 2,
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
    sex | string |  optional  | `male`, `female` or `not specified`
    device_token | string |  optional  | Maximum: `255`
    device_type | string |  optional  | Maximum: `255`
    lang | string |  optional  | `fa` or `en`
    phone | integer |  optional  | 
    picture | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg) Maximum: `512`

<!-- END_ff3c3c34c0013f2818261a3c81cf76bc -->
<!-- START_758c5ce4b6de7437277c2d4b3b90b245 -->
## Create a new client.

> Example request:

```bash
curl "http://localhost/api/driver/register" \
-H "Accept: application/json" \
    -d "email"="krajcik.jalyn@example.com" \
    -d "password"="eaque" \
    -d "social_id"="eaque" \
    -d "login_by"="manual" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/register",
    "method": "POST",
    "data": {
        "email": "krajcik.jalyn@example.com",
        "password": "eaque",
        "social_id": "eaque",
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
    email | email |  required  | Minimum: `6` Maximum: `255`
    password | string |  required  | Minimum: `6` Maximum: `255`
    social_id | string |  optional  | Maximum: `255`
    login_by | string |  optional  | `manual`, `google` or `facebook`

<!-- END_758c5ce4b6de7437277c2d4b3b90b245 -->
<!-- START_28d1c493b3d2600a276e467aff28f0e6 -->
## Register using social id.

> Example request:

```bash
curl "http://localhost/api/driver/register/social" \
-H "Accept: application/json" \
    -d "email"="tbergstrom@example.org" \
    -d "social_id"="consequatur" \
    -d "login_by"="facebook" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/register/social",
    "method": "POST",
    "data": {
        "email": "tbergstrom@example.org",
        "social_id": "consequatur",
        "login_by": "facebook"
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
`POST api/driver/register/social`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Maximum: `255`
    social_id | string |  required  | Minimum: `6` Maximum: `255`
    login_by | string |  required  | `manual`, `google` or `facebook`

<!-- END_28d1c493b3d2600a276e467aff28f0e6 -->
<!-- START_8f84a574765c547365e6dc7ddbfe763a -->
## Login user.

> Example request:

```bash
curl "http://localhost/api/driver/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/login",
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
`POST api/driver/login`


<!-- END_8f84a574765c547365e6dc7ddbfe763a -->
<!-- START_63062e85628eac9d0933340350452bd1 -->
## Login social.

> Example request:

```bash
curl "http://localhost/api/driver/login/social" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/driver/login/social",
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
`POST api/driver/login/social`


<!-- END_63062e85628eac9d0933340350452bd1 -->
<!-- START_28b0526949c652e7a8cb170247076950 -->
## Set user location.

> Example request:

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

> Example request:

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

> Example request:

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

> Example request:

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

> Example request:

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

> Example request:

```bash
curl "http://localhost/api/driver/profile" \
-H "Accept: application/json" \
    -d "first_name"="amet" \
    -d "last_name"="amet" \
    -d "sex"="male" \
    -d "device_token"="amet" \
    -d "device_type"="amet" \
    -d "lang"="fa" \
    -d "phone"="30" \
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
        "sex": "male",
        "device_token": "amet",
        "device_type": "amet",
        "lang": "fa",
        "phone": 30,
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
    sex | string |  optional  | `male`, `female` or `not specified`
    device_token | string |  optional  | Maximum: `255`
    device_type | string |  optional  | Maximum: `255`
    lang | string |  optional  | `fa` or `en`
    phone | integer |  optional  | 
    picture | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg) Maximum: `512`

<!-- END_df243d0fcaae3817217c20b411deca06 -->
