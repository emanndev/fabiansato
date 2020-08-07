<?php

$error = '';

//VALIDANDO NOMBRE
$captcha = $_GET["g-recaptcha-response"];
$captcha = filter_var($captcha, FILTER_SANITIZE_STRING);
$captcha = trim($captcha);



$nombre = $_GET["first_name"];
$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
$nombre = trim($nombre);

$apellido = $_GET["last_name"];
$apellido = filter_var($apellido, FILTER_SANITIZE_STRING);
$apellido = trim($apellido);


$email = $_GET["email"];
$email = filter_var($email,FILTER_SANITIZE_EMAIL);


//CUERPO DEL MENSAJE
$cuerpo .= "Nombre: ";
$cuerpo .= $nombre;
$cuerpo .= "\n";
 
$cuerpo .= "Email: ";
$cuerpo .= $email;
$cuerpo .= "\n";
 
$cuerpo .= "Mensaje: ";
$cuerpo .= $apellido;
$cuerpo .= "\n";

//DIRECCIÓN
$enviarA = 'fabiansato@gmail.com'; //REEMPLAZAR CON TU CORREO ELECTRÓNICO
$asunto = 'Nuevo mensaje de mi sitio web';

//ENVIAR CORREO
if($error == ''){
    $success = mail($enviarA,$asunto,$cuerpo,'de: '.$email);
    echo 'exito';


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://sandbox.bunkerdb.com/api/v4/consumers",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>" {\r\n    \"first_name\": \"$nombre\",\r\n    \"last_name\": \"$apellido\",\r\n    \"email\": \"$email\"\r\n  } ",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer 8cf90219c88ce47b14c992ae0512bd0f2c520427"
        
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
  //  echo $response;
    echo "formulario enviado...";
	header("Location: https://ar-promo.unileverservices.com/exito-sandbox");
    
    

}else{
    echo $error;
}

?>