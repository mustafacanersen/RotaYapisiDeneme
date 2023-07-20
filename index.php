<?php
    require_once __DIR__.'/vendor/autoload.php';
    $router = new AltoRouter();
    $router->setBasePath('/RotaYapisi');
    
    $router->map( 'GET', '/uye-girisi', function(){
        echo '<form action="" method="POST">
            <input name="id" placeholder="kullanıcı adı"><br>
            <input name="pass" placeholder="sifre"><br>
            <button type="submit">Giriş Yap</button>
        </form>
        <a href="/uye-ol" >
        <button type="submit">Üye Ol</button>
        </a>';
    });
    

        $router->map('POST', '/uye-girisi', function(){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "deneme";
            $id = $_POST['id'];
            $pass = $_POST['pass'];
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $query ="SELECT * FROM uyebilgileri WHERE id = '$id' ";
            $result = mysqli_query($conn,$query);
            $row=mysqli_fetch_array($result);
            if($id==$row["id"] && $pass==$row["pass"]){
                echo "Hoşgeldin". $row['ad'];
            }
            else{
                echo "kullanıcı adı veya şifre yanlış";
            }
        });
        $router->map('GET', '/uye-ol', function(){
            include 'signUp.php';
        });
        $router->map('POST', '/uye-ol', function(){
            $servername = "localhost";
            $username = "root";
            $pass = "";
            $dbname = "deneme";
            
            $conn = mysqli_connect($servername, $username, $pass, $dbname);
            
            if (!$conn) {
                die("Bağlantı hatası: " . mysqli_connect_error());
            }
            if(isset($_POST['id']) && isset($_POST['pass']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['job']) && isset($_POST['birthday']) && isset($_POST['sex'])) {
            $id = $_POST['id'];
            $pass = $_POST['pass'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $job = $_POST['job'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            
            $sql = "INSERT INTO uyebilgileri (id, pass, firstname, lastname, job, birthday, sex)
            VALUES ('$id', '$pass', '$firstname', '$lastname', '$job', '$birthday', '$sex')";
            if (mysqli_query($conn, $sql)) {
                header("Location: ");
                exit();
            }
            else{
                echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
            }
            }
            });


    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        echo 'rota bulunamadı url: '.$_SERVER['REQUEST_URI'];
        //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
?>