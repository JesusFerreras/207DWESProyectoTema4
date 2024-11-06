<!doctype html>
<html>
    <head>
        <title>Ejercicio02PDO</title>
    </head>
    <body>
        <header>
            <h2>Mostrar contenido de la tabla Departamento y el número de registros</h2>
        </header>
        <main>
            <?php
            /**
             * @author Jesus Ferreras
             * @since 2024/11/06
             * @version 2024/11/06
             */
            
                //Se importa el fichero con los parametros de conexion
                require_once '../config/confDB_PDO.php';
                
                try {
                    //Se abre la conexion
                    $miDB = new PDO(DSN, USUARIO, PASSWORD);
                    
                    //Conjunto de datos resultante del query
                    $resultadoConsulta = $miDB->query('select * from T02_Departamento');
                    
                    //Cada registro del resultado de la consulta
                    $oRegistro = null;
                    
                    //Si el resultado del query no es vacio
                    if (!is_null($resultadoConsulta)) {
                        $oRegistro = $resultadoConsulta->fetchObject();
                        
                        print('<table><tr>');
                        
                        foreach ($oRegistro as $clave => $valor) {
                            print("<th>$clave</th>");
                        }
                        print('</tr>');
                        
                        do {
                            print('<tr>');
                            foreach ($oRegistro as $valor) {
                                print("<td>$valor</td>");
                            }
                            print('</tr>');
                        } while ($oRegistro = $resultadoConsulta->fetchObject());
                        
                        print('</table>');
                    }
                } catch (Exception $ex) {
                    //Se muestran el mensaje y codigo de error
                    print('Error: '.$ex->getMessage().'<br>Codigo: '.$ex->getCode());
                } finally {
                    //Se cierra la conexion
                    unset($miDB);
                }
            ?>
        </main>
        <footer>
            <div>
                <a href="../../index.html">Jesús Ferreras González</a>
            </div>
            <div>
                <a href="../indexProyectoTema4.php">Tema 4</a>
            </div>
        </footer>
    </body>
</html>