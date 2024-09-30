<?php


include '../includes/config.php';

$error_login = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nombre_usuario']) && !empty($_POST['contrasena'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
   echo $nombre_usuario . $contrasena;
    try {
        
        $sql = "SELECT id, nombre_usuario,contrasena FROM usuarios WHERE nombre_usuario = :nombre_usuario";
        
        $stmt = $conn->prepare($sql);   
        $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);  
        $stmt->execute();
        
        if ($stmt -> rowCount() == 1) {  
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);      
               
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_admin'] = $usuario['nombre_usuario'];
                
                header("Location: /crud/admin/index.php");
                exit();
            } else {
                
                $error_login = "Nombre de usuario o contrasena incorrectos";
            }
        } else {
           
            $error_login = "Nombre de usuario o contrasena incorrectos";
        }
    } catch (PDOException $e) {
        echo "Error " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 
<body class="bg-light">
    <div class="container">
        <!-- Centrado Vertical y Horizontal -->
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <!-- Tarjeta de Inicio de Sesión -->
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulario -->
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="nombre_usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contrasena</label>
                                <input type="password" class="form-control" id="password" name="contrasena" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>

                <?php if (!empty($error_login)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $error_login; ?>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
 
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
 
</html>
