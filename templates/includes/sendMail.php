<?php

$data = json_decode(file_get_contents('php://input'), true);
//extract($data);

$name = $data['name'];
$email = $data['email'];
$phone = $data['phone'];
$subject = $data['subject'];
$message = $data['message'];



$error = ""; 

// if(!$recaptchaPublic == '' && !$recaptchaPrivate == ''){
//   $responseGoogle = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptchaPrivate."&response=".$_POST['g-recaptcha-response']);

//   $responseGoogle = json_decode($responseGoogle,true);

//   if($responseGoogle['success'] == true){

//   }else{
//     $error .= "Asegurate de que no seas un robot... 🤖 </br>";
//   }
// }



  if(empty($name)){
    $error .= "Ingresa un nombre </br>";
  }else{
   
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $name = trim($name);
    if($name === ''){
      $error .= "Nombre esta vacío </br>";
    }
  }

  if(empty($email)){
    $error .= "Ingresa un E-mail </br>";
  }else{
   
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $error .= "Ingresa un E-mail correcto </br>";
    }else{
      
      $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    }
  }

  if(empty($phone)){
    $error .= "Ingresa un número de teléfono </br>";
  }else{
   
    $phone = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
    $phone = trim($phone);
    if($phone === ''){
      $error .= "Teléfono esta vacío </br>";
    }
  }

  if(empty($subject)){
    $error .= "Ingresa un Asunto </br>";
  }else{
    
    $subject = filter_var($subject,FILTER_SANITIZE_STRING);
    $subject = trim($subject);
    if($subject === ''){
      $error .= "El asunto esta vacío </br>";
    }
  }

  if(empty($message)){
    $error .= "Ingresa un Mensaje </br>";
  }else{
    
    $message = filter_var($message,FILTER_SANITIZE_STRING);
    $message = trim($message);
    if($message === ''){
      $error .= "El mensaje esta vacío </br>";
    }
  }

  $body = "<p><strong>Nombre: </strong>" . $name . "</p>" .
          "<p><strong>Correo: </strong>" . $email . "</p>" .
          "<p><strong>Teléfono: </strong>" . $phone . "</p>" .
          "<p><strong>Asunto: </strong>" . $subject . "</p>" .
          "<p><strong>Mensaje: </strong>" . $message ."</p>";

  $receiver = 'dev@hektor.mx';
  $headers = 'From: '.$email."\r\n".
              'Reply-To:'.$email."\r\n".
              'X-Mailer: PHP5\n';
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
  
  if($error == ""){
    $success = mail($receiver,$subject,$body,$headers);
    echo 'true';
  }else{
    echo $error;
    
  }

?>