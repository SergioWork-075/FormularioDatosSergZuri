<?php
if (false !== filter_var($_GET["validacionEmail"], FILTER_VALIDATE_EMAIL)) {
    echo 'Bien introducido';
} else {
    echo 'Mail mal introducido';
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
    </form>
</body>

</html>