###################
 REST Service and Simple Frontend
###################
FRONT END URL and Add new devices Interface
http://[::1]/fleetsu/index.php/api/telematics/devices

*******************
TO GET Device(s)
*******************
Method: GET

URL: http://[::1]/fleetsu/index.php/api/telematics/devices

Parameters
1. id integer Optional
	
If no parameters, it will return all the records

*******************
To Add New Devices:
*******************
URL: http://[::1]/fleetsu/index.php/api/telematics/devices

Method: POST

Parameters
1. device_id string required
2. device_label string required
3. last_reported_date timestamp requirred (UTC) ex(2017-11-23 03:14:07)


*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.