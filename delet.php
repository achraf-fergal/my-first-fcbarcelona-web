<?php
include "in.php";
if (isset($_POST["remov"])) {
    $sql = $conn->prepare("DELETE FROM BARCA WHERE id=:id");
    $geTID = $_POST["remov"];
    $sql->bindParam(":id", $geTID);
    $sql->execute();
}














?>
