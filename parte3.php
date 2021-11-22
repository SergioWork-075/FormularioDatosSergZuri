<?php
/////////////CONTRASEÑA//////////////////////
$email = filter_input(INPUT_GET, 'validacionEmail',FILTER_VALIDATE_EMAIL);
$contra = filter_input(INPUT_GET, 'contra', FILTER_SANITIZE_STRING);
$mayus = preg_match('@[A-Z]@', $contra);
$minus = preg_match('@[a-z]@', $contra);
$num = preg_match('@[0-9]@', $contra);
$especial = preg_match('@[^\w]@', $contra);

////////////WEB///////////////////////
$web = filter_input(INPUT_GET, 'validacionWeb', FILTER_SANITIZE_STRING);
$webprueba = preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $web);

$contador3=0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Acceso</title>
    <LINK REL=StyleSheet HREF="estilo/style.css" TYPE="text/css" MEDIA=screen>
</head>

<body>
<div class="formulario">
    <h1>Formulario de Acceso</h1>
    <?php
    if (isset($_GET['Enviar'])) {
    /////////////ESMAIL//////////////////////
    if ($email) {
        $g_email = $email;
        $contador3++;
    } else {
        $g_email = "";
        $email  = "";
        echo '<a>EMAIL: </a>Mail mal introducido<br/>';
    }
    /////////////WEB//////////////////////
    if (!$webprueba) {
        echo '<a>WEB: </a>Mal introducido<br/>';
        $g_web = "";
        $web  = "";
    }else{
        $g_web = $web;
        $contador3++;
    }
    /////////////CONTRASEÑA//////////////////////
    if (!$especial) {
        echo "<a>PASS: </a>La contraseña debe tener un caracter especial!<br>";
        $g_contra = "";
        $contra  = "";
    }else{
        $g_contra = $contra;
        $contador3++;
    }
    if (!$mayus || !$minus) {
        echo "<a>PASS: </a>La contraseña debe tener MAYUS y MINUS!<br>";
        $g_contra = "";
        $contra  = "";
    }else{
        $g_contra = $contra;
        $contador3++;
    }
    if (!$num) {
        echo "<a>PASS: </a>La contraseña debe tener almenos un número!<br>";
        $g_contra = "";
        $contra  = "";
    }else{
        $g_contra = $contra;
        $contador3++;
    }
    if (strlen($contra) < 8 || strlen($contra) > 16) {
        echo "<a>PASS: </a>La contraseña debe tener entre 8 y 16 caracteres!<br>";
        $g_contra = "";
        $contra  = "";
    }else{
        $g_contra = $contra;
        $contador3++;
    }

    if ($contador3==6) {
        echo '<div class="finalizado"><a>Validacion Completada.</a> <br>Ha finalizado el formulario</div>';

        $archivo="datos.txt";
        $file=fopen($archivo,"a");
        fwrite($file,"EMAIL: ".$email."\n"."CONTRASEÑA: ".$contra."\n"."WEB: ".$web."\n");
        fclose($file); 
    }else{
        $contador3 = 0;
    }
    
}
?>
    <div style="text-align:center;margin-top:40px;margin-bottom:40px">
        <span class="step"></span>
        <span class="step"></span>
        <span class="active"></span>
    </div>
    <form method="get" action="<?php if ($contador3<6) {  ?>
        parte3.php <?php }
    else{ ?>
            final.php <?php
    }?>">
    <!-- TERCERA PARTE -->
    <label>Correo
    <input name="validacionEmail" type="text" placeholder="Escriba su email..." value="<?php echo $email; ?>"/></label><br>
    <label>Passw
    <input type="password" name="contra" placeholder="Que sea segura..."value="<?php echo $web; ?>" /></label><br>
    <label>Web
    <input name="validacionWeb" type="text" placeholder="Escriba su pagina..." value="<?php echo $web; ?>"/></label>
    <br>
    <input class="boton" type="submit" name="Enviar"  />
    </form>
    </div>
</body>

</html>