<?php 

require_once("../model.php");
class Login extends Model{
    private $message = "";

    public function __construct(){
        $this->user($this->connection());
    }

    public function user($con){ 
          $input = file_get_contents('php://input');
          $obj   = json_decode($input);

          $eamil_username = $this->input_value($obj->email_username);
          $password       = $this->input_value($obj->password);

        //   $eamil_username  = $this->input_value($_POST['eamil_username']);
        //   $password        = $this->input_value($_POST['password']);

        if(!empty($eamil_username) && !empty($password)){
           $password = sha1(md5(md5($password)));

            //    creating record in the database
            $sql   = "SELECT * FROM  `users` WHERE `email` = '$eamil_username' OR `username` = '$eamil_username'";
            $query = $con->query($sql);

            //    check if the query succeeded
            if($query){
                $row = $query->fetch_assoc();
                // compare the passwords
                if($row['password']  == $password){
                    // set the session
                    session_start();
                    $_SESSION['prime_adds_user'] = $row['username'];
                    $this->message  = "success";
                }else{
                    $this->message = "failed to login:".$con->error;
                }
            }else{
                $this->message = 'All fields are required';
            }
        } 

        // converting the output of the page to json

        header('Content-Type: application/json');

        echo json_encode( ['message' => $this->message]);
    }
    


}

new Login();
?>