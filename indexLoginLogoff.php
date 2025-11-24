<?php
    $idiomaSeleccionado="ES";
    if (isset($_REQUEST['es'])) {
        $idiomaSeleccionado="ES";
        setcookie('idioma', $idiomaSeleccionado);
        header("Location: ./indexLoginLogoff.php");
        exit;
    }elseif (isset($_REQUEST['pr'])) {
        $idiomaSeleccionado="PR";
        setcookie('idioma', $idiomaSeleccionado);
        header("Location: ./indexLoginLogoff.php");
        exit;
    }elseif (isset($_REQUEST['fr'])){
        $idiomaSeleccionado="FR";
        setcookie('idioma', $idiomaSeleccionado);
        header("Location: ./indexLoginLogoff.php");
        exit;
    }

    if(!isset($_COOKIE["idioma"])) {
        setcookie('idioma', $idiomaSeleccionado);
    }
    if (isset($_REQUEST['login'])) {
        header("Location: ./codigoPHP/Login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Logoff</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./webroot/css/estilosLoginLogoff.css">
        <style>
            @font-face {
                font-family: "mFeather";
                src: url("./webroot/fonts/Nunito/static/Nunito-Black.ttf") format("truetype");
                font-weight: 700;
                font-style: normal;
            }

            @font-face {
                font-family: "mNunito";
                src: url("./webroot/fonts/Nunito/Nunito-VariableFont_wght.ttf") format("truetype");
                font-weight: bold;
                font-style: normal;
            }

            :root {
                --brand-green: #58cc02;
                --accent: #4a9bff;
                --footera: #A5ED6E;
                --footertext: #D7FFB8;
                --bg: #f7fbff;
                --text: #1a1a1a;
                --muted: #6b7280;
                --max-width: 100vw;

                --headline: 'mFeather';
                --body: 'mNunito';
            }

            .logo .owl {
                width: 45px;
                height: 45px;
                background-image: url("./webroot/images/paloma.svg");
                background-size:45px;
                background-repeat: no-repeat;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <div class="logo">
                    <span class="owl" aria-hidden="true"></span>
                    <span>Login Logoff Tema 5<span style="color:var(--muted);font-weight:600;margin-left:6px;font-size:.9rem">—
                        Inicio Público</span></span>
                </div>
                <nav>
                    <form>
                        <input type="submit" name="login" value='Empezar' id="login" class="cta">
                        <input type="submit" name="es" value='Español' id="es" class="cta">
                        <input type="submit" name="pr" value='Portugues' id="pr" class="cta">
                        <input type="submit" name="fr" value='Francés' id="fr" class="cta">
                    </form>
                </nav>
            </header>

            <main>
                <section class="hero">
                    <div>
                        <?php
                            if($_COOKIE["idioma"]=="FR"){
                                echo "<h1>Bienvenue dans l'espace public</h1>";
                            }elseif ($_COOKIE["idioma"]=="PR") {
                                echo "<h1>Bem-vindo à área pública.</h1>";
                            }else{
                                echo "<h1>Bienvenido a la zona pública</h1>";
                            }
                        ?>
                        <!-- <div class="buttons">
                            <form>
                                <input type="submit" name="login" value='Empezar' id="login" class="btn primary">
                                <input type="submit" name="login" value='Empezar' id="login" class="btn secondary">
                            </form>
                        </div> -->
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
