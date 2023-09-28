<?php 
 require_once("../model.php"); 
class Messages extends Model{
    
        private $message = "";

        public function __construct(){
            $this->more_messages($this->connection()); 
        }
    
        public function more_messages($con){
            $selected_amount  = $this->input_value($_POST['select_amount_four']);
            $sel_amount_two = explode('-', $selected_amount);
            $sel_amount_two = $sel_amount_two[2];

            $business_name_four   = $this->input_value($_POST['business_name_four']);
            $whatsapp_number_four = $this->input_value($_POST['whatsapp_number_four']);
            $primary_text_four    = $this->input_value($_POST['primary_text_four']);
            $email_four           = $this->input_value($_POST['email_four']);

            $targetDir           = "C:/xampp/htdocs/primeadds/my_dashboard/dashboard/assets/img/uploaded_files/"; 
            $image_file_name     = basename($_FILES["add_image_four"]["name"]);


            // formData_two.append("add_image_two",       document.getElementById('image_two').files[0]);
            // formData_two.append("select_amount_two",   document.getElementById('select_amount_two').value);
            // formData_two.append("business_name_two",   document.getElementById('business_name_two').value);
            // formData_two.append("page_name_two",       document.getElementById('page_name_two').value);
            // formData_two.append("email_two",           document.getElementById('email_two').value);
            // formData_two.append("whatsapp_number_two", document.getElementById('whatsapp_number_two').value);
            // formData_two.append("primary_text_two",    document.getElementById('primary_text_two').value);
            
    
        if(!empty($select_amount_four) && !empty($business_name_four) && !empty($whatsapp_number_four) && !empty($primary_text_four) && !empty($email_four) && !empty($image_file_name)){
            // upload/save the image to the uploaded files folder  
            $targetFile = $targetDir . $image_file_name ; 
            move_uploaded_file($_FILES["add_image_two"]["tmp_name"], $targetFile);
            // creating record in  the database
    
            $record = "INSERT INTO `whatsapp_messages`(`select_amount`,`business_name`,`whatsapp_number`, `primary_text`, `email`, `image`) VALUES ('$sel_amount_two','$business_name_two', '$page_name_two', '$email_two', '$whatsapp_number_two', '$primary_text_two','$image_file_name')";
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
  

new Messages();
?>