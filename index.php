<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "eu-cdbr-west-01.cleardb.com/"; $usuario = "b8ec321a01cc9e"; $contrasenia = "8689f43e"; $nombreBaseDatos = "heroku_f47577e5bf3f176";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM usuarios WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//

//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM usuarios WHERE id=".$_GET["borrar"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $correo=$data->correo;
        if(($correo!="")&&($nombre!="")){
            
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO usuarios(nombre,correo) VALUES('$nombre','$correo') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $correo=$data->correo;
    
    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE usuarios SET nombre='$nombre',correo='$correo' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
  //Devuelve todos los registros en orden descendiente por el id
if (isset($_GET["ordenarDescId"]) && isset($_GET["limitFirstParam"]) && isset($_GET["limitSecondParam"] ) ) {
    $sqlEmpleaadosOrderId= mysqli_query($conexionBD,"SELECT DISTINCT * FROM usuarios LIMIT ".$_GET["limitFirstParam"].",".$_GET["limitSecondParam"]); //ORDER BY id DESC
    if(mysqli_num_rows($sqlEmpleaadosOrderId) > 0){
       $empleaadosOrderId = mysqli_fetch_all($sqlEmpleaadosOrderId,MYSQLI_ASSOC);
      
        $arrayReverse = array_reverse($empleaadosOrderId);
        echo json_encode($arrayReverse);
   }else{
      echo 'No ha funcionado!';
   }
}

//Devuelve todos los registros en orden ascendente por el id

if (isset($_GET["ordenarAscId"]) && isset($_GET["limitFirstParam"]) && isset($_GET["limitSecondParam"] )) {
    $sqlEmpleaadosOrderId= mysqli_query($conexionBD,"SELECT DISTINCT * FROM usuarios LIMIT ".$_GET["limitFirstParam"].",".$_GET["limitSecondParam"]); //ORDER BY id ASC
    if(mysqli_num_rows($sqlEmpleaadosOrderId) > 0){
        $empleaadosOrderId = mysqli_fetch_all($sqlEmpleaadosOrderId,MYSQLI_ASSOC);
        echo json_encode($empleaadosOrderId);
    }else{
        echo 'No ha funcionado!';
    }
}

//Devuelve todos los registros en orden descendiente por el nombre
if (isset($_GET["ordenarDescNombre"]) && isset($_GET["limitFirstParam"]) && isset($_GET["limitSecondParam"] ) ) {
    $sqlEmpleaadosOrderId= mysqli_query($conexionBD,"SELECT DISTINCT * FROM usuarios LIMIT ".$_GET["limitFirstParam"].",".$_GET["limitSecondParam"]); //ORDER BY id DESC
    if(mysqli_num_rows($sqlEmpleaadosOrderId) > 0){
       $empleaadosOrderId = mysqli_fetch_all($sqlEmpleaadosOrderId,MYSQLI_ASSOC);
      
        $arrayReverse = array_reverse($empleaadosOrderId);
        echo json_encode($arrayReverse);
   }else{
      echo 'No ha funcionado!';
   }
}

//Devuelve todos los registros en orden ascendente por el nombre

if (isset($_GET["ordenarAscNombre"]) && isset($_GET["limitFirstParam"]) && isset($_GET["limitSecondParam"] )) {
    $sqlEmpleaadosOrderId= mysqli_query($conexionBD,"SELECT DISTINCT * FROM usuarios LIMIT ".$_GET["limitFirstParam"].",".$_GET["limitSecondParam"]); //ORDER BY id ASC
    if(mysqli_num_rows($sqlEmpleaadosOrderId) > 0){
        $empleaadosOrderId = mysqli_fetch_all($sqlEmpleaadosOrderId,MYSQLI_ASSOC);
        echo json_encode($empleaadosOrderId);
    }else{
        echo 'No ha funcionado!';
    }
}

//Devuelve todos los registros en orden descendiente por el correo
if (isset($_GET["ordenarDescCorreo"]) && isset($_GET["limitFirstParam"]) && isset($_GET["limitSecondParam"] ) ) {
    $sqlEmpleaadosOrderId= mysqli_query($conexionBD,"SELECT DISTINCT * FROM usuarios LIMIT ".$_GET["limitFirstParam"].",".$_GET["limitSecondParam"]); //ORDER BY id DESC
    if(mysqli_num_rows($sqlEmpleaadosOrderId) > 0){
       $empleaadosOrderId = mysqli_fetch_all($sqlEmpleaadosOrderId,MYSQLI_ASSOC);
      
        $arrayReverse = array_reverse($empleaadosOrderId);
        echo json_encode($arrayReverse);
   }else{
      echo 'No ha funcionado!';
   }
}

//Devuelve todos los registros en orden ascendente por el correo

if (isset($_GET["ordenarAscCorreo"]) && isset($_GET["limitFirstParam"]) && isset($_GET["limitSecondParam"] )) {
    $sqlEmpleaadosOrderId= mysqli_query($conexionBD,"SELECT DISTINCT * FROM usuarios LIMIT ".$_GET["limitFirstParam"].",".$_GET["limitSecondParam"]); //ORDER BY id ASC
    if(mysqli_num_rows($sqlEmpleaadosOrderId) > 0){
        $empleaadosOrderId = mysqli_fetch_all($sqlEmpleaadosOrderId,MYSQLI_ASSOC);
        echo json_encode($empleaadosOrderId);
    }else{
        echo 'No ha funcionado!';
    }
}
//Devuelve una cantidad de registros dependiendo del Limit
if ((isset($_GET["limitFirstParam"]) && isset($_GET["limitSecondParam"] )) && !isset($_GET["ordenarAscId"]) && !isset($_GET["ordenarDescId"]) && !isset($_GET["ordenarAscNombre"]) && !isset($_GET["ordenarDescNombre"]) && !isset($_GET["ordenarAscCorreo"]) && !isset($_GET["ordenarDescCorreo"]) ) {
    $sqlEmpleaadosByLimit= mysqli_query($conexionBD,"SELECT * FROM usuarios LIMIT ".$_GET["limitFirstParam"].",".$_GET["limitSecondParam"]);
    if(mysqli_num_rows($sqlEmpleaadosByLimit) > 0){
        $empleaadosByLimit = mysqli_fetch_all($sqlEmpleaadosByLimit,MYSQLI_ASSOC);
       echo json_encode($empleaadosByLimit);
    }else{
        echo 'No ha funcionado!';
    }
}
//Devuelve cantidad de registros que tiene una tabla
if (isset($_GET["count"])) {
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM usuarios ");
    $numero_filas = mysqli_num_rows($sqlEmpleaados);
    echo $numero_filas;

      
}
// Consulta todos los registros de la tabla empleados
/*if (!isset($_GET["count"]) && !isset($_GET["ordenarAscId"]) && !isset($_GET["ordenarDescId"]) && !isset($_GET["ordenarAscNombre"]) && !isset($_GET["ordenarDescNombre"]) && !isset($_GET["ordenarAscCorreo"]) && !isset($_GET["ordenarDescCorreo"]) && !isset($_GET["limitFirstParam"]) && !isset($_GET["limitSecondParam"] )){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM empleados ");
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
    }
else{ echo json_encode([["success"=>0]]); }

}*/


?>