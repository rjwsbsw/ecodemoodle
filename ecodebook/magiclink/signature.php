<?php
class Signature{  
    
    public function check_args_key($key, $search_array,$alternative) 
    {
      $var = '';
      if (array_key_exists($key, $search_array)) {
        $var = $alternative; 
      }
      else
      {
        $var = $alternative;
      }
      return $var;
    }
    public  function get_time() 
    { 
      date_default_timezone_set('Europe/Berlin');
      setlocale(LC_TIME, "de_DE");
      return  time();
    }
    public  function get_local_time() { 
        date_default_timezone_set('Europe/Berlin');
        setlocale(LC_TIME, "de_DE");
        return strftime("%m-%d-%Y+%H:%M:%S");
    }
    public function create_url_link($args) {
        $fullfillmentURL = $args['url'];
        $now = $this->get_time();
        $nowsec = $this->check_args_key('dateval',$args,(int)$now);
        $timetostring = $this->get_local_time();
        $nowread = $this->check_args_key('gbauthdate',$args,$timetostring);
        $args['gbauthdate'] = $nowread;
        $args['dateval'] = $nowsec;
        $key = $args['key'];
        $sha = base64_decode($key);
        //$book = 'testbook'; // to be replaced
        //$bookid = 'urn%3Auuid%3Afa04d151-9ba2-4eab-a869-803944e23868'; // to be replaced
        //$trans_id = '4711&gbauthdate=08-13-2010%2B10%3A32%3A44&'; // to be relaced
        # construct the URL parameters
        $param_dict = [
            'action' => $args['action'], 
            'ordersource' => $args['ordersource'],
            'orderid' => $args['orderid'],
            'resid'=> $args['resid'],
            'gbauthdate'=>  $nowread,
            'dateval'=>   $nowsec,
            'gblver'=> $args['gblver'],
            'email' => $args['email'],
            'name' => $args['name'],
        ];
        $param_string = http_build_query($param_dict);
        $signatur = hash_hmac('sha256', $param_string, $sha); 
        $gbLink = "{$fullfillmentURL}?{$param_string}&auth={$signatur}"; 
        return  $gbLink;
    }
}


?>