<?php
    ob_start();
    session_start();
    require_once __DIR__.'/vendor/autoload.php';
    $router = new AltoRouter();
    $router->setBasePath('/RotaYapisi');
    
    $router->map( 'GET', '/uye-girisi', function(){
        $_SESSION['login'] = false;
        if($_SESSION['login'] == true){
            header("Location:/RotaYapisi/uye-bilgileri");
        }
        else{
        echo '<form action="/RotaYapisi/uye-bilgileri" method="POST">
        <input name="username" placeholder="kullanıcı adı"><br>
        <input name="pass" placeholder="sifre"><br>
        <button type="submit">Giriş Yap</button>
        </form>
        <a href="/RotaYapisi/uye-ol" >
        <button type="submit">Üye Ol</button>
        </a>
        <a href="/RotaYapisi/sifre-degistir" >
        <button type="submit">Şifremi Değiştir</button>
        </a>';
        }
    });
    

        $router->map('POST', '/uye-bilgileri', function(){
            $username = $_POST['username'];
            $pass = $_POST['pass'];
         /* İLK KULLANDIĞIM YÖNTEM
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "deneme";
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $query ="SELECT * FROM uyebilgileri WHERE username = '$username' ";
            $result = mysqli_query($conn,$query);
            $row=mysqli_fetch_array($result); 
             if($username==$row["username"] && $pass==$row["pass"]){
                echo "Hoşgeldin ". $row['firstname'];
            }
            else{
                echo "kullanıcı adı veya şifre yanlış";
            } */
          /*  İKİNCİ YÖNTEM PDO İLE
            try {
                $db = new PDO("mysql:host=localhost;dbname=deneme", "root", "");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           } catch ( PDOException $e ){
                print $e->getMessage();
           }
           $sql = "SELECT * FROM uyebilgileri WHERE username = :username AND pass = :pass";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_INT);
            $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $firstname = $result['firstname'];
                echo "Hoşgeldin, " . $firstname;
            } else {
                echo "Kullanıcı bulunamadı";
            } */
           /* ÜÇÜNCÜ YÖNTEM MySQLi KÜTÜPHANESİ İLE
            $db = new MysqliDb ('localhost', 'root', '', 'deneme');
            $db->where ("username", $username);
            $db->where("pass", $pass);
           $uyebilgileri = $db->getOne ("uyebilgileri");
            if ($db->count > 0){
                echo "Hoşgeldin " . $uyebilgileri['firstname'];
            }
            else{
                echo "kullanıcı bulunamadı";
            } */
            // DÖRDÜNCÜ YÖNTEM MySQLi KÜTÜPHANESİ İLE HAS KULLANARAK
            $db = new MysqliDb ('localhost', 'root', '', 'deneme');
            $db->where("username", $username);
            $db->where("pass", $pass);
            $uyebilgileri = $db->getOne ("uyebilgileri");
            if($db->has("uyebilgileri")) {
                $_SESSION['login'] = true;
                echo "Adı: " . $uyebilgileri['firstname']. "<br>";
                echo "Soyadı: " . $uyebilgileri['lastname']. "<br>";
                echo "Meslek: " . $uyebilgileri['job']."<br>";
                echo "Doğum Günü: ". $uyebilgileri['birthday']."<br>";
                echo "Cinsiyet: ". $uyebilgileri['sex']."<br>";
                echo "<a href='/RotaYapisi/cikis-yap'>
                <button>Çıkış Yap</button>
                </a>";
            } else {
                header("Location:/RotaYapisi/uye-girisi");
            }
          
        }); 
        $router->map('GET', '/uye-ol', function(){
         echo   '<form action="" method="POST">
            <input name="username" placeholder="kullanıcı adı"><br>
            <input name="pass" placeholder="sifre"><br>
            <input name="firstname" placeholder="ad"><br>
            <input name="lastname" placeholder="soyad"><br>
            <input name="job" placeholder="meslek"><br>
            <input type="date" name="birthday" placeholder="doğum günü"><br>
            <input name="sex" placeholder="cinsiyet"><br>
            <button type="submit">Üye Ol</button>
        </form>';
        });
        $router->map('POST', '/uye-ol', function(){

            if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['job']) && isset($_POST['birthday']) && isset($_POST['sex'])) {
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $job = $_POST['job'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            }
            $db = new MysqliDb ('localhost', 'root', '', 'deneme');
            $data = Array ("username" => $username,
                "pass" => $pass,
               "firstName" => $firstname,
               "lastName" => $lastname,
               "job" => $job,
               "birthday" => $birthday,
               "sex" => $sex
            );
            $id = $db->insert ('uyebilgileri', $data);
            if($id)
                echo 'user was created. id=' . $id;
            });
            $router->map('GET','/sifre-degistir',function(){
                echo '<form action="" method="POST">
                <input name="username" placeholder="kullanıcı adı"><br>
                <input name="pass" placeholder="şifre"><br>
                <input name="newPass" placeholder="yeni şifre"><br>
                <button type="submit">Şifremi değiştir</button>';
            });
            $router->map('POST','/sifre-degistir',function(){
                $username = $_POST['username'];
                $pass = $_POST['pass'];
                $newPass = $_POST['newPass'];
                $db = new MysqliDb ('localhost', 'root', '', 'deneme');
                $db->where('username', $username)->where('pass', $pass)->update('uyebilgileri', ['pass' => $newPass]);
                if ($db->getLastErrno() === 0)
                    echo 'Güncelleme başarılı';
                else
                    echo 'Güncellleme başarısız. Hata: '. $db->getLastError();
            });
            $router->map('GET','/cikis-yap',function(){
                
                session_unset();
                session_destroy();
                header("Location:/RotaYapisi/uye-girisi");
            });


    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        echo 'rota bulunamadı url: '.$_SERVER['REQUEST_URI'];
        //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
?>