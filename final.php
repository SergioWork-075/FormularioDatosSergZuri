<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizado</title>
    <LINK REL=StyleSheet HREF="estilo/style.css" TYPE="text/css" MEDIA=screen>
</head>
<body>
<div class="formulario">
    <h1>Formulario de acceso</h1>
    <div class="finalizado"><a>RESUMEN:</a><br><br>
        <?php
        $data = file_get_contents("./datos.txt");

       echo '<textarea readonly style="height: 200px; width: 350px;">' . htmlspecialchars($data) . '</textarea>'?>
    </div>
</div>

</body>
</html>
