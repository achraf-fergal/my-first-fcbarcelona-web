<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="barca.css">
<link rel="icon" href="pngwing.com.png" type="image/png">
    <title>Document</title>
</head>

<h1 style="color: wheat;">
    bonjour achrarf

</h1>

<?php

include "in.php";


include "navbar.php";

include "delet.php";
// updit
if (isset($_POST["update_now"])) {
    $id = $_POST["id"];
    $nomup = $_POST["nome-up"];
    $emailup = $_POST["email-up"];
    $passwordup = $_POST["password-up"];
    
    $sql = null;


    if (!empty($_FILES["image-up"]["tmp_name"])) {
        $imagup = $_FILES["image-up"]["tmp_name"];       
        $image_nameup = $_FILES["image-up"]["name"];
        $uploadPath = "uploads/" .$image_nameup;
        
        if (move_uploaded_file($imagup, $uploadPath)) {
            $sql = $conn->prepare("UPDATE BARCA SET nom=:nom, email=:email, password=:password, image=:image WHERE id=:id");
            $sql->bindParam(":image", $uploadPath);
        }
    } else {
        $sql = $conn->prepare("UPDATE BARCA SET nom=:nom, email=:email, password=:password WHERE id=:id");
    }

    if ($sql) {
        $sql->bindParam(":nom", $nomup);
        $sql->bindParam(":email", $emailup);
        $sql->bindParam(":password", $passwordup);
        $sql->bindParam(":id", $id);
        $sql->execute();
    }
}


// affiche
$updata = null;
$sql = $conn->prepare("SELECT * FROM BARCA");
$sql->execute();

echo "<table border class='affich-u'> <tr><th>nom</th><th>email</th><th>password</th><th>image</th><th>remove</th><th>update</th></tr>
";

foreach( $sql AS $row ) {
    echo "<tr><td>".$row["nom"]."</td><td>".
    $row["email"]."</td><td>".$row["password"].
    "</td><td><img src='".$row["image"]."'></td>
    <td>
        <form method='post' style='display:inline;'>
            <button type='submit' name='remov' value='".$row["id"]."'>remove</button>
        </form>
    </td>
    <td>
        <form method='post' style='display:inline;'>
            <button type='submit' name='updit' value='".$row["id"]."'>update</button>
        </form>
    </td></tr>";
 
    if (isset($_POST['updit']) && $_POST['updit'] == $row['id']) {
        $updata = $row;
 

    }
   
}
echo "</table>";
?>



<?php if ($updata): ?>
 
<form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column;" class="continer-barca-login">
    <input type="hidden" name="id" value="<?php echo $updata["id"]; ?>">

        <input type="file" id="fileInput" name="image-up" accept="image/*">
 
      <input type="text" placeholder="NOM" name="nome-up" value="<?php echo $updata["nom"]?>">
     
      <input type="email"placeholder="email" name="email-up" value="<?php echo $updata["email"] ?>">
      <input  placeholder="password" name="password-up" value="<?php echo $updata["password"] ?>">
      <button type="submit" name="update_now">entre</button></form>
<?php endif; ?>
<?php
include "upload.php"
?>
<?php
include "nav-min.php"
?></html>