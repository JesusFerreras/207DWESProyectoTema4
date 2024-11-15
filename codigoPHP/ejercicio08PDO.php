<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Jesús Ferreras">
        <link rel="stylesheet" href="../webroot/css/estilos.css">
        <title>Ejercicio08PDO</title>
    </head>
    <body>
        <header>
            <h2>Exportación de datos a xml</h2>
        </header>
        <main>
            <?php
            /**
             * @author Jesus Ferreras
             * @since 2024/11/13
             * @version 2024/11/14
             */
            
                //Se importa el fichero con los parametros de conexion
                require_once '../config/confDB_PDO.php';
                
                //Se crea un objeto de tipo DOMDocument y se le da formato
                $doc = new DOMDocument('1.0');
                $doc->formatOutput = true;
                
                //Ruta en la que se guardara el fichero
                $ruta = '../tmp/'.date_format(new DateTime('now'), 'ymd').'departamentos.xml';
                
                try {
                    //Se abre la conexion
                    $miDB = new PDO(DSN, USUARIO, PASSWORD);
                    
                    //Conjunto de datos resultante del query
                    $resultadoConsulta = $miDB->query('select * from T02_Departamento');
                    
                    //Se crea el elemento raiz
                    $raiz = $doc->createElement('departamentos');
                    $raiz = $doc->appendChild($raiz);
                    
                    //Mientras queden registros del resultado de la consulta
                    while ($oRegistro = $resultadoConsulta->fetchObject()) {
                        //Se crea un elemento departamento
                        $departamento = $doc->createElement('departamento');
                        $departamento = $raiz->appendChild($departamento);
                        
                        //Se crea un hijo del elemento departamento por cada campo y se rellena
                        foreach ($oRegistro as $clave => $valor) {
                            $departamento->appendChild($doc->createElement($clave, $valor));
                        }
                    }
                    
                    //Se guarda el xml en un archivo en la carpeta tmp
                    $doc->save($ruta, LIBXML_NOEMPTYTAG);
                    
                    print("<p>Archivo guardado como <a href=\"$ruta\">departamentos.xml</a></p>");
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