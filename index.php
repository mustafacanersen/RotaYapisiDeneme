<?php
    require_once __DIR__.'/vendor/autoload.php';
    $router = new AltoRouter();
    $router->setBasePath('/RotaYapisi');
    
    $router->map( 'GET', '/uye-girisi', function(){
        echo '<form action="" method="POST">
        <input name="username" placeholder="kullanıcı adı"><br>
        <input name="pass" placeholder="sifre"><br>
        <button type="submit">Giriş Yap</button>
        </form>
        <a href="signUp.php" >
        <button type="submit">Üye Ol</button>
        </a>';
    });
    

        $router->map('POST', '/uye-girisi', function(){
         /* $servername = "localhost";
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
          /*  $username = $_POST['username'];
            $pass = $_POST['pass'];
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
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $db = new MysqliDb ('localhost', 'root', '', 'deneme');
            $db->where ("username", $username);
            $db->where("pass", $pass);
            $uyebilgileri = $db->getOne ("uyebilgileri");
            if ($db->count > 0){
                echo "Hoşgeldin " . $uyebilgileri['firstname'];
            }
            else{
                echo "kullanıcı bulunamadı";
            }

          
        }); 
        $router->map('GET', '/uye-ol', function(){
            include 'signUp.php';
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


    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        echo 'rota bulunamadı url: '.$_SERVER['REQUEST_URI'];
        //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
?>