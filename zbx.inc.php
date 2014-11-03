<?php

class jsonrpc{    
    
    protected function connect($server, $query){
        $http = curl_init($server);
        curl_setopt($http, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($http, CURLOPT_POSTFIELDS, $query);    
        curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($http, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($http, CURLOPT_PROXY, 'proxy_url');
        curl_setopt($http, CURLOPT_PROXYPORT, '3128');
        curl_setopt($http, CURLOPT_PROXYUSERPWD, 'login:pass');
        curl_setopt($http, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($http, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($http);
        return json_decode($response, true);
        curl_close($http);
    }
    
}


class zbx extends jsonrpc{

    public $method;
    public $access_token;
    public $url;
    public $query;

    function call(){
        $data['jsonrpc'] = '2.0';
        $data['method'] = $this->method;
        $data['params'] = $this->query;
        $this->query = '';
        if(!empty($this->access_token)) $data['auth'] = $this->access_token;     
        $data['id'] = rand(1,100);
        $data = json_encode($data, JSON_PRETTY_PRINT);
        return $this->connect($this->url, $data);
    }
        
}
