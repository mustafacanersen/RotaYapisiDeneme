<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wusernameth=device-wusernameth, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
            <input name="username" placeholder="kullanıcı adı"><br>
            <input name="pass" placeholder="sifre"><br>
            <input name="firstname" placeholder="ad"><br>
            <input name="lastname" placeholder="soyad"><br>
            <input name="job" placeholder="meslek"><br>
            <input type="date" name="birthday" placeholder="doğum günü"><br>
            <input name="sex" placeholder="cinsiyet"><br>
            <button type="submit">Üye Ol</button>
        </form>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "deneme";

$conn = mysqli_connect($servername, $username, $pass, $dbname);

if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}
if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['job']) && isset($_POST['birthday']) && isset($_POST['sex'])) {
$username = $_POST['username'];
$pass = $_POST['pass'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$job = $_POST['job'];
$birthday = $_POST['birthday'];
$sex = $_POST['sex'];

$sql = "INSERT INTO uyebilgileri (username, pass, firstname, lastname, job, birthday, sex)
VALUES ('$username', '$pass', '$firstname', '$lastname', '$job', '$birthday', '$sex')";
if (mysqli_query($conn, $sql)) {
    header("Location: ");
    exit();
}
else{
    echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>