---
title: API Reference

language_tabs:
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
## Client registration

Initial step for client to register, using phone no. as the primary param
for login and validation. phone must be unique among all registered
clients.

> Example request:

```bash
curl "http://localhost/api/client/register" \
-H "Accept: application/json" \
    -d "password"="sunt" \
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
        "password": "sunt",
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
    password | string |  required  | Minimum: `6` Maximum: `255`
    phone | numeric |  required  | Must have a length between `9` and `255`
    login_by | string |  required  | `manual`, `ios`, `android`
    lang | string |  required  | `fa`, `en`, `ar`
    device_type | string |  required  | Maximum: `255`
    device_token | string |  required  | Maximum: `255`

<!-- END_786684a27e8f23727a33ce6bbf1f5a4f -->
<!-- START_8c58924b654ca8b9de1761fb81b7cff1 -->
## Client social registraion

Initial step for client to register, using phone no. as the primary param
for login and validation. phone must be unique among all registered
clients.

> Example request:

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

> Example request:

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

> Example request:

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

Update authenticated user profile data.

> Example request:

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

> Example request:

```bash
curl "http://localhost/api/driver/register" \
-H "Accept: application/json" \
    -d "password"="eaque" \
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
        "password": "eaque",
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
    password | string |  required  | Minimum: `6` Maximum: `255`
    phone | numeric |  required  | Must have a length between `9` and `255`
    lang | string |  required  | `fa`, `en`, `ar
    country | string |  required  |  Maximum: `255`
    state | string |  required  |  Maximum: `255`
    device_token | string |  required  |  Maximum: `255`
    device_type | string |  required  |  Maximum: `255`
    login_by | string |  required  |  `manual`

<!-- END_758c5ce4b6de7437277c2d4b3b90b245 -->
<!-- START_8f84a574765c547365e6dc7ddbfe763a -->
## Driver/Client login

Handle driver and client login with phone and password.

> Example request:

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

<!-- END_8f84a574765c547365e6dc7ddbfe763a -->
<!-- START_592dbad5f2c258af41de0cf2b034f7ce -->
## Driver online

Make a driver online, when a driver goes online his/her availability will
set to true as well. An approved drvier can go to online mode.

> Example request:

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

> Example request:

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

> Example request:

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

> Example request:

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

Update authenticated user profile data.

> Example request:

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
