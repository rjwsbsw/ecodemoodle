<?php

require_once('signature.php');
function url2args($resid,$orderid,$email,$name,$ordersource,$sharedsecret,$host)
{
    
    $src_lnk='https://epaper.bund-verlag.de/viewBookshelf?action=null&ordersource=null&orderid=null&resid=null&gbauthdate=12-07-2021%2B11%3A39%3A07&dateval=1638873547&gblver=1&email=testator%40bundverlag.de&name=null&auth=null';
    $components = parse_url($src_lnk);
    parse_str($components['query'], $results);
    $results['url'] = $host.'/viewBookshelf';
    $results['key'] = $sharedsecret;
    $results['resid'] = $resid;
    $results['ordersource']= $ordersource;
    $results['action'] = 'book';
    $results['email'] = $email;
    $results['auth']=null;
    $results['name']= $name;
    $results['orderid'] = $orderid;
    return $results;
}
function get_results($resid,$orderid,$email,$name,$ordersource,$sharedsecret,$host)
{
    $args = url2args($resid,$orderid,$email,$name,$ordersource,$sharedsecret,$host);
    $signatureclass = new Signature();
    $result = $signatureclass -> create_url_link($args);
    return $result;
}
$resid = $_GET["resid"];
$orderid = $_GET["orderid"];
$email =  $_GET["email"];
$name = $_GET["name"];
$ordersource = $_GET["ordersource"];
$sharedsecret = $_GET["sharedsecret"];
$sharedsecret = str_replace('___','+',$sharedsecret);
$host = $_GET["host"];
echo get_results($resid,$orderid,$email,$name,$ordersource,$sharedsecret,$host);
?>