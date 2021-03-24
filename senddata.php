<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST,GET,PUT,PATCH,DELETE");
  header("Content-Type: application/json");
  header("Access-Control-Allow-headers: Access-Control-Allow-headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Request-width");
  class database{
      protected $db;
      protected $data = [];
      protected $fetch;
      protected $sql;
      function __construct(){
          $this->db = new mysqli("localhost","root","","iottech");
          if($this->db->connect_error){
              die("database is down");
          }
      }
  }

  class chart extends database{
      public function httpcall(){
        if(strtoupper($_SERVER["REQUEST_METHOD"]) == "GET"){
          $this->getcall();
        }
        else if(strtoupper($_SERVER["REQUEST_METHOD"]) == "POST"){
            $this->chartdata();
        }
      }
// start GET function call
public function getcall(){
        $sql = "SELECT * FROM chart";
          $this->fetch = $this->db->query($sql);
          if($this->fetch->num_rows != 0){
              //$data = array("type"=>"success");
            //array_push($this->data,$data); 
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

      // start post function call
    public function chartdata(){
        $year = $_POST["year"];
        $sales = $_POST["sales"];
        $profit =$_POST["profit"];
        $expenses =$_POST["expenses"];
       // $this->sql = "INSERT INTO chart(`year`,`sales`,`profit`,`xpenses`)VALUES('$year','$sales','$profit','$expenses')";
       $this->sql = "INSERT INTO chart(`year`,`sales`,`profit`,`expenses`)VALUES('$year','$sales','$profit','$expenses')";
      
       if($this->db->query($this->sql)){
           $data = array("year"=>$year,"sales"=>$sales,"profit"=>$profit,"expenses"=>$expenses);
          $this->data = array("type"=>"success","data"=>$data);

         http_response_code(200);
         echo json_encode($this->data);
      }
      else{
          http_response_code(404);
          $sms = array("type"=>"error");
          echo json_encode($sms);
      }
    }

  }
 $obj = new chart();
 $obj->httpcall();
?>