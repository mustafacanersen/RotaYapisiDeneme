<?php ob_start(); session_start();

    require_once __DIR__.'/vendor/autoload.php';
    $router = new AltoRouter();
    $router->setBasePath('/RotaYapisi');
    
    $db = new MysqliDb ('localhost', 'root', '', 'deneme');


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
    $router->map('POST', '/bilet-satis', function() use ($db, $router){
        $username = $_POST['username']??null;
        $pass = md5($_POST['pass'])??null;
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


        } else {
            header("Location:/RotaYapisi/uye-girisi");
        }
    }); 
    $router->map('GET', '/bilet-satis',function() use ($db, $router){
        if($_SESSION['login']??false == true && $myIp == $_SESSION['loginIP'] && $myBrowser == $_SESSION['userAgent']){

            echo "<a href='/RotaYapisi/cikis-yap'>
            <button>Çıkış Yap</button>
            </a>";
        }
        else{
            header("Location:/RotaYapisi/uye-girisi");
        }
    });
    $router->map('POST','/bilet-satis-limangetir',function() use ($db){

        $nereden = $_POST['nereden']??'';
        $db->setTrace(true);
        $db->where('id', $db->escape($nereden));
        if($db->has('ports'))
        {
            $db->where('id', $db->escape($nereden));
            $departurePort = $db->getOne('ports', 'id, country');
            $db->where('r.departurePortId', $departurePort['id']);
            $db->join('ports p', 'p.id = r.arrivalPortId', 'INNER');
            $availablePorts = $db->get('route r', null, 'DISTINCT(p.portPoint), p.id');
            if(is_array($availablePorts) && $availablePorts != NULL)
            {
                foreach ($availablePorts as $key => $portPoint)
                {
                    echo '<option value="'.$portPoint["id"].'">'.$portPoint["portPoint"].'</option>';
                }
            }
        }
        else
        {
            echo '<option value="">Uygun Liman Yok</option>';
        }
        echo '<pre>', print_r($db->trace), '</pre>';
        echo '<pre>', print_r($availablePorts), '</pre>';
        exit;

    }, 'biletsatis.limangetir');
    $router->map('POST','/sefer-ara', function() use ($db, $router){
        
        $nereden = $_POST['nereden'];
        $nereye = $_POST['nereye'];
        $gidis = $_POST['gidis'];
        $donus = $_POST['donus'];
        $acikDonus = $_POST['acikDonus']??'0';
        $yetiskin = $_POST['yetiskin'];
        $cocuk = $_POST['cocuk'];
        $bebek = $_POST['bebek'];
        $_SESSION['toplamKisi'] = $yetiskin + $cocuk + $bebek;
        $output = "";
        $db->setTrace(true);
        $db->join('ports dp', 'dp.id = dv.departurePointId', 'INNER');
        $db->join('ports ap', 'ap.id = dv.arrivalPointId', 'INNER');
        $db->join('ferries f', 'f.id = dv.ferryId', 'INNER');
        $db->where('dv.date', $gidis);
        $db->where('dv.departurePointId', $nereden);
        $db->where('dv.arrivalPointId', $nereye);
        $voyages = $db->get("dated_voyage dv", null, 'dv.*, f.ferryCompany, f.name, dp.portName AS departurePortName, ap.portName AS arrivalPortName, dp.portPoint AS departurePortPoint, ap.portPoint AS arrivalPortPoint'); 
        foreach($voyages as $key => $voyage)
        {
            $departureDate = new DateTime($voyage['date'].' '.$voyage['time']);
            $arrivalDate = new DateTime($voyage['date'].' '.$voyage['time']);
            $arrivalDate->add(new DateInterval('PT' . $voyage['duration'] . 'M'));
            $output .= '<tr>
                            <td>'.$voyage['ferryCompany'].'</td>
                            <td>'.$voyage['name'].'</td>
                            <td>'.$voyage['departurePortPoint'].'<br>'.$voyage['departurePortName'].'</td>
                            <td>'.$departureDate->format('d-m-Y H:i').'</td>
                            <td>'.$voyage['duration'].'</td>
                            <td>'.$arrivalDate->format('d-m-Y H:i'). '</td>
                            <td>'.$voyage['arrivalPortPoint'].'<br>'.$voyage['arrivalPortName'].'</td>
                            <td>'.$voyage['adultFee'].'</td>
                            <td>'.$voyage['childFee'].'</td>
                            <td>'.$voyage['babyFee'].'</td>
                            <td>
                                <a href="'.$router->generate('odeme-bilgileri', ['id' => $voyage['id'], 'yetiskin' => $yetiskin, 'cocuk' => $cocuk, 'bebek' => $bebek]).'"><button>Seç</button></a> 
                            </td>
                        </tr>';
        }
        echo '<pre>', print_r($db->trace), '</pre>';
        echo '<pre>', print_r($voyages), '</pre>';
   
        require_once __DIR__.'/views/sefer-ara.view.php';
    });
    $router->map('GET', '/odeme-bilgileri/[i:id]', function(int $id) use ($db){
        echo 'ID:'.$id;
        echo '<form action="/RotaYapisi/odeme" method="POST">
                <input name="firstname" value="'.$_SESSION['firstname'].'">
                <input name="lastname" value="'.$_SESSION['lastname'].'"><br>
                <input name="email" value="'.$_SESSION['email'].'">
                <input name="tel" value="'.$_SESSION['tel'].'"><br>
                <input name="birthday" value="'.$_SESSION['birthday'].'">
                <input name="sex" value="'.$_SESSION['sex'].'"><br>
                <input name="citizenId" value="'.$_SESSION['citizenId'].'">
                <input name="passportId" value="'.$_SESSION['passportId'].'"><br><br>
                ';
        if($_SESSION['toplamKisi']>1){
            for($i = 1; $i<$_SESSION['toplamKisi']; $i++){
                echo '<form>
                <input name="firstname" placeholder="Ad">
                <input name="lastname" placeholder="Soyad"><br>
                <input name="email" placeholder="E-posta Adresi">
                <input name="tel" placeholder="Telefon Numarası"><br>
                <input name="birthday" placeholder="Doğum Günü">
                <input name="sex" placeholder="Cinsiyet"><br>
                <input name="citizenId" placeholder="TC kimlik Numarası">
                <input name="passportId" placeholder="Pasaport Numarası"><br><br>';
            }
        }
        echo '<button type="submit">Ödeme Yap</button>
            </form><br>';
        
    }, 'odeme-bilgileri');
    $router->map('GET', '/uye-ol', function(){
        require_once __DIR__.'/views/uye-ol.view.php';
    });
    $router->map('POST', '/uye-ol', function() use ($db){

        if(isset($_POST['username']) && isset($_POST['pass'])
         && isset($_POST['firstname']) && isset($_POST['lastname'])
         && isset($_POST['birthday']) && isset($_POST['sex'])
         && isset($_POST['email']) && isset($_POST['tel'])
         && isset($_POST['citizenId']) && isset($_POST['passportId'])){
            $username = $_POST['username'];
            $pass = md5($_POST['pass']);
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $birthday = $_POST['birthday'];
            $sex = $_POST['sex'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $citizenId = $_POST['citizenId'];
            $passportId = $_POST['passportId'];
        }
        $data = Array ("username" => $username,
            "pass" => $pass,
            "firstName" => $firstname,
            "lastName" => $lastname,
            "birthday" => $birthday,
            "sex" => $sex,
            "email" => $email,
            "tel" => $tel,
            "citizenId" => $citizenId,
            "passportId" => $passportId
        );
        $id = $db->insert ('member', $data);
        if($id)
            header("Location:/RotaYapisi/uye-girisi");
    });
    $router->map('GET','/sifre-degistir',function(){
        require_once __DIR__.'/views/sifre-degistir.view.php';
    });
    $router->map('POST','/sifre-degistir',function() use ($db){
        $username = $_POST['username'];
        $pass = md5($_POST['pass']);
        $newPass = md5($_POST['newPass']);
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