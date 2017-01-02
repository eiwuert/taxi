# FCM

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

### Driver

Body | Header
---------- | -------
0 | `new_client_found`
1 | `trip_cancelled_by_client`
2 | `client_cancelled_onway_driver`
3 | `client_canceled_arrived_driver`
