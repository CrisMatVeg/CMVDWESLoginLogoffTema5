<?php
    session_start();
    require_once '../config/confDBPDO.php';
    if (isset($_REQUEST['detalle'])) {
        header("Location: ./Detalle.php");
        exit;
    }
    if (isset($_REQUEST['cancelar'])) {
        session_unset();
        header("Location: ../indexLoginLogoff.php");
        exit;
    }
    if (isset($_REQUEST['volver'])) {
        header("Location: ../indexLoginLogoff.php");
        exit;
    }
    if(!isset($_SESSION['usuarioCMVDWESLoginLogoffTema5']['CodUsuario']) && !isset($_SESSION['usuarioCMVDWESLoginLogoffTema5']['Password'])){
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
                --btnshadow: #1AA8EB;

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
                box-shadow: 0px 5px 0px 0px var(--btnshadow);
                margin-top:20px;
            }

            .btn.secondary {
                background: transparent;
                border: 2px solid rgba(0, 0, 0, 0.06);
                color: var(--btnsazul);
            }
            h2{
                margin:10px;
            }
            header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem 0;
                padding-left:20px;
                padding-right:20px
            }
        </style>
    </head>

    <body>
        <header>
            <div class="logo">
                <span class="owl" aria-hidden="true"></span>
                <span>Login Logoff Tema 5<span style="color:var(--muted);font-weight:600;margin-left:6px;font-size:.9rem">—
                    Inicio Privado</span></span>
            </div>
            <nav>
                <form>
                    <input type="submit" name="cancelar" value='Cerrar Sesión' id="cancelar" class="btn primary">
                </form>
                <form>
                    <input type="submit" name="volver" value='Volver a Inicio Público' id="volver" class="btn primary">
                </form>
            </nav>
        </header>

        <main>
            <?php
                $miDB = new PDO(DSN, USERNAME, PASSWORD);
                $nombreUsuario=$_SESSION['usuarioCMVDWESLoginLogoffTema5']['CodUsuario'];
                $password=$_SESSION['usuarioCMVDWESLoginLogoffTema5']['Password'];
                $consulta = $miDB->prepare("
                SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :nombreUsuario AND T01_Password = SHA2(:password,256)
                ");
                $consulta->execute([':nombreUsuario' => $nombreUsuario, ':password' => $password]);
                $usuarioActual =  $consulta->fetch(PDO::FETCH_ASSOC);
                $fechaUltimaConexion=$_SESSION['usuarioCMVDWESLoginLogoffTema5']['FechaHoraUltimaConexion'];
                
                if($_COOKIE["idioma"]=="FR"){
                    echo "<h1>Bienvenue " . $usuarioActual['T01_DescUsuario']. "</h1>";
                    echo "<h2>C’est la " . $usuarioActual['T01_NumConexiones'] . " fois que vous vous connectez.</h2>";
                    echo "<h2>Vous vous êtes connecté pour la dernière fois le ".$fechaUltimaConexion->format('d')." del ".$fechaUltimaConexion->format('m'). " de " .$fechaUltimaConexion->format('Y'). " à " .$fechaUltimaConexion->format('H').":".$fechaUltimaConexion->format('i')."</h2>";
                }elseif ($_COOKIE["idioma"]=="PR") {
                    echo "<h1>Bem-vindo " . $usuarioActual['T01_DescUsuario'] . "</h1>";
                    echo "<h2>Esta é a vez " . $usuarioActual['T01_NumConexiones'] . " que você se conecta.</h2>";
                    echo "<h2>Você se conectou pela última vez no ".$fechaUltimaConexion->format('d')." del ".$fechaUltimaConexion->format('m'). " de " .$fechaUltimaConexion->format('Y'). " às" .$fechaUltimaConexion->format('H').":".$fechaUltimaConexion->format('i')."</h2>";
                }else{
                    echo "<h1>Bienvenido " . $usuarioActual['T01_DescUsuario'] . "</h1>";
                    echo "<h2>Esta el la " . $usuarioActual['T01_NumConexiones'] . "ª vez que se conecta.</h2>";
                    echo "<h2>Usted se conectó por última vez el ".$fechaUltimaConexion->format('d')." del ".$fechaUltimaConexion->format('m'). " de " .$fechaUltimaConexion->format('Y'). " a las " .$fechaUltimaConexion->format('H').":".$fechaUltimaConexion->format('i')."</h2>";
                }

            ?>
            <form>
                <input type="submit" name="detalle" value='Detalle' id="detalle" class="btn primary">
            </form>
        </main>

        <footer>
            <div class="footer-grid">
                <div>© 2025-26 IES Los Sauces. Todos los derechos reservados. <a href="../CMVDWESProyectoDWES/indexProyectoDWES.php" title="Inicio">Cristian Mateos Vega</a></div>
                <div><a href="https://es.duolingo.com/" target="_blank" title="Duolingo">Pagina Imitada</a> · <a href="https://github.com/CrisMatVeg/CMVDWESLoginLogoffTema5" target="_blank" title="Github"><i
                    class="fa-brands fa-github fa-2xl"></i></a>
                </div>
            </div>
        </footer>
    </body>

</html>
