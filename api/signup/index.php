<?php 

require_once("../model.php");
class Signup extends Model{

    private $message = "";

    public function __construct(){
        $this->user($this->connection());
    }

    public function user($con){ 
          $input = file_get_contents('php://input');
          $obj   = json_decode($input, true);

        //   $name      = $this->input_value($_POST['name']);
        //   $email     = $this->input_value($_POST['email']);
        //   $username  = $this->input_value($_POST['username']);
        //   $password  = $this->input_value($_POST['password']);

          $name      = $this->input_value($obj['name']);
          $email     = $this->input_value($obj['email']);
          $username  = $this->input_value($obj['username']);
          $password  = $this->input_value($obj['password']);
     

        if(!empty($name) && !empty($email) && !empty($username) &&!empty($password)){
           $password = sha1(md5(md5($password)));

            //    creating record in the database
            $sql   = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `created_at`) VALUES ('$name', '$email', '$username', '$password', NOW() )" ;
            $query = $con->query($sql);

            //    check if the query succeeded
            if($query){
                $this->message  = "success";
            }else{
                $this->message = "failed to create account:".$con->error;
            }
        }else{
                $this->message = 'All fields are required';
            }

        // converting the output of the page to json

        header('Content-Type: application/json');

        echo json_encode( ['message' => $this->message]);
    }
    


}

new Signup();
?>