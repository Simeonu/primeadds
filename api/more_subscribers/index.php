<?php 
 require_once("../model.php"); 
class Subscriber extends Model{
    
        private $message = "";

        public function __construct(){
            $this->get_subscribers($this->connection()); 
        }
    
        public function get_subscribers($con){
            $selected_amount  = $this->input_value($_POST['select_amount']);
            $sel_amount = explode('-', $selected_amount);
            $sel_amount = $sel_amount[2];

            $buisness_name   = $this->input_value($_POST['buisness_name']);
            $whatsapp_number = $this->input_value($_POST['whatsapp_number']);
            $primary_text    = $this->input_value($_POST['primary_text']);
            $email           = $this->input_value($_POST['email']);
            $business_link   = $this->input_value($_POST['business_link']);

            $targetDir       = "C:/xampp/htdocs/primeadds/my_dashboard/dashboard/assets/img/uploaded_files/"; 
            $image_file_name = basename($_FILES["add_image"]["name"]);
            
    
        if(!empty($sel_amount) && !empty($buisness_name) && !empty($whatsapp_number) && !empty($primary_text) && !empty($email) && !empty($business_link) && !empty($image_file_name)){
            // upload/save the image to the uploaded files folder  
            $targetFile = $targetDir . $image_file_name ; 
            move_uploaded_file($_FILES["add_image"]["tmp_name"], $targetFile);
            // creating record in  the database
    
            $record = "INSERT INTO `more_subscribers`(`select_amount`,`business_name`,`whatsapp_number`, `primary_text` ,`email` ,`business_link`, `image`) VALUES ('$sel_amount','$buisness_name', '$whatsapp_number', '$primary_text', '$email', '$business_link','$image_file_name')";
            $query = $con->query($record);
    
            if($query){
                $this->message = "success";
            }else{
                $this->message = "failed to submit:".$con->error;
            }
        }else{
                $this->message = 'All fields are required';
                
                //(.implode(',' , $_POST))using the implode to convert the array to string to check which value that was not captured //
        }
    
    
        
            // converting the output to json
            header('Content-Type', 'application/json');
            echo json_encode( ['message' => $this->message]);
        }
    


}
  

new Subscriber();
?>