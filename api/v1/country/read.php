<?php include_once('class/Country.php'); ?>
<?php
    if($page != ""){
        $countrylists = $country->fetch_by_paginate($page, $results_per_page, $page_first_result );
        if(count($countrylists) > 0){
            retResponse('200','Country list', true, $countrylists);
        }else{
            retResponse('200','No data found', true);
        } 
    } else{
        $countrylists = $country->fetch_all();
        if(count($countrylists) > 0){
            retResponse('200','All Country', true, $countrylists);
        }else{
            retResponse('200','No data found', true);
        } 
    }
   
?>