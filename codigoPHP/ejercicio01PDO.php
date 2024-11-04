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
                //Se definen los parametros de la conexion como constantes
                define('DSN', 'mysql:host=daw207.isauces.local;port=3306;  dbname=DB207DWESProyectoTema4');
                define('USUARIO', 'user207DWESProyectoTema4');
                define('PASSWORD', 'paso');
                
                try {
                    $miDB = new PDO(DSN, USUARIO, PASSWORD);
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

                    unset($miDB);
                } catch (Exception $ex) {
                    print($ex->getMessage());
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