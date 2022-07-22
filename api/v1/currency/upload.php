<?php require('class/Upload.php'); ?>
<?php
     if(!isset($_FILE['upload'])){
        $currencydata = $upload->upload_file($data['upload_type'] = 'currency', $_FILES['upload']);
        if($currencydata['status'] == true){
            retResponse('200','File Uploaded Successfully', true, $currencydata['uploaded']. ' of '.$currencydata['total']. ' Data uploaded successfully');
        }else{
            retResponse('400',$currencydata['error'], true, $currencydata['uploaded']. ' of '.$currencydata['total']. ' uploaded');
        }
    }else{
        retResponse('400','parameter not set', false);
    }

?>

