<?php
/////COMPROBACION QUE NO ESCRIBA NUMEROS////
$nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
$apelli = filter_input(INPUT_GET, 'apellido', FILTER_SANITIZE_STRING);
$ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_STRING);
$letras = preg_match('@[^A-Za-z]@', $nombre);

/////////////CONTRASEÑA//////////////////////
$contra = filter_input(INPUT_GET, 'contra', FILTER_SANITIZE_STRING);
$mayus = preg_match('@[A-Z]@', $contra);
$minus = preg_match('@[a-z]@', $contra);
$num = preg_match('@[0-9]@', $contra);
$especial = preg_match('@[^\w]@', $contra);

/////////////WEB///////////////////////////////////
$web = filter_input(INPUT_GET, 'validacionWeb', FILTER_SANITIZE_STRING);
$webprueba= preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web);

if (isset($_GET['Enviar'])) {
    /////COMPROBACION QUE NO ESCRIBA NUMEROS////
    if ($letras) {
        echo "<br>NOMBRE:Has introducido algun caracter que no es una letra<br/>";
    }
    /////////////eMAIL//////////////////////
    if (false !== filter_var($_GET["validacionEmail"], FILTER_VALIDATE_EMAIL/*, FILTER_SANITIZE_EMAIL*/)) {
        $email = $_GET["validacionEmail"];
        echo 'EMAIL:Bien introducido<br/>';

    } else {
        $email = $_GET["validacionEmail"];
        echo 'EMAIL:Mail mal introducido<br/>';

    }
    /////////////WEB//////////////////////
    if (!$webprueba) {
        echo 'WEB:Mal introducido<br/>';
    } else {
        echo 'WEB:Bien introducido<br>';
    }
    /////////////CONTRASEÑA//////////////////////
    if (!$especial) {
        echo "PASS:La contraseña debe tener un caracter especial!";
    }
    if (!$mayus || !$minus) {
        echo "<br>PASS:La contraseña debe tener MAYUS y MINUS!";
    }
    if (!$num) {
        echo "<br>PASS:La contraseña debe tener almenos un número!";
    }
    if (strlen($contra) < 8 || strlen($contra) > 16) {
        echo "<br>PASS:La contraseña debe tener entre 8 y 16 caracteres!";
    } else {
        echo "PASS:Todo piola :)";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Acceso</title>
</head>

<body>
<h1>Formulario de Acceso</h1>
</form>
<form method="get" action="index.php">
    <h2>Nombre</h2>
    <input name="nombre" type="text" />
    <h2>Apellidos</h2>
    <input name="apellido" type="text" />
    <h2>Ciudad</h2>
    <input name="ciudad" type="text" />
    <h2>Correo</h2>
    <input name="validacionEmail" type="email" />
    <h2>Contraseña</h2>
    <input type="text" name="contra" value="" />
    <h2>Web</h2>
    <input name="validacionWeb" type="text" />

    <input type="submit" name="Enviar" />

</form>
</body>

</html>

