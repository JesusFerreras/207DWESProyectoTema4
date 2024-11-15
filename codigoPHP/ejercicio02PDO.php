<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Jesús Ferreras">
        <link rel="stylesheet" href="../webroot/css/estilos.css">
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
                                //Si el valor debe ser numerico
                                if (preg_match('/^[0-9]+(\.[0-9]+)?$/', $valor)) {
                                    print('<td>'.number_format($valor, 2, ',', ' ').'</td>');
                                //Si el valor debe ser datetime
                                } else if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $valor)) {
                                    print('<td>'.date_format(DateTimeImmutable::createFromFormat("Y-m-d H:i:s", $valor),'d/m/Y H:i:s').'</td>');
                                } else {
                                    print("<td>$valor</td>");
                                }
                            }
                            print('</tr>');
                        } while ($oRegistro = $resultadoConsulta->fetchObject());
                        
                        print('</table>');
                    } else {
                        print('<p>Tabla vacía</p>');
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
            <a href="../../index.html">Jesús Ferreras González</a>
            <a href="../indexProyectoTema4.php">Tema 4</a>
        </footer>
    </body>
</html>