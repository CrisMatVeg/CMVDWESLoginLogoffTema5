<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 24</title>
        <style>
            .required{
                background-color: rgb(255, 255, 174);
            }
            input:disabled{
                background-color: lightgrey;
            }

            * {
                font-family: sans-serif;
            }

            body {
                justify-content: center;
                justify-items: center;
            }

            div {
                padding: 20px;
                width: 50vw;
                height: 210px;
                background-color: lightskyblue;
                border-radius: 20px;
            }

            #enviar {
                border-radius: 20px;
                height: 30px;
                width: 120px;
                background-color: lightgreen;
                border: 2px solid rgb(55, 55, 95);
                font-weight: bold;
            }

            label,p{
                font-weight: bold;
            }
            input{
                height: 20px;
                border-radius: 3px;
                border-style: none;
            }
        </style>
    </head>
    <body>
        <?php
        /*  @author Cristian Mateos Vega
         *  @since 22/10/2025
         */

        require_once '../core/231018libreriaValidacion.php';
//Inicialización de variables
        $entradaOK = true;
        $aErrores = [
            'nombre' => '',
            'edad' => '',
            'altura' => ''
        ];
        $aRespuestas = [
            'nombre' => '',
            'edad' => '',
            'altura' => ''
        ];

// Comprobar si el formulario se ha enviado

        if (isset($_REQUEST['enviar'])) {
            $aErrores['nombre'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['nombre'], 100, 1, 1);
            $aErrores['edad'] = validacionFormularios::comprobarEntero($_REQUEST['edad'], 100, 5, 0);
            $aErrores['altura'] = validacionFormularios::comprobarFloat($_REQUEST['altura'], 100, 1, 0);

            foreach ($aErrores as $campo => $valor) {
                if ($valor != null) { // Si ha habido algun error $entradaOK es falso.
                    $entradaOK = false;
                }
            }
        } else {
            // Formulario no enviado aún
            $entradaOK = false;
        }
// Tratamiento del formulario

        if ($entradaOK) {
            foreach ($aRespuestas as $campo => $valor) {
                $aRespuestas[$campo] = $_REQUEST[$campo];
            }
            //Mostrar respuestas con datos (correctos) introducidos
            echo "<h2>Formulario enviado correctamente</h2>";
            echo "<div>";
            print("<br><h3>Respuestas del usuario</h3><br>");
            foreach ($aRespuestas as $campo => $valor) {
                print("$campo del usuario : " . $valor . '</br>');
            }
            echo "</div>";
        } else {
            // Mostrar formulario y mensajes de error (si los hay)
            ?>
            <h1>Iniciar Sesión</h1>
            <div>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <label for="usuario">Usuario:</label><br>
                    <input type="text" name="usuario" id="usuario" class="required" value="<?php echo (empty($aErrores['usuario'])) ? $aRespuestas['usuario'] : ''; ?>">
                    <span style="color:red;"><?php echo $aErrores['password']; ?></span><br><br>

                    <label for="password">Password:</label><br>
                    <input type="password" name="password" id="password" class="required value="<?php echo (empty($aErrores['password'])) ? $aRespuestas['password'] : ''; ?>">
                    <span style="color:red;"><?php echo $aErrores['password']; ?></span><br><br>

                    <input type="submit" name="entrar" value="Entrar" id="entrar">
                </form>
            </div>
            <?php
        }
        ?>
    </body>
</html>
