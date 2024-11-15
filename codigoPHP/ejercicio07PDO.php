<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Jesús Ferreras">
        <link rel="stylesheet" href="../webroot/css/estilos.css">
        <title>Ejercicio07PDO</title>
    </head>
    <body>
        <header>
            <h2>Importación de datos desde xml</h2>
        </header>
        <main>
            <?php
            /**
             * @author Jesus Ferreras
             * @since 2024/11/13
             * @version 2024/11/13
             */
            
                //Se importa el fichero con los parametros de conexion
                require_once '../config/confDB_PDO.php';
                
                //Se crea un objeto de tipo DOMDocument
                $doc = new DOMDocument('1.0');
                
                //Ruta en la que esta el fichero
                $ruta = '../tmp/'.date_format(new DateTime('now'), 'ymd').'departamentos.xml';
                
                if ($doc->load($ruta)) {
                    
                    try {
                        //Se abre la conexion
                        $miDB = new PDO(DSN, USUARIO, PASSWORD);

                        //Preparacion de la sentencia de insercion
                        $insercion = $miDB->prepare('insert into T02_Departamento values (:codigo, :descripcion, :fechaAlta, :volumen, :fechaBaja)');

                        //Inicio de la transaccion
                        $miDB->beginTransaction();

                        

                        $miDB->commit();

                        print('<p>Registros añadidos</p>');

                    } catch (Exception $ex) {
                        //Se hace rollback en la transaccion
                        $miDB->rollBack();

                        //Se muestran el mensaje y codigo de error
                        print('<p>Error: '.$ex->getMessage().'<br>Codigo: '.$ex->getCode().'</p>');
                        print('<p>No se han añadido los registros</p>');
                    } finally {
                        //Se cierra la conexion
                        unset($miDB);
                    }
                } else {
                    print('<p>Ruta errónea</p>');
                }
            ?>
        </main>
        <footer>
            <a href="../../index.html">Jesús Ferreras González</a>
            <a href="../indexProyectoTema4.php">Tema 4</a>
        </footer>
    </body>
</html>