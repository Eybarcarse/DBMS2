<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/myshop/create.php" role="button">Add Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>PhoneNumber</th>
                    <th>Address</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername="localhost";
                    $username="root";
                    $password="";
                    $database="myshop";

                    $connection = new mysqli ($servername,$username,$password,$database );
                    
                    if($connection -> connect_error){
                        die ("Connection Failed: " .$connection -> $connect_error );
                    }
                    $sql = "SELECT * FROM clients";
                    $result = $connection ->query($sql);

                    if (!$result){
                        die ("invalid query; " .$connection -> connect_error);
                    }
                    while($row = $result -> fetch_assoc()){
        
                            echo '<tr>';
                                echo'<td>'.$row ['id'].'</td>';
                                echo'<td>'.$row ['name'].'</td>';
                                echo'<td>'.$row ['email'].'</td>';
                                echo'<td>'.$row ['phone'].'</td>';
                                echo'<td>'.$row ['address'].'</td>';
                                echo'<td>'.$row ['created_at'].'</td>';
                                echo '<td><a class="btn btn-primary btn-sm" href="/myshop/edit.php?id='.$row['id'].'">Edit</a></td>';
                                echo '<td><a class="btn btn-danger btn-sm" href="/myshop/delete.php?id='.$row['id'].'">Delete</a></td>';  
                             echo '</tr>';
                        
                            

                    }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>