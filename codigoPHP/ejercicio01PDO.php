<!doctype html>
<html>
    <head>
        <title>Ejercicio01PDO</title>
    </head>
    <body>
        <header>
            <h2>Conexión a la base de datos con la cuenta de usuario y tratamiento de errores</h2>
        </header>
        <main>
            <?php
            /**
             * @author Jesus Ferreras
             * @since 2024/11/04
             * @version 2024/11/06
             */
            
                //Se importa el fichero con los parametros de conexion
                require_once '../config/confDB_PDO.php';
                
                try {
                    //Se abre la conexion
                    $miDB = new PDO(DSN, USUARIO, PASSWORD);
                    
                    //Se muestran por pantalla los atributos
                    print($miDB->getAttribute(PDO::ATTR_AUTOCOMMIT).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_CASE).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_CLIENT_VERSION).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_CONNECTION_STATUS).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_DRIVER_NAME).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_ERRMODE).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_ORACLE_NULLS).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_PERSISTENT).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_PREFETCH).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_SERVER_INFO).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_SERVER_VERSION).'<br>');
                    print($miDB->getAttribute(PDO::ATTR_TIMEOUT).'<br>');
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