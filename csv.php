<?php

class database{
  protected $db;
  function __construct(){
      $this->db = new mysqli("localhost","root","","iottech");
      if($this->db->connect_error){
          die("database is down");
      }
  }
}

   class csvfile extends database {
     private $year;
     private $sales;
     private $profit;
     private $expenses;
     private $sql;
     public function csvinsert(){
       $filename = $_FILES['fcsv']["name"];
       $filename = explode(".",$filename);
       if($filename[1] == "csv"){

        $handle = fopen($_FILES['fcsv']['tmp_name'], "r");
        $headers = fgetcsv($handle, 1000, ",");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
        {
           $this->year = $data[0];
           $this->sales = $data[1];
           $this->profit = $data[2];
           $this->expenses = $data[3];
           // $this->sql = "INSERT INTO chart(`year`,`sales`,`profit`,`expenses`)VALUES('$this->year','$this->sales','$this->profit','$this->expenses')";
           $this->sql = "INSERT INTO chart(`$headers[0]`,`$headers[1]`,`$headers[2]`,`$headers[3]`)VALUES('$this->year','$this->sales','$this->profit','$this->expenses')";
           $this->db->query($this->sql);
        }
    fclose($handle);
      http_response_code(201);
      echo "Successfuly inserted";
    }
    else{
      http_response_code(404);
      echo "<strong>Sorry!</strong> you are trying to upload bad file";
    }
     }
   }
$obj = new csvfile();
$obj->csvinsert();
?>