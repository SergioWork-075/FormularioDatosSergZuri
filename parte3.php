<?php
/////////////CONTRASEÑA//////////////////////
$contra = filter_input(INPUT_GET, 'contra', FILTER_SANITIZE_STRING);
$mayus = preg_match('@[A-Z]@', $contra);
$minus = preg_match('@[a-z]@', $contra);
$num = preg_match('@[0-9]@', $contra);
$especial = preg_match('@[^\w]@', $contra);

////////////WEB///////////////////////
$web = filter_input(INPUT_GET, 'validacionWeb', FILTER_SANITIZE_STRING);
$webprueba = preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $web);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <LINK REL=StyleSheet HREF="estilo/style.css" TYPE="text/css" MEDIA=screen>
</head>

<body>
<div class="formulario">
    <h1>Formulario de Acceso</h1>
    <?php
    if (isset($_GET['Enviar'])) {
    /////////////ESMAIL//////////////////////
    if (false !== filter_var($_GET["validacionEmail"], FILTER_VALIDATE_EMAIL/*, FILTER_SANITIZE_EMAIL*/)) {
        $email = $_GET["validacionEmail"];
        $contador++;
    } else {
        $email = $_GET["validacionEmail"];
        echo 'EMAIL:Mail mal introducido<br/>';
    }
    /////////////WEB//////////////////////
    if (!$webprueba) {
        echo 'WEB:Mal introducido<br/>';
    }else{
        $contador++;
    }
    /////////////CONTRASEÑA//////////////////////
    if (!$especial) {
        echo "PASS:La contraseña debe tener un caracter especial!";
    }else{
        $contador++;
    }
    if (!$mayus || !$minus) {
        echo "<br>PASS:La contraseña debe tener MAYUS y MINUS!";
    }else{
        $contador++;
    }
    if (!$num) {
        echo "<br>PASS:La contraseña debe tener almenos un número!";
    }else{
        $contador++;
    }
    if (strlen($contra) < 8 || strlen($contra) > 16) {
        echo "<br>PASS:La contraseña debe tener entre 8 y 16 caracteres!";
    }else{
        $contador++;
    }

    if ($contador==6) {
        echo 'Validacion Completada. Pulse otra vez en "Enviar" para finalizar';

        $archivo="datos.txt";
        $file=fopen($archivo,"a");
        fwrite($file,$email.$contra.$web);
        fclose($file); 
    }else{
        $contador = 0;
    }
    
}
?>
    <div style="text-align:center;margin-top:40px;margin-bottom:40px">
        <span class="step"></span>
        <span class="step"></span>
        <span class="active"></span>
    </div>
    <form method="get" action="parte3.php">
    <!-- TERCERA PARTE -->
    <label>Correo
    <input name="validacionEmail" type="email" /></label>
    <label>Contraseña
    <input type="password" name="contra" value="" /></label>
    <label>Web
    <input name="validacionWeb" type="text" /></h2>
    <br>
    <input class="boton" type="submit" name="Enviar" />
    </form>
    </div>
</body>

</html>