<?php
session_start();
//print_r($meses);

////DECLARO LAS VARIABLES DONDE GUARDO LOS VALUES DE LOS INPUT SIEMPRE QUE ESTEN CORRECTOS
$g_nombre ="";
$g_apelli ="";
$g_telef ="";

/////COMPROBACION QUE NO ESCRIBA NUMEROS////
$nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
$apelli = filter_input(INPUT_GET, 'apellido', FILTER_SANITIZE_STRING);

$letrasNom = preg_match('@[^A-Za-záéíóúñüçÁÉÍÓÚÑÜÇ ]@', $nombre);
$letrasApe = preg_match('@[^A-Za-zzáéíóúñüçÁÉÍÓÚÑÜÇ ]@', $apelli);
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
            $nombre="";
            $g_nombre="";
        }else{
            $contador++;
            $g_nombre=$nombre;
        }
        if (strlen($apelli) < 4) {
            echo "APELLIDOS:Tiene que contener al menos 4 caracteres<br/>";
            $apelli ="";
            $g_apelli ="";
        }else{
            $contador++;
            $g_apelli=$apelli;
        }
        if (strlen($telef) != 9) {
            echo "TELEFONO:No puede incluir mas de 9 numeros, y tampoco menos<br/>";
            $telef ="";
            $g_telef ="";
        }else{
            $contador++;
            $g_telef=$telef;
        }
        /////COMPROBACION QUE NO ESCRIBA NUMEROS////
        if ($letrasNom) {
            echo "NOMBRE:Has introducido algun caracter que no es una letra<br/>";
            $nombre="";
            $g_nombre="";

        }else{
            $contador++;
            $g_nombre=$nombre;
        }
        if ($letrasApe) {
            echo "APELLIDO:Has introducido algun caracter que no es una letra<br/>";
            $apelli="";
            $g_apelli="";
        }else{
            $contador++;
            $g_apelli=$apelli;
        }
        /////COMPROBACION QUE NO ESCRIBA LETRAS////
        if ($numerosTlf) {
            echo "TELEFONO:Has introducido algun caracter que no es un numero<br/>";
            $telef="";
            $g_telef="";
        }else{
            $contador++;
            $g_telef=$telef;
        }
        if ($contador==6) {
            echo 'Validacion Completada. Pulse otra vez en "Enviar"';
            $archivo="datos.txt";
            $file=fopen($archivo,"a");
            fwrite($file,"FORMULARIO:"."\n \n"."-NOMBRE: ".$nombre ."\n"."-APELLIDO: ". $apelli."\n"."-TLF: ".$telef);
            fclose($file);
        }else{
            $contador = 0;
        }
        
} ?>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;margin-bottom:40px">
        <span class="active"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
    <form method="get" action="<?php if ($contador<6) {  ?>
        indexCambiado.php <?php }
        else{ ?>
            parte2.php <?php
        }?>">
        <!-- PRIMERA PARTE -->
        <label>Nombre
        <input name="nombre" type="text" placeholder="Escribe tu nombre..." value="<?php echo $g_nombre ?>"/></label>
        <label>Apellidos 
        <input name="apellido" type="text" placeholder="Primero y segundo..." value="<?php echo $apelli ?>"/></label>
        <label>Teléfono 
        <input name="telef" type="tel" placeholder="Teléfono móvil..." value="<?php echo $telef ?>"/></label>
        <input class="boton" type="submit" name="Siguiente" />
    </form>
    </div>
</body>

</html>