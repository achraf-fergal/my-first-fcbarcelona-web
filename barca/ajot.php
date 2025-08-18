
<?php
include "in.php";
?>
<?php
if (isset($_POST["nom"], $_POST["email"], $_POST["password"], $_FILES["image"])) {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!empty($nom) && !empty($email) && !empty($password) && !empty($_FILES["image"]["name"])) {

        $correct_username = "achraf";
        $correct_password = "1234";
        $correct_email = "farkalachraf@gmail.com";

        if ($nom === $correct_username && $password === $correct_password && $email === $correct_email) {
            header("Location:donner-utisater.php");
            exit();
        }
        else{

        $image_name = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $uploadPath = "uploads/" . $image_name;

      
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        if (move_uploaded_file($image_tmp, $uploadPath)) {
            $sql = $conn->prepare("INSERT INTO BARCA(nom, email, password, image) VALUES(:nom, :email, :password, :image)");
            $sql->bindParam(":nom", $nom);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":password", $password);
            $sql->bindParam(":image", $uploadPath);
            $sql->execute();

  

        }
                header("Location:barca.html");
            exit(); }
    } 
}
?>