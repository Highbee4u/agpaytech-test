<?php require('class/Upload.php'); ?>
<?php

    if(!isset($_FILE['upload'])){
        $countrydata = $upload->upload_file(array('upload_type' => 'country'), $_FILES['upload']);
        if($countrydata['status'] == true){
            retResponse('200','File Uploaded Successfully', true, $countrydata['uploaded']. ' of '.$countrydata['total']. ' Data uploaded successfully');
        }else{
            retResponse('400',$countrydata['error'], true, $countrydata['uploaded']. ' of '.$countrydata['total']. ' uploaded');
        }
    }else{
        retResponse('400','parameter not set', false);
    }

?>

