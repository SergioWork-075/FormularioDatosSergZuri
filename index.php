<?php
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
/////////////CONTRASEÑA//////////////////////
$contra = filter_input(INPUT_GET, 'contra', FILTER_SANITIZE_STRING);
$mayus = preg_match('@[A-Z]@', $contra);
$minus = preg_match('@[a-z]@', $contra);
$num = preg_match('@[0-9]@', $contra);
$especial = preg_match('@[^\w]@', $contra);

if (isset($_GET['Enviar'])) {
    if (!$especial) {
        echo "La contraseña debe tener un caracter especial!";
    }
    if (!$mayus || !$minus) {
        echo "<br>La contraseña debe tener MAYUS y MINUS!";
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
    <h2>Correo</h2>
    <form action="index.php" method="get">
        <input name="validacionEmail" type="text" />
        <button type="submit" title="validacionEmail">enviar</button>
        <!--submit para enviar los datos-->
    </form>
    <h2>Contraseña</h2>
    <form method="get" action="index.php">
        <input type="text" name="contra" value="" />

        <input type="submit" name="Enviar" />
    </form>
    <h2>Web</h2>
    <form action="index.php" method="get">
        <input name="validacionWeb" type="text" />
        <button type="submit" title="validacionWeb">enviar</button>
        <!--submit para enviar los datos-->
    </form>
</body>

</html>
