<?php
/*Make sure you change the default form action on to point to this method and form method=POST*/
public function mtnmomo(){
  $typebouton = $_POST['typebouton'];
  $idbuoton = $_POST['idbouton'];
  $_amount = $_POST['amount'];
  $_tel = $_POST['momonumber'];
  $_email = "example@gmail.com"; //Your MTN MoMo Online Account Email
  $submitx = "150";// or $_POST['submitx'] if posted from the form
  $submity = "51"; // or $_POST['submity'] if posted from the form
  $_clp=$_POST['clP'];

  $errors = array();
  $output = NULL;

  // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://developer.mtn.cm/OnlineMomoWeb/faces/transaction/transactionRequest.xhtml");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "idbouton=$idbouton&typebouton=$typebouton&_amount=$_amount&_tel=$_tel&_clP=$_clp&_email=$_email&submit.x=$submitx&submit.y=$submity");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, true); //false will prevent curl from verifying the SSL certificate

  $result = curl_exec($ch);


  if (curl_errno($ch)) {
      $reply = json_encode(array('505'=>'CURL Error:' . curl_error($ch)));// CURL error
  }else{
      $reply = $result;
  }
  curl_close ($ch);

  $reply = json_decode($result, true);
  if ($reply['StatusCode'] == "01") {//Success, do something here
    //TODO...
    
  }else{
      return $reply['StatusCode'];
  }
  /*
    01          Success
    100         Fail
    1000        Pending
    101         No credit
    102         Auth faild
    103         Syntax error
   */

}
?>
