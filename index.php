<?php
/////////////EMAIL//////////////////////
if (false !== filter_var($_GET["validacionEmail"], FILTER_VALIDATE_EMAIL)) {
    echo 'Bien introducido';
} else {
    echo 'Mail mal introducido';
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
    if(!$mayus || !$minus){
        echo "<br>La contraseña debe tener MAYUS y MINUS!";
    }
    if(!$num){
        echo "<br>La contraseña debe tener almenos un número!";
    }
    if( strlen($contra) < 8 || strlen($contra) > 16){
        echo "<br>La contraseña debe tener entre 8 y 16 caracteres!";
    }
    else {
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
    <form action="index.php" method="get">
        <input name="validacionEmail" type="text" />
        <button type="submit" title="validacionEmail">enviar</button>
        <!--submit para enviar los datos-->
        <h1>Contraseña</h1>
        <form method="get" action="index.php">
    <input type="text" name="contra"  value=""/>

    <input type="submit" name="Enviar" />
</form>
    </form>
</body>

</html>


