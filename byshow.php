<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST,GET,PUT,PATCH,DELETE");
  header("Content-Type: application/json");
  header("Access-Control-Allow-headers: Access-Control-Allow-headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Request-width");
  abstract class database{
      protected $db;
      protected $data = [];
      protected $response;
      protected $other;
      public function __construct(){
           $this->db = new mysqli("localhost","root","","iottechh");
          // error_reporting(0);
           if($this->db->connect_error){
               die("Oops! Server has beed down.");
           }
      }

  }

  class main extends database{

    public function requesthttp():void{
        if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
            if(isset($_POST["machineNo"])){
              $this->machineNo();
            }
            else  if(isset($_POST["from"])){
                $this->form();
            }
            else  if(isset($_POST["shift"])){
                $this->shift();
            }
        } 
    }

    // ==================================
    // start show data by machine no
    private function machineNo():void{
        $this->other = $_POST["machineNo"];
        $this->other = "SELECT * FROM machinedata WHERE machineNo = '$this->other'";
        $this->response = $this->db->query($this->other);
        if ($this->response->num_rows != 0) {
            while ($this->other = $this->response->fetch_assoc()){
                array_push($this->data, $this->other);
            }
            http_response_code(200);
            echo json_encode($this->data);
        } else {
            http_response_code(404);
            echo json_encode(array("status" => "No data in server of this machine number"));
        }
        $this->db->close();
    }
    // end show data by machine no

    // start show data by from and to
    private function form():void{
        $from = $_POST["from"];
        $to = $_POST["to"];
        $this->other = "SELECT * FROM machinedata WHERE `dates` >= '$from' and `dates` <= '$to'";
        $this->response = $this->db->query($this->other);
        if ($this->response->num_rows != 0) {
            while ($this->other = $this->response->fetch_assoc()){
                array_push($this->data, $this->other);
            }
            http_response_code(200);
            echo json_encode($this->data);
        } else {
            http_response_code(404);
            echo json_encode(array("status" => "No data in server between in this dates"));
        }
        $this->db->close();
    }
    // end show data by from and to

    // start show data by from and to
    private function shift():void{
      /*  $date = $_POST["date"];
        $shift = $_POST["shift"];
        $this->other = "SELECT * FROM machinedata WHERE `dates` >= '$date' and `dates` <= '$shift'";
        $this->response = $this->db->query($this->other);
        if ($this->response->num_rows != 0) {
            while ($this->other = $this->response->fetch_assoc()){
                array_push($this->data, $this->other);
            }
            http_response_code(200);
            echo json_encode($this->data);
        } else {
            http_response_code(404);
            echo json_encode(array("status" => "No data in server on this shift"));
        }
        $this->db->close();
        */
        echo "shift data";
    }
    // end show data by from and to
}
$ob = new main();
$ob->requesthttp();

?>