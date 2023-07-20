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
        <a href="signUp.php" >
        <button type="submit">Üye Ol</button>
        </a>';
    });
    

        $router->map('POST', '/uye-girisi', function(){
         /* $servername = "localhost";
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
                echo "Hoşgeldin ". $row['firstname'];
            }
            else{
                echo "kullanıcı adı veya şifre yanlış";
            } */
            $id = $_POST['id'];
            $pass = $_POST['pass'];
            try {
                $db = new PDO("mysql:host=localhost;dbname=deneme", "root", "");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           } catch ( PDOException $e ){
                print $e->getMessage();
           }
           $sql = "SELECT * FROM uyebilgileri WHERE id = :id AND pass = :pass";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $firstname = $result['firstname'];
                echo "Hoşgeldin, " . $firstname;
            } else {
                echo "Kullanıcı bulunamadı";
            }
          
        }); 
        $router->map('GET', '/uye-ol', function(){
            include 'signUp.php';
        });
        $router->map('POST', '/uye-ol', function(){

            if(isset($_POST['id']) && isset($_POST['pass']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['job']) && isset($_POST['birthday']) && isset($_POST['sex'])) {
            $id = $_POST['id'];
            $pass = $_POST['pass'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $job = $_POST['job'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            }
            try {
                $db = new PDO("mysql:host=localhost;dbname=deneme", "root", "");
           } catch ( PDOException $e ){
                print $e->getMessage();
           }
           $query = $db->prepare("INSERT INTO uyeler SET
            id = ?,
            pass = ?,
            firstname = ?
            lastname = ?
            job = ?
            birthday = ?
            sex = ?");
            $insert = $query->execute(array(
                $id, $pass, $firstname, $lastname, $job, $birthday, $sex
            ));
            });


    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        echo 'rota bulunamadı url: '.$_SERVER['REQUEST_URI'];
        //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
?>