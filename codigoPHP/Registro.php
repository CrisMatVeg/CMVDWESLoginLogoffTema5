<?php
    if (isset($_REQUEST['cancelar'])) {
        header("Location: ./Login.php");
        exit;
    }
    if (isset($_REQUEST['registrarse'])) {
        header("Location: ./Login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../webroot/css/estilos.css">
        <link rel="stylesheet" href="../webroot/css/fonts.css">
        <style>
            footer {
                position: relative;
            }

            a i{
                color: #020202;
            }

            footer i{
                color: white;
            }

            main {
                flex: 1;
                margin-top: 100px;
                margin-bottom: 20px;
                display: block;
                height: 100vh;
                justify-items: center;
                align-content: center;
                align-items: start;
                justify-content: center;
                overflow: hidden;
                box-sizing: border-box;
            }

            table{
                margin-top: 5px;
                position: relative;
                overflow: hidden;
                border-radius: 7px;
                transition: transform 0.3s ease;
                transform-origin: center;
                background-size: cover;
                background-position: center;
                display: flex;
                justify-content: center;
                align-items: center;
                color: black;
                font-weight: bold;
                font-size: 1.2rem;
                z-index: 0;
                padding: 15px;
                width: 100vw;
                height: 100%;
                background: white;
            }

            td{
                border: 1px solid black;
                height: 50px;
                padding: 10px;
            }

            #tablaEjercicios tr td:nth-child(2){
                font-family: sans-serif;
            }

            #tablaEjercicios tr td:nth-child(3){
                cursor:pointer;
            }

            #tablaEjercicios tr td:nth-child(4){
                cursor:pointer;
            }
        </style>
    </head>

    <body>
        <header>
            <h1>Login Logoff Tema 5</h1>
            <h2>Registrarse</h2>
        </header>

        <main>
            <form>
                <input type="submit" name="registrarse" value='Registrarse' id="entrar">
                <input type="submit" name="cancelar" value='Cancelar' id="cancelar">
            </form>
        </main>

        <footer>
            <p>© 2025-26 IES Los Sauces. Todos los derechos reservados. <a href="../CMVDWESProyectoDWES/indexProyectoDWES.php" title="Inicio">Cristian Mateos Vega</a></p>
            <div id="iconos">
                <a href="https://github.com/CrisMatVeg/CMVDWESLoginLogoffTema5" target="_blank" title="Github"><i
                        class="fa-brands fa-github fa-2xl"></i></a>
            </div>
        </footer>
    </body>

</html>
