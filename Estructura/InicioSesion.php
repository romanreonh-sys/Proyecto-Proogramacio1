<?php
session_start();
include("conexion.php");

if (isset($_POST['Usuario']) && isset($_POST['Clave'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Usuario = validate($_POST['Usuario']);
    $Clave = validate($_POST['Clave']);

    if (empty($Usuario)) {
        header("Location: index.php?error=El nombre de usuario es requerido");
        exit();
    } else if (empty($Clave)) {
        header("Location: index.php?error=La clave es requerida");
        exit();
    } else {
        $Clave = md5($Clave);

        $sql = "SELECT * FROM usuarios WHERE usuario=? AND clave=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$Usuario, $Clave]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) === 1) {
            $row = $result[0];
            if ($row['usuario'] === $Usuario && $row['clave'] === $Clave) {
                $_SESSION['Usuario'] = $row['usuario'];
                $_SESSION['Nombre Completo'] = $row['nombre_completo'];
                $_SESSION['Id'] = $row['id'];
                header("Location: inicio.php");
                exit();
            } else {
                header("Location: index.php?error=Usuario o clave incorrecta");
                exit();
            }
        } else {
            header("Location: index.php?error=Usuario o clave incorrecta");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}