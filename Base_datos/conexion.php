<?php
$host = 'localhost';
$dbname = 'inicio_sesion'; // Asegúrate de haber creado la base de datos con el código SQL que te di
$username = 'root'; // Usuario por defecto en XAMPP
$password = 'zS759!NL}@bstk]'; // Contraseña por defecto en XAMPP (vacía)

try {
    // Aquí es donde se crea la variable $pdo que estaba faltando
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    // Si falla la conexión, se detiene el script y muestra el error
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

