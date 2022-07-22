<?php  
// filename: Uploads.php

require_once 'config/database.php';

if(!class_exists('Uploads')){
    
    Class Uploads{

        private $uploads_table = 'uploads';
        private $country_table = 'country';
        private $currency_table = 'currency';
    
        public function sanitize($array) {

            $con = connection::getConnection();

            foreach($array as $key=>$value) {

                if(is_array($value)) { 

                    $this->sanitize($value); 

                }else { 

                    $array[$key] = mysqli_real_escape_string($con, $value); 

                }
            }
            return $array;
        }
    
        public function upload_file($data, $upload){

                $errors = array();
                $file_name = $upload['name'];
                $file_size = $upload['size'];
                $file_tmp = $upload['tmp_name'];
                $file_type = $upload['type'];
                $file_ext = explode('/',$file_type);
                $retextension = strtolower(end($file_ext));
                $max_size = 5 * 1024 * 1024;
                
  
                $allowedExtensions = array('csv');
  
                if(!in_array($retextension, $allowedExtensions)){
                    $errors[] = "Extension not allowed, please choose a CSV File";
                }
  
                if($file_size > $max_size){
                    $errors[] = "File size is too large";
                }
  
                $uploadtype = $data;
                

                if(!in_array($uploadtype, ['country', 'currency'])){
                    $errors[] = "Upload type doesn't match, must either be (country or currency)";
                }
  
                switch($uploadtype){
                  case 'country': 
                      $target = UPLOAD_BASE_URL.COUNTRY_UPLOAD.$file_name;
                  break;
                  case 'currency':
                      $target = UPLOAD_BASE_URL.CURRENCY_UPLOAD.$file_name;
                  break;
                }

                if(empty($errors) === true){
  
                    if($this->save_upload($uploadtype, $target)){ // Saving uploaded file to database for audit and reference purpose
                        if(move_uploaded_file($file_tmp, $target)){
                            $processed_data = $this->batch_file_process($target);
                        
                            if(!empty($processed_data)){

                                $response = $this->batch_file_storage($uploadtype, $processed_data);

                                return $response;
                            }
                        }
                    }else{
                        return array('status'=> 0, 'error'=> 'Unable to save file, try later');
                    }
                    
                }else{
                    return array('status' => 0, 'error' => $errors);
                }
            
        }

        public function save_upload($upload_type, $url){
        
            $con = connection::getConnection();
    
            $sql = "INSERT INTO $this->uploads_table (`upload_type`, `url`) VALUE ('".$upload_type."','".$url."')";
    
            // return $sql;
            $result = $con->query($sql);
    
            return $result ? true : false;
        }

        public function batch_file_process($filepath){
            
            // Reading file
            $file = fopen($filepath, "r");
           
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
            //Read the contents of the uploaded file 
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                
                if ($i == 0) {
                    $i++;
                    continue;
                }

                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
           
            return $importData_arr;
        }

        public function batch_file_storage($uploadtype, $data){
            $cleaned_request = $this->sanitize($data);
        
            $con = connection::getConnection();

            $j = 0;
            $total = count($data);
            foreach ($data as $importData) {

                if($uploadtype == 'currency'){
                    $sql = "INSERT INTO ".$this->currency_table. "(`iso_code`, `iso_numeric_code`, `common_name`, `official_name`, `symbol`) VALUE ('" . implode("','", array_values($importData)). "')";
                }else if($uploadtype == 'country'){
                    $sql = "INSERT INTO ".$this->country_table. "(`continent_code`,`currency_code`,`iso2_code`,`iso3_code`,`iso_numeric_code`,`fips_code`,`calling_code`,`common_name`,`official_name`,`endonym`,`demonym`) VALUE ('" . implode("','", array_values($importData)). "')";
                }
               

                $result = $con->query($sql);
                
                $j++;
            }
            if($total == $j){
                return ['status'=> true, 'total'=>$total, 'uploaded'=> $j];
            }else{
                return ['status'=> false, 'total' => $total, 'uploaded'=>$j]; 
            }
            
           
        }
        
    }
        
        $upload = new Uploads();

}