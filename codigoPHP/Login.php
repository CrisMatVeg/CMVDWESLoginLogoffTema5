<?php
session_start();
require_once '../config/confDBPDO.php';
require_once '../core/231018libreriaValidacion.php';

if (isset($_REQUEST['cancelar'])) {
    header("Location: ../indexLoginLogoff.php");
    exit;
}
if (isset($_REQUEST['registrarse'])) {
    header("Location: ./Registro.php");
    exit;
}

$entradaOK = true;
$aErrores = [
    'usuario' => '',
    'password' => ''
];
$aRespuestas = [
    'usuario' => '',
    'password' => ''
];

// Si el usuario envía el formulario
if (isset($_REQUEST['entrar'])) {

    // Validaciones del formulario
    $aErrores['usuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 20, 1, 1);
    $aErrores['password'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['password'], 255, 1, 1);

    foreach ($aErrores as $campo => $error) {
        if (!empty($error)) {
            $entradaOK = false;
        }
    }

    // Si el formulario es válido → consultar BD
    if ($entradaOK) {
        try {
            $miDB = new PDO(DSN, USERNAME, PASSWORD);

            $consulta = $miDB->prepare("
                SELECT * FROM T01_Usuarios 
                WHERE T01_CodUsuario = :usuario 
                AND T01_Password = SHA2(:password, 256)
            ");

            $consulta->execute([
                ':usuario'    => $_REQUEST['usuario'],
                ':password' => $_REQUEST['usuario'].$_REQUEST['password']
            ]);

            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                $entradaOK = false;
            } else {
                $FechaHoraUltimaConexionAnterior=new DateTime($usuario["T01_FechaHoraUltimaConexion"]);
                $_SESSION['usuarioCMVDWESLoginLogoffTema5'] = [
                    'FechaHoraUltimaConexionAnterior'  => $FechaHoraUltimaConexionAnterior
                ];
                // Actualizamos contador y fecha
                $actualizar = $miDB->prepare("
                    UPDATE T01_Usuarios SET 
                        T01_NumConexiones = T01_NumConexiones + 1,
                        T01_FechaHoraUltimaConexion = NOW()
                    WHERE T01_CodUsuario = :usuario
                ");
                $actualizar->execute([':usuario' => $_REQUEST['usuario']]);

                $consulta2 = $miDB->prepare("
                    SELECT * FROM T01_Usuarios 
                    WHERE T01_CodUsuario = :usuario 
                    AND T01_Password = SHA2(:password, 256)
                ");

                $consulta2->execute([
                    ':usuario'    => $_REQUEST['usuario'],
                    ':password' => $_REQUEST['usuario'].$_REQUEST['password']
                ]);

                $usuarioPostUpdate = $consulta2->fetch(PDO::FETCH_ASSOC);
                $FechaHoraUltimaConexion=new DateTime($usuario["T01_FechaHoraUltimaConexion"]);
                // Guardamos sesión
                $_SESSION['usuarioCMVDWESLoginLogoffTema5']['CodUsuario'] = $_REQUEST['usuario'];
                $_SESSION['usuarioCMVDWESLoginLogoffTema5']['Password']= $_SESSION['usuarioCMVDWESLoginLogoffTema5']['CodUsuario'].$_REQUEST['password'];
                $_SESSION['usuarioCMVDWESLoginLogoffTema5']['FechaHoraUltimaConexion'] = $FechaHoraUltimaConexion;
                $_SESSION['usuarioCMVDWESLoginLogoffTema5']['NumConexiones'] = $usuario["T01_NumConexiones"];
                $_SESSION['usuarioCMVDWESLoginLogoffTema5']['DescUsuario'] = $usuario["T01_DescUsuario"];
                $_SESSION['usuarioCMVDWESLoginLogoffTema5']['Perfil'] = $usuario["T01_Perfil"];
                $_SESSION['usuarioCMVDWESLoginLogoffTema5']['ImagenUsuario'] = $usuario["T01_ImagenUsuario"];
                // Redirigir a zona privada
                header("Location: ./InicioPrivado.php");
                exit;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
} else {
    $entradaOK = false;
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
                --bg: #ffffff;
                --campocolor: #f7f7f7;
                --text: #1a1a1a;
                --btnsazul: #1fc2ff;
                --muted: #6b7280;
                --max-width: 100vw;
                --btnshadow: #1AA8EB;
                --btngrisshadow: #cecece;
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
                background-color: lightyellow;
                border: 2px solid var(--btngrisshadow);
                padding:15px;
                border-radius:12px;
                font-family: var(--headline);
            }
            input:focus{
                border:2px solid var(--btnsazul);
                caret-color: var(--btnsazul);
                outline:none;
            }

            .btn {
                padding: .65rem 1rem;
                border-radius: 12px;
                font-weight: 700;
                text-decoration: none;
                font-family: var(--headline);
                font-weight:bold;
                display: inline-block;
                border:none;
                cursor: pointer;
            }

            .btn.primary {
                background: var(--btnsazul);
                color: white;
                box-shadow: 0px 5px 0px 0px var(--btnshadow);
                width:calc(50% - 5px);
            }

            .btn.secondary {
                background: transparent;
                border: 2px solid var(--btngrisshadow);
                color: var(--btnsazul);
                box-shadow: 0px 5px 0px 0px var(--btngrisshadow);
            }

            form{
                display:flex;
                flex-direction:column;
                flex-wrap:wrap;
                gap:20px;
            }
            form *{
                justify-content:center;
            }
            form div{
                display: flex;
                justify-content:space-between;
            }
            h2{
                margin:30px;
            }
        </style>
    </head>

    <body>
    <div class="container">
            <header>
                <div class="logo">
                    <span class="owl" aria-hidden="true"></span>
                    <span>Login Logoff Tema 5<span style="color:var(--muted);font-weight:600;margin-left:6px;font-size:.9rem">—
                        Login</span></span>
                </div>
                <form>
                    <input type="submit" name="registrarse" value='Registrarse' id="registrarse" class="btn secondary">
                </form>
            </header>

            <main>
                <section class="hero">
                    <div>
                        <?php
                            if(isset($_COOKIE["idioma"])){
                                if($_COOKIE["idioma"]=="FR"){
                                    echo "<h2>SE CONNECTER</h2>";
                                }elseif ($_COOKIE["idioma"]=="PR") {
                                    echo "<h2>CONECTE-SE</h2>";
                                }else{
                                    echo "<h2>INICIAR SESIÓN</h2>";
                                }
                            }else{
                                echo "<h2>INICIAR SESIÓN</h2>";
                            }
                        ?>
                        <div>
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                <input type="text" name="usuario" placeholder="Usuario" id="usuario" class="required" value="">

                                <input type="password" name="password" placeholder="Contraseña" id="password" value="">

                                <div>
                                    <input type="submit" name="entrar" value='Entrar' id="entrar" class="btn primary">
                                    <input type="submit" name="cancelar" value='Cancelar' id="cancelar" class="btn primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </main>

            <footer>
                <div class="footer-grid">
                    <div>© 2025-26 IES Los Sauces. Todos los derechos reservados. <a href="../CMVDWESProyectoDWES/indexProyectoDWES.php" title="Inicio">Cristian Mateos Vega</a></div>
                    <div><a href="https://es.duolingo.com/" target="_blank" title="Duolingo">Pagina Imitada</a> · <a href="https://github.com/CrisMatVeg/CMVDWESLoginLogoffTema5" target="_blank" title="Github"><i
                                class="fa-brands fa-github fa-2xl"></i></a>
                    </div>
                </div>
            </footer>
        </div>
    </body>

</html>
