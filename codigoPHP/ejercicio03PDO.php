<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Jesús Ferreras">
        <link rel="stylesheet" href="../webroot/css/estilos.css">
        <title>Ejercicio03PDO</title>
    </head>
    <body>
        <header>
            <h2>Formulario para añadir un departamento a la tabla con validación de entrada y control de errores</h2>
        </header>
        <main>
            <?php
            /**
             * @author Jesus Ferreras
             * @since 2024/11/06
             * @version 2024/11/11
             */
            
                //Se importa el fichero con los parametros de conexion
                require_once '../config/confDB_PDO.php';
                //Se importa la libreria de validacion de formularios
                require_once '../core/231018libreriaValidacion.php';
                
                try {
                    //Indica si el formulario entero es valido
                    $entradaOK = true;
                    
                    //Array donde se recogen los mensajes de error
                    $aErrores = [
                        "codigo" => null,
                        "descripcion" => null,
                        "volumen" => null
                    ];
                    
                    //Array donde se recogen las respuestas con el formulario valido
                    $aRespuestas = [
                        "codigo" => null,
                        "descripcion" => null,
                        "volumen" => null
                    ];
                    $patronCodigo = "/^[A-Z]{3}$/";
                    
                    //Se abre la conexion
                    $miDB = new PDO(DSN, USUARIO, PASSWORD);
                    
                    //Conjunto de datos resultante del query
                    $resultadoConsulta = null;
                    
                    //Cada registro del resultado de la consulta
                    $oRegistro = null;
                    
                    //Preparacion de la sentencia de insercion
                    $insercion = $miDB->prepare('insert into T02_Departamento(T02_CodDepartamento,T02_DescDepartamento,T02_VolumenDeNegocio) values (:codigo, :descripcion, :volumen)');
                    
                    //Si se ha enviado un formulario antes
                    if (isset($_REQUEST["submit"])) {
                        //Se rellena el array de errores con los mensajes de error
                        $aErrores["codigo"] = validacionFormularios::comprobarAlfabetico($_REQUEST["codigo"], 3, 3, 1).(!preg_match($patronCodigo, $_REQUEST["codigo"])? ' El código deben ser 3 letras mayúsculas':'');
                        if ($miDB->query("select * from T02_Departamento where T02_CodDepartamento = '{$_REQUEST["codigo"]}';")->fetchColumn() > 0) {
                            $aErrores["codigo"] .= ' Ya existe el código';
                        }
                        $aErrores["descripcion"] = validacionFormularios::comprobarAlfaNumerico($_REQUEST["descripcion"], 255, 1, 1);
                        $aErrores["volumen"] = validacionFormularios::comprobarFloat($_REQUEST["volumen"], PHP_FLOAT_MAX, 0, 1);

                        //Se comprueba que los mensajes de error sean nulos, en caso contrario el formulario no es valido y se borra la respuesta del campo erroneo
                        foreach ($aErrores as $clave => $valor) {
                            if (!empty($valor)) {
                                $entradaOK = false;
                                $_REQUEST[$clave] = '';
                            }
                        }
                    } else {
                        $entradaOK = false;
                    }

                    //Si el formulario es valido
                    if ($entradaOK) {
                        //Rellenar el array de respuestas
                        $aRespuestas["codigo"] = $_REQUEST["codigo"];
                        $aRespuestas["descripcion"] = $_REQUEST["descripcion"];
                        $aRespuestas["volumen"] = $_REQUEST["volumen"];
                        
                        foreach ($_REQUEST as $clave => $valor) {
                            $_REQUEST[$clave] = '';
                        }
                        
                        //Insertar los valores en la tabla
                        $insercion->execute($aRespuestas);
                    }
                    ?>
            
                    <form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" novalidate>
                        <table>
                            <tr>
                                <td>
                                    <label for="codigo">Código:</label>
                                    <input required type="text" id="codigo" name="codigo" value="<?php print(!empty($_REQUEST["codigo"]) ? $_REQUEST["codigo"]:""); ?>">
                                </td>
                                <td>
                                    <p class="error"><?php print(!is_null($aErrores["codigo"]) ? $aErrores["codigo"]:""); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="descripcion">Descripción:</label>
                                    <input required type="text" id="descripcion" name="descripcion" value="<?php print(!empty($_REQUEST["descripcion"]) ? $_REQUEST["descripcion"]:""); ?>">
                                </td>
                                <td>
                                    <p class="error"><?php print(!is_null($aErrores["descripcion"]) ? $aErrores["descripcion"]:""); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="volumen">Volumen:</label>
                                    <input required type="number" id="volumen" name="volumen" value="<?php print(!empty($_REQUEST["volumen"]) ? $_REQUEST["volumen"]:""); ?>">
                                </td>
                                <td>
                                    <p class="error"><?php print(!is_null($aErrores["volumen"]) ? $aErrores["volumen"]:""); ?></p>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" id="submit" name="submit">
                    </form>
            
                    <?php
                    $resultadoConsulta = $miDB->query('select * from T02_Departamento');
                    $oRegistro = $resultadoConsulta->fetchObject();
                    
                    //Si el resultado del query no es vacio
                    if ($oRegistro) {
                        //Se muestran los nombres de los campos
                        print('<table><tr>');
                        
                        foreach ($oRegistro as $clave => $valor) {
                            print("<th>$clave</th>");
                        }
                        print('</tr>');
                        
                        //Se muestran los valores de todos los campos
                        do {
                            print('<tr>');
                            foreach ($oRegistro as $valor) {
                                print("<td>$valor</td>");
                            }
                            print('</tr>');
                        } while ($oRegistro = $resultadoConsulta->fetchObject());
                        
                        print('</table>');
                    } else {
                        print('<p>Tabla vacía</p>');
                    }
                } catch (Exception $ex) {
                    //Se muestran el mensaje y codigo de error
                    print('<p>Error: '.$ex->getMessage().'<br>Codigo: '.$ex->getCode().'</p>');
                } finally {
                    //Se cierra la conexion
                    unset($miDB);
                }
            ?>
        </main>
        <footer>
            <a href="../../index.html">Jesús Ferreras González</a>
            <a href="../indexProyectoTema4.php">Tema 4</a>
        </footer>
    </body>
</html>