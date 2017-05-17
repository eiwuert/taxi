# FCM
KEY | VALUE
--- | -------
SERVER_KEY | AAAAV9D4nlg:APA91bEqhjde3JUOvuIepJ5qB0n58eg0ceLqt8mvXHt2hyPSSylVoQ6vW6bA4zDHiVuiIW4siS4vL3OaZW-pwTT64smL0F0KIBQdIJkrDu1CahXqq-O0MOOjE_L88KmJjBT-W1hAO5qBQookB7bhs5z1YvJ7FLp-DA
SENDER_ID | 377168109144

##Logout

###Driver
![Image of Logout](http://1.1m.yt/O2gCKqR.png)

###Client
![Image of Logout](http://1.1m.yt/4LPd5Cq.png)

##Codes

### Client

Body | Header
---------- | -------
0 | `wait_for_driver_to_accept_ride`
1 | `no_driver_found`
2 | `started_trip_cancelled_by_driver`
3 | `new_clinet_cancelled_by_driver`
4 | `arrived_driver_cancelled_trip`
5 | `driver_onway`
6 | `trip_started`
7 | `trip_ended`
8 | `driver_arrived`
9 | `trip_is_over_by_admin`
10| `balance_updated`
11| `balance_failed_to_update`
12| `logout`


### Driver

Body | Header
---------- | -------
0 | `new_client_found`
1 | `trip_cancelled_by_client`
2 | `client_cancelled_onway_driver`
3 | `client_canceled_arrived_driver`
4 | `no_reponse_going_offline`
5 | `trip_is_over_by_admin`
6 | `pay_cash`
7 | `pay_wallet`
8 | `logout`