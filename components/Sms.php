<?php

class Sms
{

    public $phone;
    public $text;
    public $url;
    public $token;


    public function __construct($phone, $text, $url, $token){
        $this->phone = $phone;
        $this->text = $text;
        $this->url = $url;
        $this->token = $token;

    }

    private function setData(){
        $data = [
            "phones" => ["$this->phone"],
            "text" => $this->text,
            "originator" => "Shop Zakaz"
        ];
        return $data = json_encode($data);
    }

    public function getConnection(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($this->setData()),
            'X-Requested-With: XMLHttpRequest',
            'Accept: application/json, text/javascript, */*;q=0.01',
            'Authorization: Bearer '.$this->token
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->setData());
        curl_setopt($ch, CURLOPT_URL, $this->url);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}