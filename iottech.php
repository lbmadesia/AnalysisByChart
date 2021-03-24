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
        if(strtoupper($_SERVER["REQUEST_METHOD"]) == "GET"){
          $this->getdata();
        } else if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
            $this->postdata();
        } else if (strtoupper($_SERVER["REQUEST_METHOD"]) == "DELETE") {
            $this->deletedata();
        } else if (strtoupper($_SERVER["REQUEST_METHOD"]) == "PUT") {
            $this->putdata();
        } else if (strtoupper($_SERVER["REQUEST_METHOD"]) == "PATCH") {
           $this->patchdata();
        }
    }
    // start get method to access data from server
    private function getdata():void{
        $this->other = "SELECT * FROM machinedata";
        $this->response = $this->db->query($this->other);
        if ($this->response->num_rows != 0) {
            while ($this->other = $this->response->fetch_assoc()) {
                array_push($this->data, $this->other);
            }
            http_response_code(200);
            echo json_encode($this->data);
        } else {
            http_response_code(404);
            echo json_encode(array("status" => "No data in server"));
        }
        $this->db->close();
    }
    //start post method to insert data in server
    private function postdata():void{
        $machineNo = addslashes(htmlspecialchars(trim($_POST["machineNo"])));
        $machineType = addslashes(htmlspecialchars(trim($_POST["machineType"])));
        $sourcePoint = addslashes(htmlspecialchars(trim($_POST["sourcePoint"])));
        $targetValue = addslashes(htmlspecialchars(trim($_POST["targetValue"])));
        $dates = addslashes(htmlspecialchars(trim($_POST["dates"])));
        $this->other = $this->db->prepare("INSERT INTO  machinedata(`machineNo`,`machineType`,`sorcePoint`,`targetValue`,`dates`)VALUES(?,?,?,?,?)");
        $this->other->bind_param('ssdds',$machineNo,$machineType,$sourcePoint,$targetValue,$dates);
        if($this->other->execute()){
            http_response_code(201);
            echo json_encode(array("status" => "Successfuly data inserted"));
        }
        else{
            http_response_code(404);
            echo json_encode(array("status"=>"data not inserted"));
        }
        $this->other->close();
        $this->db->close();
    }
    // start put or push method to update in database
    private function putdata():void{
        $userid = json_decode(file_get_contents("php://input"), true);
        $machineNo = $userid["machineNo"];
        $machineNo = addslashes(htmlspecialchars(trim($machineNo)));
        $machineType = $userid["machineType"];
        $machineType = addslashes(htmlspecialchars(trim($machineType)));
        $sourcePoint = $userid["sourcePoint"];
        $sourcePoint = addslashes(htmlspecialchars(trim($sourcePoint)));
        $targetValue = $userid["targetValue"];
        $targetValue = addslashes(htmlspecialchars(trim($targetValue)));
        $dates = $userid["dates"];
        $dates = addslashes(htmlspecialchars(trim($dates)));
        $this->other = $this->db->prepare("UPDATE machinedata SET machineType = ?, sourcePoint = ?, targetValue = ?, dates = ?, WHERE machineNo = ?");
        $this->other->bind_param("sssss", $machineType,$sourcePoint,$targetValue,$dates,$machineNo);
        $this->other->execute();
        if ($this->other->affected_rows != 0) {
            http_response_code(202);
            echo json_encode(array("status" => "Successfully updated"));
        } else {
            http_response_code(404);
            echo json_encode(array("status" => "Oops! did not update."));
        }
    }
    // start DELETE method to delete data form database
    private function deletedata():void
    {
        $userid = json_decode(file_get_contents("php://input"),true);
        $machineNo=$userid["machineNo"];
        $machineNo= addslashes(htmlspecialchars(trim($machineNo)));
        $this->other = $this->db->prepare("DELETE FROM machinedata WHERE machineNo = ?");
        $this->other->bind_param("s",$machineNo);
        $this->other->execute();
        if($this->other->affected_rows != 0){
            http_response_code(202);
            echo json_encode(array("status"=>"Successfully deleted"));
        }
        else{
            http_response_code(404);
            echo json_encode(array("status" => "Oops! did not delete."));
        }
    }

    // start patch method to fetch particular row from database
    private function patchdata():void{
        $userid = json_decode(file_get_contents("php://input"), true);
        $machineNo=$userid["machineNo"];
        $machineNo= addslashes(htmlspecialchars(trim($machineNo)));
        $this->other = "SELECT * FROM machinedata WHERE machineNo = '$machineNo'";
        $this->other = $this->db->query($this->other);
        if ($this->other->num_rows != 0) {
            $this->other = $this->other->fetch_assoc();
            http_response_code(200);
            echo json_encode($this->other);
        } else {
            http_response_code(404);
            echo json_encode(array("status" => "Oops! did not fetch."));
        }
    }
  }
  $ob = new main();
$ob->requesthttp();
?>