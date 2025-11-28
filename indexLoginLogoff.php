<?php
    session_start();
    $idiomaSeleccionado="ES";
    if(!isset($_COOKIE["idioma"])) {
        setcookie('idioma', $idiomaSeleccionado, time()+86400*30);
    }
    if (isset($_REQUEST['es'])) {
        $idiomaSeleccionado="ES";
        setcookie('idioma', $idiomaSeleccionado, time()+86400*30);
        header("Location: ./indexLoginLogoff.php");
        exit;
    }elseif (isset($_REQUEST['pr'])) {
        $idiomaSeleccionado="PR";
        setcookie('idioma', $idiomaSeleccionado, time()+86400*30);
        header("Location: ./indexLoginLogoff.php");
        exit;
    }elseif (isset($_REQUEST['fr'])){
        $idiomaSeleccionado="FR";
        setcookie('idioma', $idiomaSeleccionado, time()+86400*30);
        header("Location: ./indexLoginLogoff.php");
        exit;
    }
    
    if (isset($_REQUEST['login'])) {
        if(isset($_SESSION['usuarioCMVDWESLoginLogoffTema5']['CodUsuario']) && isset($_SESSION['usuarioCMVDWESLoginLogoffTema5']['Password'])){
            header("Location: ./codigoPHP/InicioPrivado.php");
            exit;
        }else{
            header("Location: ./codigoPHP/Login.php");
            exit;
        }
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
                --btnshadow:#58A700;

                --headline: 'mFeather';
                --body: 'mNunito';
            }

            .logo .owl {
                width: 60px;
                height: 60px;
                background-image: url("./webroot/images/paloma.svg");
                background-size:cover;
                background-repeat: no-repeat;
                display: inline-block;
            }

            #es{
                display: none;
            }

            #pr{
                display: none;
            }

            #fr{
                display: none;
            }
            img{
                height: 30px;
            }
            form{
                display: flex;
                justify-content:center;
                align-content:center;
                gap:10px;
            }
            form *{
                cursor: pointer;
            }
            .labels{
                display: flex;
                justify-content:center;
                align-content:center;
                gap:10px;
                padding-top:10px;
            }
            .cta {
                width: 120px;
                box-shadow: 0px 5px 0px 0px var(--btnshadow);
            }
            .hero div img{
                width: 700px;
                height: 450px;
            }

            .selected-idioma img{
                border:4px solid var(--accent);
                border-radius:10px; 
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
                        <div class="labels">
                            <label for="es" class="<?php echo (isset($_COOKIE['idioma']) && $_COOKIE['idioma']=='ES') ? 'selected-idioma' : ''; ?>"><img src="./webroot/images/es.svg" alt="es" id="labeles"></label>
                            <label for="pr" class="<?php echo (isset($_COOKIE['idioma']) && $_COOKIE['idioma']=='PR') ? 'selected-idioma' : ''; ?>"><img src="./webroot/images/pr.svg" alt="pr" id="labelpr"></label>
                            <label for="fr" class="<?php echo (isset($_COOKIE['idioma']) && $_COOKIE['idioma']=='FR') ? 'selected-idioma' : ''; ?>"><img src="./webroot/images/fr.svg" alt="fr" id="labelfr"></label>
                        </div>
                        <input type="submit" name="es" value="" id="es">
                        <input type="submit" name="pr" value='Portugues' id="pr">
                        <input type="submit" name="fr" value='Francés' id="fr">
                    </form>
                </nav>
            </header>

            <main>
                <section class="hero">
                    <div>
                        <?php
                        if(isset($_COOKIE["idioma"])){
                            if($_COOKIE["idioma"]=="FR"){
                                
                            }elseif ($_COOKIE["idioma"]=="PR") {
                                echo "<h1>Bem-vindo à área pública.</h1>";
                            }else{
                                echo "<h1>Bienvenido a la zona pública</h1>";
                            }
                        }else{
                            echo "<h1>Bienvenido a la zona pública</h1>";
                        }
                        ?>
                        <img src="./webroot/images/fondoPublico.png" alt="">
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
