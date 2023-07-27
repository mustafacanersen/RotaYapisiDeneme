<?php ob_start(); session_start();

    require_once __DIR__.'/vendor/autoload.php';
    $router = new AltoRouter();
    $router->setBasePath('/RotaYapisi');
    
    $router->map( 'GET', '/uye-girisi', function(){
        $myIp = $_SERVER['REMOTE_ADDR'];
        $myBrowser = $_SERVER['HTTP_USER_AGENT'];
        if($_SESSION['login']??false == true && $myIp == $_SESSION['loginIP'] && $myBrowser == $_SESSION['userAgent']){
            header("Location:/RotaYapisi/bilet-satis");
        }
        else{
            require_once __DIR__.'/views/uye-girisi.view.php';
        }
    });
        $router->map('POST', '/bilet-satis', function(){
            $username = $_POST['username']??null;
            $pass = md5($_POST['pass'])??null;
            $db = new MysqliDb ('localhost', 'root', '', 'deneme');

            $db->where("username", $username);
            $db->where("pass", $pass);
            if($db->has("member"))
            {
                // User IP. User-agent md5();
                session_regenerate_id(true);
                $_SESSION['login'] = true;
                $_SESSION['loginIP'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                $db->where("username", $username);
                $db->where("pass", $pass);
                $member = $db->getOne("member");
                $_SESSION['firstname']= $member['firstname'];
                $_SESSION['lastname']= $member['lastname'];
                $_SESSION['birthday']= $member['birthday'];
                $_SESSION['sex']= $member['sex'];
                $_SESSION['email']= $member['email'];
                $_SESSION['tel']= $member['tel'];
                $_SESSION['citizenId']= $member['citizenId'];
                $_SESSION['passportId']= $member['passportId'];
                require_once __DIR__.'/views/bilet-satis.view.php';
                $yunanistanLiman = '';
                $query = $db->get('greece_port', null, 'portPoint');
                foreach($query as $key => $row)
                {
                    $yunanistanLiman .= '<option value = "'.$row["portPoint"].'">'.$row["portPoint"].'</option>';
                }
                
                echo "<a href='/RotaYapisi/cikis-yap'>
                <button>Çıkış Yap</button>
                </a>";
            } else {
                header("Location:/RotaYapisi/uye-girisi");
            }
        }); 
        $router->map('GET', '/bilet-satis',function(){
            if($_SESSION['login']??false == true && $myIp == $_SESSION['loginIP'] && $myBrowser == $_SESSION['userAgent']){

                echo "<a href='/RotaYapisi/cikis-yap'>
                <button>Çıkış Yap</button>
                </a>";
            }
            else{
                header("Location:/RotaYapisi/uye-girisi");
            }
        });
        $router->map('GET', '/uye-ol', function(){
            require_once __DIR__.'/views/uye-ol.view.php';
        });
        $router->map('POST', '/uye-ol', function(){

            if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['firstname']) && isset($_POST['lastname'])&& isset($_POST['birthday']) && isset($_POST['sex'])) {
            $username = $_POST['username'];
            $pass = md5($_POST['pass']);
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            }
            $db = new MysqliDb ('localhost', 'root', '', 'deneme');
            $data = Array ("username" => $username,
                "pass" => $pass,
               "firstName" => $firstname,
               "lastName" => $lastname,

               "birthday" => $birthday,
               "sex" => $sex
            );
            $id = $db->insert ('member', $data);
            if($id)
                header("Location:/RotaYapisi/uye-girisi");
            });
            $router->map('GET','/sifre-degistir',function(){
                require_once __DIR__.'/views/sifre-degistir.view.php';
            });
            $router->map('POST','/sifre-degistir',function(){
                $username = $_POST['username'];
                $pass = md5($_POST['pass']);
                $newPass = md5($_POST['newPass']);
                $db = new MysqliDb ('localhost', 'root', '', 'deneme');
                $db->where('username', $username)->where('pass', $pass)->update('member', ['pass' => $newPass]);
                if ($db->getLastErrno() === 0)
                    echo 'Güncelleme başarılı';
                else
                    echo 'Güncellleme başarısız. Hata: '. $db->getLastError();
            });
            $router->map('GET','/cikis-yap',function(){
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