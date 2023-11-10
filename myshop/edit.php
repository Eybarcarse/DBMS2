<?php

 $connection = new PDO ('mysql:host=localhost;dbname=myshop','root','');
    $id="";
    $name="";
    $email="";
    $phone="";
    $address="";


 if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(!isset($_GET["id"])){
            header("location: /myshop/index.php");
            exit;
        }
        $id = $_GET['id'];
        $sql = "SELECT * FROM clients WHERE  id=$id";
        $result = $connection -> query ($sql);
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $result = $connection->prepare ('SELECT * FROM clients WHERE id=:id');
        $result -> bindValue ('id', $_GET['id']);
            $result->execute();
        $result = $result->fetchAll (PDO::FETCH_ASSOC);

        if (!$row){
            header("location: /myshop/index.php");
            exit;
        }
        // $name = $row['name'];
        // $email = $row['email'];
        // $phone = $row['phone'];
        // $address = $row['address'];
        // $result = $connection -> prepare ($sql);
        // $result -> bindValue('id',$id);
        // $result -> bindValue('name',$name);
        // $result -> bindValue('email',$email);
        // $result -> bindValue('phone',$phone);
        // $result -> bindValue('address',$address);
        
 }
 else {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        
    do {
        if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All Fields Are Required";
            break;
        }
        $id = $_GET ['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $sql = 'UPDATE clients SET name=:name, email=:email, phone=:phone, address=:address
                WHERE id = $id;
                ';
                
        $result = $connection -> prepare ($sql);
        $result -> bindValue('id',$id);
        $result -> bindValue('name',$name);
        $result -> bindValue('email',$email);
        $result -> bindValue('phone',$phone);
        $result -> bindValue('address',$address);
        
        
        if (!$result) {
            $errorMessage = "Invalid Query:" . $connection -> $error;
            break;

        }
            $succesMessage= "Client Updated Succesfully";
        header('location: /myshop/index.php');
        exit;
    } while (false);     
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head> 
<body>
    <div class="container my-5" >
        <h2>Update Client</h2>

        <?php
            if (!empty($errorMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>    
                ";

            }
        
        ?>

        <form method="post"<?php echo $_GET ['id']; ?>>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $row[0]['name'] ?>"id="name">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $row[0]['email']?>" id="email">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $row[0]['phone']?>"id="phone">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $row[0]['address']?>"id="address">
                </div>
            </div>

            <?php 
                if (!empty($succesMessage)){
                    echo"
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$succesMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>    
                ";
                }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>