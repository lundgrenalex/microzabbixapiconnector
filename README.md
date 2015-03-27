micro jscon-rpc connector for zabbix api requests
=======================

this connector support:
- proxy usage (setup in basic jsonrpc class)

#how use?

### require and define zabbix-connector class

```php
require __DIR__ . '/zbx.inc.php';
```
### define zabbix connector

```php
$zbx = new zbx;
```

### authorize

for auth u need 3 params,
- url to zabbix api like http(s)://zabbixurl/api_jsonrpc.php
- user
- password

for next requests for zabbix we use returned "access token" from authorization 

```php

$zbx->url = zabbixurl;
$zbx->method = 'user.login';
$zbx->query['user'] = $connection['user'];
$zbx->query['password'] = $connection['password'];
$zbx->access_token = $zbx->call()['result'];
```

###sample of request after auth

- get host id by host name

```php
$zbx->method = 'template.get';
$zbx->query['output'] = 'hostids';
$zbx->query['filter']['host'] = 'domain_server';
$hostid = $zbx->call()['result']['0']['hostid'];
```

- for debug u can use full responce output like: 
```php
var_dump($zbx->call());
```

- view all zabbix methods on https://www.zabbix.com/documentation/2.2/manual/api/reference

* questions? - alex@endem.su
