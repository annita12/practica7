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
    $archivoDestino="excel/".$_FILES["fileToUpload"]["name"];
    echo "El archivo a enviar es : ".$archivoDestino."<br>";
    
    //parte 2
    $xlsxFileType= pathinfo($archivoDestino, PATHINFO_EXTENSION);
    
     $check = gettext($archivoOrigen);
    
    echo "extension del archivo: ".$xlsxFileType."</br>";
    
    if($check!==false){
        echo "El archivo es un archivo excel <br>";
        
        move_uploaded_file($archivoOrigen,$archivoDestino);
        $query="INSERT INTO usuarios (excel/) values ('$archivoDestino')";
        echo "query a ejecutar: ".$query."<br>";
        
        if($query_a_ejecutar=mysqli_query($conexion,$query)){
            echo "query ejecutando correctamente</br>";
            header("refresh:5; url=formularioArchivo2.html");
        }else {
            echo "query no ejecutado </br>";
        }
    }else{
            echo "el archivo no es excel </br>";
        }
}
?>