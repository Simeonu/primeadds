<?php
  $curl = curl_init();
  $txref = $_GET['tref'];
  $txamount = $_GET['txamount'];
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/$txref",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_b4be91b1dede6a3073c1a1a3c338ed7e3d0edb06",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $response;
    $res = json_decode($response, true);
    if($res['data']['status'] =='success' && $res['data']['amount'] == $txamount){
      echo "payment verified";
      header("Location:./index.php");
    }else{
      echo "payment verification failed";
      header('Location: ./index.html');
      // echo $response;
    }
  }
?>