<?php
    function Build_WSDL_URL($host, $name, $port, $ssl) {
        return $ssl . $host . ':' . $port . '/' . $name . '?wsdl';
    }

    class cdp3 {
        public $PORT_HTTP = 9080;
        public $PORT_HTTPS = 9443;
        
        public function __construct($host, $username, $password, $port = Null, $ssl = True) {
            $this->host = $host;
            $this->username = $username; 
            $this->password = $password;
            $this->port = $port;
            $this->ssl = $ssl;
        }

        public function __get($var){
            if(isset($var)){
                if ($this->ssl == True) {
                    $ssl = "https://";                    
                } else {
                    $ssl = "http://";
                }
                if ($this->port == Null) {
                    if ($ssl == True) {
                        $port = $this->PORT_HTTPS;
                    } else {
                        $port = $this->PORT_HTTP;
                    }
                }
                $soap = new soapclient(Build_WSDL_URL($this->host,$var,$port,$ssl),
                    array('login'=>$this->username,
                        'password'=>$this->password,
                        'cache_wsdl' => WSDL_CACHE_NONE,
                        'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
                        'trace'=>1)
                    );
                return $soap;
            }
        }
    }
?>
