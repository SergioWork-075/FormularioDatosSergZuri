
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
//print_r($meses);

/////COMPROBACION QUE NO ESCRIBA NUMEROS////
$nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
$apelli = filter_input(INPUT_GET, 'apellido', FILTER_SANITIZE_STRING);
$ciudad = filter_input(INPUT_GET, 'ciudad', FILTER_SANITIZE_STRING);
$letrasNom = preg_match('@[^A-Za-záéíóúñüç]@', $nombre);
$letrasApe = preg_match('@[^A-Za-zzáéíóúñüç]@', $apelli);
$letrasCiu = preg_match('@[^A-Za-zzáéíóúñüç]@', $ciudad);

/////COMPROBACION QUE NO ESCRIBA LETRAS////
$telef = filter_input(INPUT_GET, 'telef', FILTER_SANITIZE_STRING);
$postal = filter_input(INPUT_GET, 'postal', FILTER_SANITIZE_STRING);

$numerosTlf = preg_match('@[^0-9]@', $telef);
$numerosPos = preg_match('@[^0-9]@', $postal);

/////COMPROBACION QUE CONCUERDA EL CP////
//$comprobacionCP = substr($codigoProvincia,0,2);

/////////////CONTRASEÑA//////////////////////
$contra = filter_input(INPUT_GET, 'contra', FILTER_SANITIZE_STRING);
$mayus = preg_match('@[A-Z]@', $contra);
$minus = preg_match('@[a-z]@', $contra);
$num = preg_match('@[0-9]@', $contra);
$especial = preg_match('@[^\w]@', $contra);

////////////WEB///////////////////////
$web = filter_input(INPUT_GET, 'validacionWeb', FILTER_SANITIZE_STRING);
$webprueba= preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web);

if (isset($_GET['Enviar'])) {
    /////COMPROBACION LONGITUD////
    if(strlen($nombre)<2){
        echo "NOMBRE:Tiene que contener al menos 2 caracteres<br/>";
    }
    if(strlen($apelli)<4){
        echo "APELLIDOS:Tiene que contener al menos 4 caracteres<br/>";
    }
    if(strlen($ciudad)<4){
        echo "CIUDAD:Tiene que contener al menos 4 caracteres<br/>";
    }
    if(strlen($telef)>9){
        echo "TELEFONO:No puede incluir mas de 9 numeros<br/>";
    }
    if(strlen($postal)>5){
        echo "TELEFONO:No puede incluir mas de 5 numeros<br/>";
    }
    /////COMPROBACION QUE NO ESCRIBA NUMEROS////
    if ($letrasNom) {
        echo "NOMBRE:Has introducido algun caracter que no es una letra<br/>";
    }
    if ($letrasApe) {
        echo "APELLIDO:Has introducido algun caracter que no es una letra<br/>";
    }
    if ($letrasCiu) {
        echo "CIUDAD:Has introducido algun caracter que no es una letra<br/>";
    }
    /////COMPROBACION QUE NO ESCRIBA LETRAS////
    if ($numerosTlf) {
        echo "TELEFONO:Has introducido algun caracter que no es un numero<br/>";
    }
    if ($numerosPos) {
        echo "POSTAL:Has introducido algun caracter que no es un numero<br/>";
    }
    /////////////ESMAIL//////////////////////
    if (false !== filter_var($_GET["validacionEmail"], FILTER_VALIDATE_EMAIL/*, FILTER_SANITIZE_EMAIL*/)) {
        $email = $_GET["validacionEmail"];

    } else {
        $email = $_GET["validacionEmail"];
        echo 'EMAIL:Mail mal introducido<br/>';

    }
    /////////////WEB//////////////////////
    if (!$webprueba) {
        echo 'WEB:Mal introducido<br/>';
    }
    /////////////CONTRASEÑA//////////////////////
    if (!$especial) {
        echo "PASS:La contraseña debe tener un caracter especial!";
    }
    if (!$mayus || !$minus) {
        echo "<br>PASS:La contraseña debe tener MAYUS y MINUS!";
    }
    if (!$num) {
        echo "<br>PASS:La contraseña debe tener almenos un número!";
    }
    if (strlen($contra) < 8 || strlen($contra) > 16) {
        echo "<br>PASS:La contraseña debe tener entre 8 y 16 caracteres!";
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
</form>
<form method="get" action="index.php">
    <h2>Nombre</h2>
    <input name="nombre" type="text" />
    <h2>Apellidos</h2>
    <input name="apellido" type="text" />
    <h2>Direccion</h2>
    <input name="direccion" type="text" />
    <h2>Ciudad</h2>
    <input name="ciudad" type="text" />
    <h2>Provincia</h2>
    <?php
    $meses[] = [];
    $string = file_get_contents("./archivo2.txt");
    $array = explode("\n",$string);

    $entry_order_type ="Selecte order type from the list and press the submit button";

    if(isset($_POST['provincias'])){
        $entry_order_type = $_GET['provincias'];
    }


    foreach ($array as $fila){
        $item = explode(" ",$fila);

        ?>
        <form action="#" method="get">

            <select name="provincias"> <?php
                for ( $i = 1; $i < 104; $i++ ) {
                    $meses += [ $i => $item[$i] ];
                    if ($i % 2) {
                        $_SESSION['provincia'] = $item[$i] . $_GET['provincias']; ?>
                        <option value="<?php echo $item[$i-1] . $item[$i];?>"><?php echo $_SESSION['provincia'];?></option>

                        <?php
                    }
                }
                ?> </select>
            <input type="submit" name="submit" value="Ver" />

        </form> <?php
    }
    ?><h2>Código postal</h2><?php
    if (isset($_GET['submit'])) {
        $codigo_prov = $_GET['provincias'];
    ?><input name="postal" type="text" value="<?php echo $codigo_prov;?>"/><?php
    }else{?><input name="postal" type="text" value=""/><?php }
    ?>


    <h2>Telefono</h2>
    <input name="telef" type="tel" />
    <h2>Correo</h2>
    <input name="validacionEmail" type="email" />
    <h2>Contraseña</h2>
    <input type="password" name="contra" value="" />
    <h2>Web</h2>
    <input name="validacionWeb" type="text" />

        <br>

    <input type="submit" name="Enviar" />

</form>
</body>

</html>
