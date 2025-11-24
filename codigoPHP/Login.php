<?php
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

            $usuario = $consulta->fetch(PDO::FETCH_OBJ);

            if (!$usuario) {
                $entradaOK = false;
            } else {
                // Actualizamos contador y fecha
                $actualizar = $miDB->prepare("
                    UPDATE T01_Usuarios SET 
                        T01_NumConexiones = T01_NumConexiones + 1,
                        T01_FechaHoraUltimaConexion = NOW()
                    WHERE T01_CodUsuario = :usuario
                ");
                $actualizar->execute([':usuario' => $_REQUEST['usuario']]);

                // Guardamos sesión
                $_SESSION['PHP_AUTH_USER'] = $_REQUEST['usuario'];
                $_SESSION['PHP_AUTH_PW']= $_SESSION['PHP_AUTH_USER'].$_REQUEST['password'];

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
        <link rel="stylesheet" href="../webroot/css/fonts.css">
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
                width: 45px;
                height: 45px;
                background-image: url("../webroot/images/paloma.svg");
                background-size:45px;
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
            </header>

            <main>
                <section class="hero">
                    <div>
                        <?php
                            if($_COOKIE["idioma"]=="ES"){
                                echo "<h1>INICIAR SESIÓN</h1>";
                            }elseif ($_COOKIE["idioma"]=="PR") {
                                echo "<h1>CONECTE-SE</h1>";
                            }else{
                                echo "<h1>SE CONNECTER</h1>";
                            }
                        ?>
                        <div>
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                <input type="text" name="usuario" placeholder="Usuario" id="usuario" class="required" value="<?php echo (empty($aErrores['usuario'])) ? $aRespuestas['usuario'] : ''; ?>">
                                <span style="color:red;"><?php echo $aErrores['usuario']; ?></span><br><br>

                                <input type="password" name="password" placeholder="Contraseña" id="password" value="<?php echo (empty($aErrores['password'])) ? $aRespuestas['password'] : ''; ?>">
                                <span style="color:red;"><?php echo $aErrores['password']; ?></span><br><br>

                                <input type="submit" name="entrar" value='Entrar' id="entrar" class="btn primary">
                                <input type="submit" name="cancelar" value='Cancelar' id="cancelar" class="btn primary">
                                <input type="submit" name="registrarse" value='Registrarse' id="registrarse" class="btn secondary">
                            </form>
                        </div>
                    </div>
                </section>
            </main>

            <footer>
                <p>© 2025-26 IES Los Sauces. Todos los derechos reservados. <a href="../CMVDWESProyectoDWES/indexProyectoDWES.php" title="Inicio">Cristian Mateos Vega</a></p>
                <div id="iconos">
                    <a href="https://github.com/CrisMatVeg/CMVDWESLoginLogoffTema5" target="_blank" title="Github"><i
                            class="fa-brands fa-github fa-2xl"></i></a>
                </div>
            </footer>
        </div>
    </body>

</html>
