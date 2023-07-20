<?php
    require_once __DIR__.'/vendor/autoload.php';
    $router = new AltoRouter();
    $router->setBasePath('/RotaYapisi');
    
    $router->map( 'GET', '/', function(){
        echo '<form action="" method="POST">
            <input name="id" placeholder="kullanıcı adı"><br>
            <input name="pass" placeholder="sifre"><br>
            <button type="submit">Giriş Yap</button>
        </form>
        <a href="signUp.php" >
        <button type="submit">Üye Ol</button>
        </a>';
    });
    $id = $_POST['id'];
    $pass = $_POST['pass'];

    function girisKontrol(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "deneme";
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
        }
        $router->map('POST', '/anasayfa', girisKontrol());

    



    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        echo 'rota bulunamadı url: '.$_SERVER['REQUEST_URI'];
        //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
?>