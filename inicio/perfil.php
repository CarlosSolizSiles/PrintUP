<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icono.png" type="image/x-icon">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="perfil.css">
</head>

<body>

    </head>

    <body>
        <header class="header">
            <h1>PrintUP</h1>
        </header>
        <div class="navbar">
            <a href="inicio.php"><i class="fas fa-home"></i> Inicio</a>
            <a href="historial.php"><i class="fas fa-history"></i> Historial</a>
            <a href="configuracion.php"><i class="fas fa-cog"></i> Configuración</a>
            <a href="perfil.php" id="profile-link"><i class="fas fa-user"></i> Perfil</a>
        </div>
        <div class="content">
            <h2>Perfil de Usuario</h2>
            <div class="profile-section">
                <label for="profile-pic">Cambiar Foto de Perfil:</label>
                <form action="#" method="post" enctype="multipart/form-data">
                    <input type="text" name="Nombre" placeholder="Nombre...." value="">
                    <input type="file" name="imagen" id="profile-pic" accept="image/*" onchange="changeProfilePic(event)">
                    <input type="submit" value="Aceptar">
                </form>
                <img id="profile-pic-preview" src="default-profile.png" alt="Foto de Perfil">
                <label for="theme-select">Cambiar Tema de Fondo:</label>
                <button class="change-color-btn" onclick="changeColor()">Change Color</button>
            </div>
        </div>
        <main></label>
        </main>

        <script>
            function changeColor() {
                document.body.classList.toggle('dark-mode');
            }
        </script>


        <script src="script.js"></script>
    </body>

</html>