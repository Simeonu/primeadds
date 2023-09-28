<?php 

class Model{

     public function connection(){
        return new Mysqli("localhost", "root", "", "prime_adds");
      //   return new Mysqli("localhost", "primeadd_primeadds", "Simeon&13890", "primeadd_primeadds");
     }

     public function input_value($data){
      //   $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }


     // this function rturns the user details using the username
     public function getUserByUserName($userName){
         $con = $this->connection();
         $q   = $con->query("SELECT * FROM `users` WHERE `username` = '$userName'");
         return $q->fetch_assoc();
     }

}


// work around base class 
class Common extends Model{
   
}

$common = new Common();

?>