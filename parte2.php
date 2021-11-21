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
    <form method="get" action="index.php">
    <!-- SEGUNDA PARTE -->
    <h2>Direccion</h2>
    <input name="direccion" type="text" />
    <h2>Ciudad</h2>
    <input name="ciudad" type="text" />
    <h2>Provincia</h2>
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
    }?>
    <h2>Codigo Postal</h2>
    <input name="postal" type="text" />
    <input type="submit" name="Siguiente" />
    </form>
</body>
</html>