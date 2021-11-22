<?php 
    /////LEER EL TXT////
    error_reporting(E_ERROR | E_PARSE);
    $cpProv = [];
    $string = file_get_contents("archivo.txt");
    $array = explode("\n",$string);
    foreach ($array as $fila){
        $item = explode(" ",$fila);
        $cpProv[] = [
            'postal' => $item[0],
            'nombre' => $item[1]
        ];
}
/////COMPROBACION QUE NO ESCRIBA NUMEROS////
$provincia2 = " ";
$provincia2 = filter_input(INPUT_GET, 'provincia2', FILTER_SANITIZE_STRING);
$ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_GET, 'direccion', FILTER_SANITIZE_STRING);
$letrasCiu = preg_match('@[^A-Za-záéíóúñüçÁÉÍÓÚÑÜÇ ]@', $ciudad);
$letrasPro = preg_match('@[^A-Za-záéíóúñüçÁÉÍÓÚÑÜÇ ]@', $provincia2);
$letrasDir = preg_match('@[^A-Za-záéíóúñüçÁÉÍÓÚÑÜÇ ]@', $direccion);
$contador2 = 0;

/////COMPROBACION QUE NO ESCRIBA LETRAS////
$postal = filter_input(INPUT_GET, 'postal', FILTER_SANITIZE_STRING);
$numerosPos = preg_match('@[^0-9]@', $postal);

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
    <h5><a>Nota: </a>Seleccione la provincia antes de escribir los datos</h5>
    <?php
    if (isset($_GET['Siguiente'])) {
    /////COMPROBACION LONGITUD////
    if(strlen($ciudad)<4){
        echo "<a>CIUDAD: </a>Tiene que contener al menos 4 caracteres<br/>";
        $ciudad="";
        $g_ciudad="";
    }else{
        $contador2++;
        $g_ciudad=$ciudad;
    }
    if(strlen($direccion)<4){
        echo "<a>DIRECCION: </a>Tiene que contener al menos 4 caracteres<br/>";
        $direccion="";
        $g_direccion="";
    }else{
        $contador2++;
        $g_direccion=$direccion;
    }
    if(strlen($postal)!==5){
        echo "<a>POSTAL: </a>Tiene que contener 5 numeros<br/>";
        $postal="";
        $g_postal="";
    }else{
        $contador2++;
        $g_postal=$postal;
    }
    /////COMPROBACION QUE NO ESCRIBA NUMEROS////
    if ($letrasDir) {
        echo "<a>Direccion: </a>Has introducido algun caracter que no es una letra<br/>";
        $direccion="";
        $g_direccion="";
    }else{
        $contador2++;
        $g_direccion=$direccion;
    }
    if ($letrasCiu) {
        echo "<a>CIUDAD: </a>Has introducido algun caracter que no es una letra<br/>";
        $ciudad="";
        $g_ciudad="";
    }else{
        $contador2++;
        $g_ciudad=$ciudad;
    }
    /////COMPROBACION QUE NO ESCRIBA LETRAS////
    if ($numerosPos) {
        echo "<a>POSTAL: </a>Has introducido algun caracter que no es un numero<br/>";
        $postal="";
        $g_postal="";
    }else{
        $contador2++;
        $g_postal=$postal;
    }

    //MENSAJE PARA FINALIZAR
    if ($contador2==6) {
        echo 'Validacion Completada. Pulse otra vez en <a>"Enviar"</a>';
        $archivo="datos.txt";
        $file=fopen($archivo,"a");
        fwrite($file,"CIUDAD: ".$ciudad."\n"."DIRECCIÓN: ".$direccion."\n"."DIRECCIÓN: ".$postal);
        fclose($file);
    }else{
        $contador2 = 0;
    }
}
?>
    <div style="text-align:center;margin-top:40px;margin-bottom:40px">
        <span class="step"></span>
        <span class="active"></span>
        <span class="step"></span>
    </div>
    <form method="get" action="<?php if ($contador2<6) {  ?>
        parte2.php <?php }
        else{ ?>
            parte3.php <?php
        }?>">
    
    <!-- SEGUNDA PARTE -->
    <label>Direccion
    <input name="direccion" type="text" placeholder="Escriba su calle..."/></label><br>
    <label>Ciudad
    <input name="ciudad" type="text" placeholder="Escriba su ciudad..."/></label><br>
    <label>Provincia</label><br/>
    <?php
    $cpProv[] = [];
    $string = file_get_contents("./archivo2.txt");
    $array = explode("\n", $string);

    foreach ($array as $fila) {
        $item = explode(" ", $fila);

        ?>
            <select name="provincias"> <?php
                for ($i = 1; $i < 104; $i++) {
                    $cpProv += [$i => $item[$i]];
                    if ($i % 2) {
                        $_SESSION['provincia'] = $item[$i]; ?>

                        <option value="<?php echo $item[$i - 1] . " " . $item[$i]; ?>"><?php echo $_SESSION['provincia']; ?></option>

                        <?php
                    }
                }
                ?> </select> <br/>
 <?php
    }
    ?><?php
    if (isset($_GET['Siguiente'])) {
        $codigo_prov = $_GET['provincias'];

        $info[] = [];
        $array2 = explode("\n", $codigo_prov);
        foreach ($array2 as $selec) {
            $valor = explode(" ", $selec);

            for ($i = 0; $i < 2; $i++) {
                $info += [$i => $valor[$i]];
                if ($i % 2) {
                    $provincia2 = $valor[$i];
                } else {
                    $postal = $valor[$i];
                }

            }
        }
    } ?><br>
    <input name="provincias2" readonly type="text" value="<?php echo $provincia2; ?>"/>
    <h2>Código postal</h2>
    <input name="postal" type="text" value="<?php echo $postal; ?>"/>
    <br>
    <input class="boton" type="submit" name="Siguiente" />
    </form>
</div>
</body>
</html>