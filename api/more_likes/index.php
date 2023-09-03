<?php 
 require_once("../model.php"); 
class Likes extends Model{
    
        private $message = "";

        public function __construct(){
            $this->get_more_likes($this->connection()); 
        }
    
        public function get_more_likes($con){
            $selected_amount  = $this->input_value($_POST['select_amount_two']);
            $sel_amount_two = explode('-', $selected_amount);
            $sel_amount_two = $sel_amount_two[2];

            $business_name_two   = $this->input_value($_POST['business_name_two']);
            $whatsapp_number_two = $this->input_value($_POST['whatsapp_number_two']);
            $page_name_two       = $this->input_value($_POST['page_name_two']);
            $email_two           = $this->input_value($_POST['email_two']);
            $primary_text_two    = $this->input_value($_POST['primary_text_two']);

            $targetDir           = "C:/xampp/htdocs/primeadds/my_dashboard/dashboard/assets/img/uploaded_files/"; 
            $image_file_name     = basename($_FILES["add_image_two"]["name"]);


            // formData_two.append("add_image_two",       document.getElementById('image_two').files[0]);
            // formData_two.append("select_amount_two",   document.getElementById('select_amount_two').value);
            // formData_two.append("business_name_two",   document.getElementById('business_name_two').value);
            // formData_two.append("page_name_two",       document.getElementById('page_name_two').value);
            // formData_two.append("email_two",           document.getElementById('email_two').value);
            // formData_two.append("whatsapp_number_two", document.getElementById('whatsapp_number_two').value);
            // formData_two.append("primary_text_two",    document.getElementById('primary_text_two').value);
            
    
        if(!empty($sel_amount_two) && !empty($business_name_two) && !empty($whatsapp_number_two) && !empty($page_name_two) && !empty($email_two) && !empty($primary_text_two) && !empty($image_file_name)){
            // upload/save the image to the uploaded files folder  
            $targetFile = $targetDir . $image_file_name ; 
            move_uploaded_file($_FILES["add_image_two"]["tmp_name"], $targetFile);
            // creating record in  the database
    
            $record = "INSERT INTO `more_likes`(`select_amount`,`business_name`,`page_name`, `email` ,`whatsapp_number` ,`primary_text`, `image`) VALUES ('$sel_amount_two','$business_name_two', '$page_name_two', '$email_two', '$whatsapp_number_two', '$primary_text_two','$image_file_name')";
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
  

new Likes();
?>