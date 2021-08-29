<?php

function debager($val){
    echo '<pre>';
    var_dump($val);
    echo '</pre>';
    die();
}