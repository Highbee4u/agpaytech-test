<?php  
// filename: Country.php

require_once 'config/database.php';

if(!class_exists('Country')){
    
    Class Country{

        private $table = 'country';
    
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
    
        public function fetch_all(){
            
            $data = array();
    
            $con = connection::getConnection();
    
            $sql = "SELECT * FROM $this->table";
    
            $result = $con->query($sql);
    
            if($result){
    
                while($row = $result->fetch_assoc()){
    
                    $data[] = $row;
    
                }
            }
            if(count($data) > 0){
                return array('total_records'=> count($data), 'record' => $data);
            }else{
                return array('total_records'=> 0);
            }
            
        }
    
        public function fetch_by_paginate($page, $results_per_page, $page_first_result){
            
            $data = array();
    
            $con = connection::getConnection();

            $query = "SELECT * FROM $this->table";

            $res = $con->query($query);

            $number_of_result = $res->num_rows;
    
            $sql = "SELECT * FROM $this->table LIMIT " . $page_first_result . ',' . $results_per_page; 
    
            $result = $con->query($sql);

          

            $number_of_page = ceil ($number_of_result / $results_per_page); 
    
            if($result){
    
                while($row = $result->fetch_assoc()){
    
                    $data[] = $row;
    
                }
            }
    
            return array('total_pages'=> $number_of_page, 'current_page'=>$page, 'record'=> $data);
        }
        
    }
        
        $country = new Country();

}