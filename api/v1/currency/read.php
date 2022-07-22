<?php include_once('class/Currency.php'); ?>
<?php
    if($page != ""){
        $currencylists = $currency->fetch_by_paginate($page, $results_per_page, $page_first_result );
        if(count($currencylists) > 0){
            retResponse('200','Currency list', true, $currencylists);
        }else{
            retResponse('200','No data found', true);
        } 
    } else{
        $currencylists = $currency->fetch_all();
        if(count($currencylists) > 0){
            retResponse('200','All Currency', true, $currencylists);
        }else{
            retResponse('200','No data found', true);
        } 
    }
   
?>