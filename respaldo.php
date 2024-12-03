<link rel="stylesheet" href="Static/css/styles.css">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $mysqlDatabaseName ='sistemaalimentos4';
    $mysqlUserName ='root';
    $mysqlPassword ='admin';
    $mysqlHostName ='localhost';
    $mysqlExportPath ='respaldo.sql';

    $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ' .$mysqlExportPath;
    exec($command,$output,$worked);
    switch($worked){
    case 0:
        echo 'La base de datos <b>' .$mysqlDatabaseName .'</b> se ha almacenado correctamente en la siguiente ruta '.getcwd().'/' .$mysqlExportPath .'</b>';
        break;
    case 1:
        echo 'Se ha producido un error al exportar <b>' .$mysqlDatabaseName .'</b> a '.getcwd().'/' .$mysqlExportPath .'</b>';
        break;
    case 2:
        echo 'Se ha producido un error de exportación, comprueba la siguiente información: <br/><br/><table><tr><td>Nombre de la base de datos MySQL:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>Nombre de usuario MySQL:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>Contraseña MySQL:</td><td><b>NOTSHOWN</b></td></tr><tr><td>Nombre de host MySQL:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
        break;
    }
}
?>

