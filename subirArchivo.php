<?php
Echo "Iniciando proceso de transferencia de archivo</br>";
Echo "INSERT INTO usuarios (id_usuario, nombre_usuario, foto) VALUES (NULL, 'Kenya', 'kenya_pack.jpg')";

//conexion a bd
$servername="localhost";
$username = "root";
$password = "";
$database = "bd-s133";

$conexion=mysqli_connect($servername,$username,$password,$database);

//iniciar con la transferencia de archivo
//1.validar si se presioni un submit con un metodo post en el formulario

if(isset($_POST["submit"])){
    echo "</br> Se presiono con un boton submit con metodo POST </br>";
//$_FILES REQUIERE el nombre en el campo del formulario y requiere de un nombre temporal mientras el archivo esta en 
    //transito
    $archivoOrigen= $_FILES["fileToUpload"]["tmp_name"];
    $archivoDestino="images/".$_FILES["fileToUpload"]["name"];
    echo "El archivo a enviar es : ".$archivoDestino."<br>";
    
    //parte 2
    $imageFileType= pathinfo($archivoDestino, PATHINFO_EXTENSION);
    
     $check = getimagesize($archivoOrigen);
    
    echo "extension del archivo: ".$imageFileType."</br>";
    
    if($check!==false){
        echo "El archivo es una imagen <br>";
        
        move_uploaded_file($archivoOrigen,$archivoDestino);
        $query="INSERT INTO usuarios (foto) values ('$archivoDestino')";
        echo "query a ejecutar: ".$query."<br>";
        
        if($query_a_ejecutar=mysqli_query($conexion,$query)){
            echo "query ejecutando correctamente</br>";
            header("refresh:5; url=practica7.php");
        }else {
            echo "query no ejecutado </br>";
        }
    }else{
            echo "el archivo no es una imagen </br>";
        }
}
?>