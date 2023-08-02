<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilet Satış</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript""></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#nereden').change(function(){
                var nereden=$(this).val();
                $.ajax({
                    url: "<?php echo $router->generate('biletsatis.limangetir'); ?>",
                    method:"POST",
                    data:{nereden:nereden},
                    dataType:"text",
                    success:function(data){
                        $('#nereye').html(data);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <form action="/RotaYapisi/sefer-ara" method="POST">
    <div class = "container">
        <div class = "neredenNereye">
            <select name="nereden" id="nereden">
            <option value="" disabled selected>Nereden</option>
            <optgroup label= Yunanistan>
                <?php
                $db->groupBy('portPoint');
                $db->where('country','el');
                $query = $db->get('ports', null, 'portPoint, id');
                foreach($query as $key => $row)
                {
                    echo'<option value = "'.$row["id"].'">'.$row["portPoint"].'</option>';
                }
                ?>
            </optgroup>
            <optgroup label= Türkiye>
                <?php
                $db->groupBy('portPoint');
                $db->where('country','tr');
                $query = $db->get('ports', null, 'portPoint, id');
                foreach($query as $key => $row)
                {
                    echo'<option value = "'.$row["id"].'">'.$row["portPoint"].'</option>';
                }
                ?>
            </optgroup>
            </select>
            <select name="nereye" id="nereye">
                <option value="" disabled selected>Nereye</option>
            </select>
        </div><br>
        <div class = "gidisDonus">
            <div class="gidis" style = "display: inline-block">
            <label for="gidis">Gidiş</label><br>
            <input type="date" name="gidis" id="gidis">
            </div>
            <div class="donus" style = "display: inline-block">
            <label for="donus">Dönüş</label><br>
            <input type="date" name="donus" id="donus">
            </div>
            <input type="checkbox" name="acikDonus" id="acikDonus" value="1">
            <label for="acikDonus">Açık Dönüş</label>
        </div><br>
        <div class = "yolcu">
            <div class= "yetiskin" style = "display:inline-block">
            <strong>
                Yetişkin
            </strong><br>
            <select name="yetiskin" id="yetiskin">
                <option value="1" selected>1 Yetişkin</option>
                <option value="2">2 Yetişkin</option>
                <option value="3">3 Yetişkin</option>
                <option value="4">4 Yetişkin</option>
                <option value="5">5 Yetişkin</option>
                <option value="6">6 Yetişkin</option>
                <option value="7">7 Yetişkin</option>
                <option value="8">8 Yetişkin</option>
                <option value="9">9 Yetişkin</option>
                <option value="10">10 Yetişkin</option>
            </select>
            </div>
            <div class= "cocuk"  style = "display:inline-block">
            <strong>
                Çocuk
            </strong><br>
            <select name="cocuk" id="cocuk">
                <option value="0" selected>0 Çocuk</option>
                <option value="1">1 Çocuk</option>
                <option value="2">2 Çocuk</option>
                <option value="3">3 Çocuk</option>
                <option value="4">4 Çocuk</option>
                <option value="5">5 Çocuk</option>
                <option value="6">6 Çocuk</option>
                <option value="7">7 Çocuk</option>
                <option value="8">8 Çocuk</option>
                <option value="9">9 Çocuk</option>
                <option value="10">10 Çocuk</option>
            </select>
            </div>
            <div class= "bebek" style = "display:inline-block">
            <strong>
                Bebek
            </strong><br>
            <select name="bebek" id="bebek">
                <option value="0" selected>0 Çocuk</option>
                <option value="1">1 Bebek</option>
                <option value="2">2 Bebek</option>
                <option value="3">3 Bebek</option>
                <option value="4">4 Bebek</option>
                <option value="5">5 Bebek</option>
                <option value="6">6 Bebek</option>
                <option value="7">7 Bebek</option>
                <option value="8">8 Bebek</option>
                <option value="9">9 Bebek</option>
                <option value="10">10 Bebek</option>
            </select>
            </div>
            <button type = "submit">Sefer Ara</button>
        </div>
    </div><br><br>
    </form>
    <a href='/RotaYapisi/cikis-yap'>
        <button>Çıkış Yap</button>
    </a>
</body>
</html>