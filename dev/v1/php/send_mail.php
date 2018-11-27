<?php
 
if(isset($_POST['Email'])) {
    // CHANGE THE TWO LINES BELOW
    $email_to = "info@sytec.red";
     
    $email_subject = "Contacto - Formulario desde SYTEC.RED";
     
     
    function died($error) {
        // your error code can go here
        echo "Lo sentimos mucho, pero se encontraron errores con el formulario que envio. ";
        echo "Estos errores aparecen a continuación.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor regresa y arregla estos errores.<br /><br />";
        die();
        
    }
    // validation expected data exists
    if(!isset($_POST['Nombre']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Asunto']) ||
        !isset($_POST['Mensaje'])) {
        died('Lo sentimos, pero parece haber un problema con el formulario que envió.');       
    }
     
    $nombre = $_POST['Nombre']; // required
    $email = $_POST['Email']; // required
    $asunto = $_POST['Asunto']; // not required
    $mensaje = $_POST['Mensaje']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'La dirección de correo electrónico que ingresó no parece ser válida.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$nombre)) {
    $error_message .= 'El nombre que ingreso no parece ser valido.<br />';
  }
  if(strlen($asunto) < 2 ) {
    $error_message .= ' El asunto que ingreso no parece ser valido.<br />';
  }
  if(strlen($mensaje) < 2) {
    $error_message .= 'El mensaje que ingresaste no parecen ser validos.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Detalles del formulario a continuacion.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Nombre: ".clean_string($nombre)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Asunto: ".clean_string($asunto)."\n";
    $email_message .= "Mensaje: ".clean_string($mensaje)."\n";
     
     
// create email headers
$headers = 'DE: '.$email."\r\n".
'Copia para: '.$email."\r\n" .
'Email desde SYTEC.RED';
@mail($email_to, $email_subject, $email_message, $headers);
@mail($email, $email_subject, $email_message, 'Copia del Mensaje');

?>
 
<!-- place your own success html below -->
 
Gracias por contactarnos. Nos pondremos en contacto con usted muy pronto.
<a href="https://sytec.red">VOLVER</a>

<?php
}
die();

?>