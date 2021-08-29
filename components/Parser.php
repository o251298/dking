<?php

/*
 *
 *
 *
 *
 *
 */

class Parser
{
    public $url;

    public function parserXML(){
        $url = $this->url = 'https://manytoys.com.ua/modules/nvn_export_products/download/nvn_products_export_y0ngJz7pLC.xml';
        $xml = simplexml_load_file($url) OR die('error parser');
        $limit = 10;

        for($i = 0; $i < $limit; $i++){
            echo $xml->SHOPITEM[$i]->PRODUCT_NAME_L1 . '<br>';
        }
    }
}