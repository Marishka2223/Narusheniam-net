<?php
    if (isset ($_POST ["login"]) && isset ($_POST["name"]) && isset ($_POST["fam"]) && isset ($_POST["surname"])  && isset ($_POST["phone"]) && isset ($_POST["email"]) && isset ($_POST ["password"]))
    {
        $conn = new mysqli("MySQL-8.0", "root", "", "Ducks");
        if ($conn -> connect_error) 
        {
    die("Ошибка: " . $conn->connect_error);
        }
        $Names= $conn->real_escape_string ($_POST["name"]);
        $Surname= $conn->real_escape_string ($_POST["fam"]);
        $Middlename= $conn->real_escape_string ($_POST["surname"]);
        $Email= $conn->real_escape_string ($_POST["email"]);
        $Login= $conn->real_escape_string ($_POST["login"]);
        $Password= $conn->real_escape_string ($_POST["password"]);
        $phonenumbe	= $conn->real_escape_string ($_POST["phone"]);
$sql="INSERT INTO userz (login, name, fam, surname, phone, email, password	) VALUES ('$Login', '$Names', '$Surname' , '$Middlename', '$phonenumbe', '$Email' , '$Password')";
if($conn->query($sql)){
    header("Location: vxod.php");
}
else
{
    echo "Ошибка" .$conn->error;
}
$conn->close();
}
?>