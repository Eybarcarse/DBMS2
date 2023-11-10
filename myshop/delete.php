<?php
 $servername="localhost";
 $username="root";
 $password="";
 $database="myshop";

 $connection = new mysqli ($servername,$username,$password,$database );

 $id = $_GET['id'];
 $connection = new PDO ('mysql:host=localhost;dbname=myshop','root','');
 if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = 'DELETE FROM clients WHERE id=:id';
$delete = $connection->prepare($sql);
$delete -> bindValue ('id',$id);
$delete -> execute();
header ('location:/myshop/index.php');

?>