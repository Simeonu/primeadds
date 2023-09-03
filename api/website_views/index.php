<?php 
 require_once("../model.php"); 
class Views extends Model{
    
        private $message = "";

        public function __construct(){
            $this->more_views($this->connection()); 
        }
    
        public function more_views($con){
            $selected_amount       = $this->input_value($_POST['select_amount_three']);
            $sel_amount            = explode('-', $selected_amount);
            $sel_amount            = $sel_amount[2];

            $business_name_three   = $this->input_value($_POST['business_name_three']);
            $site_name_three       = $this->input_value($_POST['site_name_three']);
            $whatsapp_number_three = $this->input_value($_POST['whatsapp_number_three']);
            $email_three           = $this->input_value($_POST['email_three']);
            $primary_text_three    = $this->input_value($_POST['primary_text_three']);

            $targetDir       = "C:/xampp/htdocs/primeadds/my_dashboard/dashboard/assets/img/uploaded_files/"; 
            $image_file_name = basename($_FILES["add_image_three"]["name"]);
            
    
        if(!empty($sel_amount) && !empty($business_name_three) && !empty($site_name_three) && !empty($whatsapp_number_three) && !empty($email_three) && !empty($primary_text_three) && !empty($image_file_name)){
            // upload/save the image to the uploaded files folder  
            $targetFile = $targetDir . $image_file_name ; 
            move_uploaded_file($_FILES["add_image_three"]["tmp_name"], $targetFile);
            // creating record in  the database
    
            $record = "INSERT INTO `more_views`(`select_amount`,`business_name`,`site_name`, `whatsapp_number` ,`email` ,`primary_text`, `image`) VALUES ('$sel_amount','$buisness_name', '$site_name_three', '$whatsapp_number_three', '$email_three', '$primary_text_three','$image_file_name')";
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
  

new Views();
?>