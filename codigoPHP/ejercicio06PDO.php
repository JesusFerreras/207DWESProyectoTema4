<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Jesús Ferreras">
        <link rel="stylesheet" href="../webroot/css/estilos.css">
        <title>Ejercicio05PDO</title>
    </head>
    <body>
        <header>
            <h2>Inserción de registros mediante transacción</h2>
        </header>
        <main>
            <?php
            /**
             * @author Jesus Ferreras
             * @since 2024/11/12
             * @version 2024/11/12
             */
            
                //Se importa el fichero con los parametros de conexion
                require_once '../config/confDB_PDO.php';
                
                $datos = [
                    [
                        'codigo' => 'DPA',
                        'descripcion' => 'DPT Transaccion A',
                        'volumen' => 10
                    ],
                    [
                        'codigo' => 'DPB',
                        'descripcion' => 'DPT Transaccion B',
                        'volumen' => 20
                    ],
                    [
                        'codigo' => 'DPC',
                        'descripcion' => 'DPT Transaccion C',
                        'volumen' => 30
                    ]
                ];
                
                try {
                    //Se abre la conexion
                    $miDB = new PDO(DSN, USUARIO, PASSWORD);
                    
                    //Preparacion de la sentencia de insercion
                    $insercion = $miDB->prepare('insert into T02_Departamento(T02_CodDepartamento,T02_DescDepartamento,T02_VolumenDeNegocio) values (:codigo, :descripcion, :volumen)');
                    
                    //Inicio de la transaccion
                    $miDB->beginTransaction();
                    
                    //Se borran los registros afectados y se introducen los datos del array 
                    foreach ($datos as $registro) {
                        $insercion->execute($registro);
                    }
                    
                    $miDB->commit();
                    
                    print('<p>Registros añadidos</p>');
                } catch (Exception $ex) {
                    //Se hace rollback en la transaccion
                    $miDB->rollBack();
                    
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