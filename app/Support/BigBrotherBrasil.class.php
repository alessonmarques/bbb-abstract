<?php


namespace app\Support;

use Brother;

class BigBrotherBrasil
{
    protected   $domain;
    protected   $start_date; 
    protected   $last_update;

    private     $json_product;

    function __construct()
    {
        $this->domain = "https://gshow.globo.com/realities/bbb/";
        $this->start_date = date('Y-m-d H:i:s');
    }

    function getBrothersData()
    {
        $content    = file_get_contents($this->domain);
        $pattern    = '/{"config":{"apiName":"card-participantes-bbb"}.*."},{"config/';
        preg_match_all($pattern, $content, $match);

        if(!(isset($match[0]) && !empty($match[0])))
            echo "WOW, Something goes wrong!";

        if(isset($match[0]) && !empty($match[0]))
        {
            $json_data    = $match[0][0];
            $json_data    = substr($json_data, 0, strlen($json_data) - strlen(',{"config'));
            
            $this->setBrothersData($json_data);
        }
    }

    function setBrothersData($brothersData)
    {
        $brothersData = json_decode($brothersData);

        $brothers = $brothersData->externalData;

        echo "<pre>";
            print_r($brothers);
        echo "</pre>";
    }

}
