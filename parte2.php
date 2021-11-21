<?php 
    /////LEER EL TXT////
    $meses = [];
    $string = file_get_contents("archivo.txt");
    $array = explode("\n",$string);
    foreach ($array as $fila){
        $item = explode(" ",$fila);
        $meses[] = [
            'postal' => $item[0],
            'nombre' => $item[1]
        ];
}
/////COMPROBACION QUE NO ESCRIBA NUMEROS////
$provincia2 = "";
$ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_STRING);
$direccion = filter_input(INPUT_GET, 'direccion', FILTER_SANITIZE_STRING);
$letrasCiu = preg_match('@[^A-Za-zzáéíóúñüç]@', $ciudad);
$letrasDir = preg_match('@[^A-Za-zzáéíóúñüç]@', $direccion);
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
    <?php
    if (isset($_GET['Siguiente'])) {
    /////COMPROBACION LONGITUD////
    if(strlen($ciudad)<4){
        echo "CIUDAD:Tiene que contener al menos 4 caracteres<br/>";
    }else{
        $contador2++;
    }
    if(strlen($direccion)<4){
        echo "DIRECCION:Tiene que contener al menos 4 caracteres<br/>";
    }else{
        $contador2++;
    }
    if(strlen($postal)!==5){
        echo "POSTAL:Tiene que contener 5 numeros<br/>";
    }else{
        $contador2++;
    }
    /////COMPROBACION QUE NO ESCRIBA NUMEROS////
    if ($letrasDir) {
        echo "Direccion:Has introducido algun caracter que no es una letra<br/>";
    }else{
        $contador2++;
    }
    if ($letrasCiu) {
        echo "CIUDAD:Has introducido algun caracter que no es una letra<br/>";
    }else{
        $contador2++;
    }
    /////COMPROBACION QUE NO ESCRIBA LETRAS////
    if ($numerosPos) {
        echo "POSTAL:Has introducido algun caracter que no es un numero<br/>";
    }else{
        $contador2++;
    }

    //MENSAJE PARA FINALIZAR
    if ($contador2==6) {
        echo 'Validacion Completada. Pulse otra vez en "Enviar"';
        $archivo="datos.txt";
        $file=fopen($archivo,"a");
        fwrite($file,$ciudad.$direccion.$postal);
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
    <form method="get" action="parte2.php">
    
    <!-- SEGUNDA PARTE -->
    <label>Direccion
    <input name="direccion" type="text" placeholder="Escriba su calle..."/></label>
    <label>Ciudad
    <input name="ciudad" type="text" placeholder="Escriba su ciudad..."/></label><br>
    <label>Provincia</label>
    <?php
    $meses[] = [];
    $string = file_get_contents("./archivo2.txt");
    $array = explode("\n", $string);

    foreach ($array as $fila) {
        $item = explode(" ", $fila);

        ?>
        <form action="#" method="get">

            <select name="provincias"> <?php
                for ($i = 1; $i < 104; $i++) {
                    $meses += [$i => $item[$i]];
                    if ($i % 2) {
                        $_SESSION['provincia'] = $item[$i]; ?>

                        <option value="<?php echo $item[$i - 1] . " " . $item[$i]; ?>"><?php echo $_SESSION['provincia']; ?></option>

                        <?php
                    }
                }
                ?> </select>
            <input type="submit" name="submit" value="Ver"/>

        </form> <?php
    }
    ?><?php
    if (isset($_GET['submit'])) {
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
    <input name="provincias2" readonly type="text" value="<?php echo $provincia2; ?>"/><br>
    <h2>Código postal</h2>
    <input name="postal" type="text" value="<?php echo $postal; ?>"/>
    <br>
    <input class="boton" type="submit" name="Siguiente" />
    </form>
</div>
</body>
</html>