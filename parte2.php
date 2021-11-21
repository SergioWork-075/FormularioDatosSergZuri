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
$ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_STRING);
$letrasCiu = preg_match('@[^A-Za-zzáéíóúñüç]@', $ciudad);

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
    }
    if(strlen($postal)>5){
        echo "POSTAL:No puede incluir mas de 5 numeros<br/>";
    }
    /////COMPROBACION QUE NO ESCRIBA NUMEROS////
    if ($letrasCiu) {
        echo "CIUDAD:Has introducido algun caracter que no es una letra<br/>";
    }
    /////COMPROBACION QUE NO ESCRIBA LETRAS////
    if ($numerosPos) {
        echo "POSTAL:Has introducido algun caracter que no es un numero<br/>";
    }
}
?>
    <div style="text-align:center;margin-top:40px;margin-bottom:40px">
        <span class="step"></span>
        <span class="active"></span>
        <span class="step"></span>
    </div>
    <form method="get" action="index.php">
    <!-- SEGUNDA PARTE -->
    <label>Direccion
    <input name="direccion" type="text" placeholder="Escriba su calle..."/></label>
    <label>Ciudad
    <input name="ciudad" type="text" placeholder="Escriba su ciudad..."/></label>
    <label>Provincia
    <?php
    $meses[] = [];
    $string = file_get_contents("./archivo2.txt");
    $array = explode("\n",$string);
    foreach ($array as $fila){
        $item = explode(" ",$fila);

        ?>
        <select name="provincias"> <?php
            for ( $i = 1; $i < 48; $i++ ) {
                $meses += [ $i => $item[$i] ];


                if ($i % 2) {
                    ?>
                    <option value="value<?php echo $i;?>"><?php echo $item[$i];?> </option>

                    <?php
                }

            }
            ?> </select> <?php
        $selectOption = $_POST['provincias'];
        echo $selectOption;
    }?>

    <?php
    $meses[] = [];
    $string = file_get_contents("./archivo2.txt");
    $array = explode("\n",$string);
    foreach ($array as $fila){
        $item = explode(" ",$fila);

        ?>
        <select name="provincias"> <?php
            for ( $i = 1; $i < 48; $i++ ) {
                $meses += [ $i => $item[$i] ];


                if ($i % 2) {
                    ?>
                    <option value="value1"><?php echo $item[$i+1];?> </option>

                    <?php
                }

            }
            ?> </select> <?php
    }?></label>
    <label>Codigo postal
    <input name="postal" type="text" placeholder="Escriba el CP..."/></label>
    <br>
    <input class="boton" type="submit" name="Siguiente" />
    </form>
</div>
</body>
</html>