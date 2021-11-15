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

if (isset($_GET['Enviar'])) {
    /////////////eMAIL//////////////////////
    if (false !== filter_var($_GET["validacionEmail"], FILTER_VALIDATE_EMAIL/*, FILTER_SANITIZE_EMAIL*/)) {
        $email = $_GET["validacionEmail"];
        echo 'Bien introducido<br/>';
        echo $email;
    } else {
        $email = $_GET["validacionEmail"];
        echo 'Mail mal introducido<br/>';
        echo $email;
    }
    /////////////WEB//////////////////////
    if (false !== filter_var($_GET["validacionWeb"], FILTER_VALIDATE_URL/*, FILTER_SANITIZE_URL*/)) {
        echo 'Bien introducido<br/>';
    } else {
        echo 'Web mal introducido';
    }
    if (!$especial) {
        echo "La contraseña debe tener un caracter especial!";
    }
    if (!$mayus || !$minus) {
        echo "<br>La contraseña debe tener MAYUS y MINUS!";
    }
    if (!$letras) {
        echo "<br>Has introducido algun caracter que no es un numero";
    }
    if (!$num) {
        echo "<br>La contraseña debe tener almenos un número!";
    }
    if (strlen($contra) < 8 || strlen($contra) > 16) {
        echo "<br>La contraseña debe tener entre 8 y 16 caracteres!";
    } else {
        echo "Todo piola :)";
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
