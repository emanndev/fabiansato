<?php

$error = '';

//guardando los GETS que recibe el PHP mediante query URL en variables
$captcha = $_GET["g-recaptcha-response"];
$captcha = filter_var($captcha, FILTER_SANITIZE_STRING);
$captcha = trim($captcha);

$first_name= $_GET["first_name"];
$first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
$first_name = trim($first_name);

$last_name = $_GET["last_name"];
$last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
$last_name = trim($last_name);

$email = $_GET["email"];
$email = filter_var($email,FILTER_SANITIZE_EMAIL);

$cuerpo = '';




//print json en pantalla
echo "first_name:" .$first_name. "<br>";
echo "last_name:" .$last_name. "<br>";
echo "email:" .$email. "<br>";
echo "<br>";


//CUERPO DEL Mail que se va a enviar
$cuerpo .= "Nombre: ";
$cuerpo .= $first_name;
$cuerpo .= "\n";

$cuerpo .= "Mensaje: ";
$cuerpo .= $last_name;
$cuerpo .= "\n";

$cuerpo .= "Email: ";
$cuerpo .= $email;
$cuerpo .= "\n";





//DIRECCIÓN
$enviarA = 'modalsurveyus@gmail.com'; //REEMPLAZAR CON TU CORREO ELECTRÓNICO
$asunto = 'Formulario Sandbox enviado';

//ENVIAR CORREO
if($error == ''){
    $success = mail($enviarA,$asunto,$cuerpo,'de: '.$email);
    


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
      CURLOPT_POSTFIELDS =>" {
        \r\n    
        \"first_name\": \"$first_name\",\r\n
        \"last_name\": \"$last_name\",\r\n   
        \"email\": \"$email\",\r\n 


      } ",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer 8cf90219c88ce47b14c992ae0512bd0f2c520427"
        
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
  //  echo $response;
    echo "Exito <br>";
    echo "formulario enviado...";
	header("Location: https://ar-promo.unileverservices.com/sandbox-exito/");
    
    

}else{
    echo $error;
}

?>