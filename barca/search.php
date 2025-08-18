<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="barca.css">
        <link rel="icon" href="pngwing.com.png" type="image/png">
        <title>Document</title>
</head>
<body style="background-image:url('wc1739966-fc-barcelona-2017-wallpaper.jpg');    
background-repeat: no-repeat;
    background-size:cover;
    background-position:top;    display:flex;flex-direction:column;margin-top: 1vh;
    justify-content: center;align-items: center;">
    <div >
    <form method="get" id="mklm" >
        <input type="text" name="search" style="
    color:black;
    background-color:white;
    width: 30vw;
    height: 3vh;
    margin:4vh
" placeholder="utiliser le nom pour chercher">
        <input type="submit"style="
    width: 10vw;
    height: 3vh;
">
    </form></div>



<?php


include "in.php";
include "delet.php";


$sql = $conn->prepare("SELECT * FROM BARCA WHERE nom LIKE :nom");
$upd="%".$_GET["search"]."%";
$sql->bindParam("nom",$upd); 
$sql->execute();

echo "<table border style='width: 60vw;background-image: linear-gradient(rgb(255, 255, 255),goldenrod,rgb(0, 0, 0))
        ;  background-clip:text;
          -webkit-text-fill-color: transparent;;background-color: #0c1e72;
        font-size: 3vw;text-align: center' class='affich-u'>
        <tr><th>nom</th><th>email</th><th>image</th><th>remove</th></tr>
";


  


foreach( $sql AS $row ) {
    echo "<tr><td>".$row["nom"]."</td><td>".
    $row["email"]."</td>".
    "<td><img src='".$row["image"]."'></td>
    <td>
        <form method='post' style='display:inline;'>
            <button type='submit' name='remov' value='".$row["id"]."'>remove</button>
        </form>
    </td>
</tr>";
    // نحفظ السطر المراد تحديثه
 
   
}
echo "</table>";

?>

<?php
include "nav-min.php"
?>
</body>
</html>