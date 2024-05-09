<?php
$env_vars = parse_ini_file('.env');
define('DB_HOST', $env_vars['DB_HOST']);
define('DB_USERNAME', $env_vars['DB_USERNAME']);
define('DB_PASSWORD', $env_vars['DB_PASSWORD']);
define('DB_NAME', $env_vars['DB_NAME']);
$conexion= mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$conexion){
die("Fallo:" . mysqli_connect_error());
}
$sql="SELECT nombre, fotos, descripcion FROM productos WHERE ID=6";
$resultado = mysqli_query($conexion, $sql);
$resultados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
function mapear($fila) {return $fila;}
$mapeado = array_map('mapear', $resultados);
$foto_link='';
$nombre_producto='';
$desc='';
foreach($mapeado as $fila){
$foto_link=$fila["fotos"];
$nombre_producto=$fila["nombre"];
$desc=$fila["descripcion"];
};

mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi page</title>
    <link href="/dist/output.css" rel="stylesheet">

</head>
<body>
<header>
    <?php 
    include 'header.php'
    ?>
</header>
<div class="w-full h-[70vh] flex justify-center items-center">
<div class="flex flex-col w-[15%] p-[1rem] border-[1px] border-solid border-[#bdbdbd] rounded-[5px]">
<img class="object-cover" src="<?php echo $foto_link ?>" alt="">
<p><?php echo $nombre_producto ?></p>
<p>Precio: $ 1,000.00 USD</p>
<p class="underline">Descipcion:</p>
<p><p><?php echo $desc ?></p></p>
</div>
</div>
<footer>
<?php 
    include 'footer.php'
    ?>
</footer>
</body>
</html>