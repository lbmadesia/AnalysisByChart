<?php
  class database{
      protected $db;
      protected $data=[];
      protected $fetch;
      function __construct(){
          $this->db = new mysqli("localhost","root","","iottech");
          if($this->db->connect_error){
              die("database is down");
          }
      }
  }

  class chart extends database{
    public function chartdata(){
    $sql = "SELECT * FROM chart";
      $this->fetch = $this->db->query($sql);
      if($this->fetch->num_rows != 0){
          while($data = $this->fetch->fetch_assoc()){
              array_push($this->data,$data);
          }
         http_response_code(200);
         echo json_encode($this->data);
      }
      else{
          http_response_code(404);
          echo json_encode("No data in database");
      }
    }

  }
 $obj = new chart();
 $obj->chartdata();
?>