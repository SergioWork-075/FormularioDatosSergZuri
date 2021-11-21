<?php

//print_r($meses);

/////COMPROBACION QUE NO ESCRIBA NUMEROS////
$nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
$apelli = filter_input(INPUT_GET, 'apellido', FILTER_SANITIZE_STRING);
$nombre = str_replace(' ', '', $nombre);
$letrasNom = preg_match('@[^A-Za-záéíóúñüç]@', $nombre);
$apelli = str_replace(' ', '', $apelli);
$letrasApe = preg_match('@[^A-Za-zzáéíóúñüç]@', $apelli);
$enviarSiNo = false;
$contador = 0;

/////COMPROBACION QUE NO ESCRIBA LETRAS////
$telef = filter_input(INPUT_GET, 'telef', FILTER_SANITIZE_STRING);
$numerosTlf = preg_match('@[^0-9]@', $telef);

/////COMPROBACION QUE CONCUERDA EL CP////
//$comprobacionCP = substr($codigoProvincia,0,2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK REL=StyleSheet HREF="estilo/style.css" TYPE="text/css" MEDIA=screen>
    <title>Formulario de Acceso</title>
</head>

<body>
    <div class="formulario">
    <h1>Formulario de Acceso</h1>
    <?php
    if (isset($_GET['Siguiente'])) {
        $contador = 0;
        /////COMPROBACION LONGITUD////
        if (strlen($nombre) < 2) {
            echo "NOMBRE:Tiene que contener al menos 2 caracteres<br/>";
        }else{
            $contador++;
        }
        if (strlen($apelli) < 4) {
            echo "APELLIDOS:Tiene que contener al menos 4 caracteres<br/>";
        }else{
            $contador++;
        }
        if (strlen($telef) != 9) {
            echo "TELEFONO:No puede incluir mas de 9 numeros, y tampoco menos<br/>";
        }else{
            $contador++;
        }
        /////COMPROBACION QUE NO ESCRIBA NUMEROS////
        if ($letrasNom) {
            echo "NOMBRE:Has introducido algun caracter que no es una letra<br/>";
        }else{
            $contador++;
        }
        if ( $letrasApe) {
            echo "APELLIDO:Has introducido algun caracter que no es una letra<br/>";
        }else{
            $contador++;
        }
        /////COMPROBACION QUE NO ESCRIBA LETRAS////
        if ($numerosTlf) {
            echo "TELEFONO:Has introducido algun caracter que no es un numero<br/>";
        }else{
            $contador++;
        }
        
} ?>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;margin-bottom:40px">
        <span class="active"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
    <form method="get" action="<?php if ($contador<5) {?>
        index.php <?php } 
        else{ ?>
            parte2.php <?php
        }?>">
        <!-- PRIMERA PARTE -->
        <label>Nombre 
        <input name="nombre" type="text" placeholder="Escribe tu nombre..."/></label>
        <label>Apellidos 
        <input name="apellido" type="text" placeholder="Primero y segundo..."/></label>
        <label>Teléfono 
        <input name="telef" type="tel" placeholder="Teléfono móvil..."/></label>
        <input class="boton" type="submit" name="Siguiente" />
    </form>
    </div>
</body>

</html>