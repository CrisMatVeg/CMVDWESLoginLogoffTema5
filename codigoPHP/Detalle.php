<?php
    /*  
        @author Cristian Mateos Vega
        @since 05/12/2025
    */

    // Inicia la sesión o continúa la sesión actual
    session_start();

    // Comprueba si existe la variable de sesión específica del usuario
    // Si no está definida, redirige al usuario a la página de Login
    if(!isset($_SESSION['usuarioCMVDWESLoginLogoffTema5'])){
        header("Location: ./Login.php");
        exit;
    }

    // Comprueba si se ha pulsado el botón "Cancelar" del formulario
    // Si se ha pulsado, redirige al usuario a la página de inicio privado
    if (isset($_REQUEST['cancelar'])) {
        header("Location: ./InicioPrivado.php");
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
        <link rel="stylesheet" href="../webroot/css/estilosLoginLogoff.css">
        <style>
            @font-face {
                font-family: "mFeather";
                src: url("../webroot/fonts/Nunito/static/Nunito-Black.ttf") format("truetype");
                font-weight: 700;
                font-style: normal;
            }

            @font-face {
                font-family: "mNunito";
                src: url("../webroot/fonts/Nunito/Nunito-VariableFont_wght.ttf") format("truetype");
                font-weight: bold;
                font-style: normal;
            }

            :root {
                --brand-green: #58cc02;
                --accent: #4a9bff;
                --footera: #A5ED6E;
                --footertext: #D7FFB8;
                --bg: #F7FBFF;
                --campocolor: #f7f7f7;
                --campoborde: #e5e5e5;
                --text: #1a1a1a;
                --btnsazul: #1fc2ff;
                --muted: #6b7280;
                --max-width: 100vw;

                --headline: 'mFeather';
                --body: 'mNunito';
            }

            .logo .owl {
                width: 60px;
                height: 60px;
                background-image: url("../webroot/images/paloma.svg");
                background-size:cover;
                background-repeat: no-repeat;
                display: inline-block;
            }

            .hero {
                display: flex;
                justify-content:center;
                align-items: center;
                padding: 2rem 0;
                text-align: center;
            }

            .hero .buttons {
                display: flex;
                gap: .75rem
            }

            input{
                background-color: var(--campocolor);
                border: 2px solid var(--campoborde);
                padding:15px;
                border-radius:12px;
            }

            .btn {
                padding: .65rem 1rem;
                border-radius: 12px;
                font-weight: 700;
                text-decoration: none;
                font-family: var(--body);
                display: inline-block;
                border:none;
                cursor: pointer;
            }

            .btn.primary {
                background: var(--btnsazul);
                color: white;
            }

            .btn.secondary {
                background: transparent;
                border: 2px solid rgba(0, 0, 0, 0.06);
                color: var(--btnsazul);
            }

            .hero {
                display: flex;
                justify-content:center;
                align-items: center;
                padding: 2rem 0;
                text-align: start;
            }     
            .hero div h1{
                text-align: center;
            }           
        </style>
    </head>

    <body>
        <header>
            <div class="logo">
                <span class="owl" aria-hidden="true"></span>
                <span>Login Logoff Tema 5<span style="color:var(--muted);font-weight:600;margin-left:6px;font-size:.9rem">—
                    Detalle</span></span>
            </div>
            <form>
                <input type="submit" name="cancelar" value='Cancelar' id="cancelar" class="btn primary">
            </form>
        </header>

        <main>
        <section class="hero">
        <div>
            <h1>Superglobales y phpinfo()</h1>
            <?php
                // Mostrar información de $_SESSION
                echo '<h1>$_SESSION</h1>';
                echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
                foreach ($_SESSION as $clave => $valor) {
                    echo "<tr><th>$clave</th><td>";
                    echo "<pre>"; 
                    print_r($valor); // Imprime de forma legible el contenido de la variable
                    echo "</pre>";
                    echo "</td></tr>";
                }
                echo '</table>';

                // Mostrar información de $_COOKIE
                echo '<h3>$_COOKIE</h3>';
                echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
                foreach ($_COOKIE as $clave => $valor) {
                    echo "<tr><th>$clave</th><td>" . $valor . "</td></tr>";
                }
                echo '</table>';

                // Mostrar información de $_SERVER
                echo '<h3>$_SERVER</h3>';
                echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
                foreach ($_SERVER as $clave => $valor) {
                    echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
                }
                echo '</table>';

                // Mostrar información de $_ENV
                echo '<h3>$_ENV</h3>';
                echo '<table><tr><th>Variable $_ENV</th><th>Valor</th></tr>';
                foreach ($_ENV as $clave => $valor) {
                    echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
                }
                echo '</table>';

                // Mostrar información de $_REQUEST
                echo '<h3>$_REQUEST</h3>';
                echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
                foreach ($_REQUEST as $clave => $valor) {
                    echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
                }
                echo '</table>';

                // Mostrar información de $_GET
                echo '<h3>$_GET</h3>';
                echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
                foreach ($_GET as $clave => $valor) {
                    echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
                }
                echo '</table>';

                // Mostrar información de $_POST
                echo '<h3>$_POST</h3>';
                echo '<table><tr><th>Variable $_POST</th><th>Valor</th></tr>';
                foreach ($_POST as $clave => $valor) {
                    echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
                }
                echo '</table>';

                // Mostrar información de $_FILES (archivos subidos)
                echo '<h3>$_FILES</h3>';
                echo '<table><tr><th>Variable $_FILES</th><th>Valor</th></tr>';
                foreach ($_FILES as $clave => $valor) {
                    echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
                }
                echo '</table>';

                // Mostrar información completa de PHP, configuración del servidor, módulos, etc.
                echo phpinfo();
            ?>
        </div>
        </section>
        </main>

        <footer>
            <div class="footer-grid">
                <div>© 2025-26 IES Los Sauces. Todos los derechos reservados. <a href="../../CMVDWESProyectoDWES/indexProyectoDWES.php" title="Inicio">Cristian Mateos Vega</a></div>
                <div><a href="https://es.duolingo.com/" target="_blank" title="Duolingo">Pagina Imitada</a> · <a href="https://github.com/CrisMatVeg/CMVDWESLoginLogoffTema5" target="_blank" title="Github"><i
                            class="fa-brands fa-github fa-2xl"></i></a>
                </div>
            </div>
        </footer>
    </body>

</html>
