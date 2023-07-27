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
                    url:"/RotaYapisi/ajax",
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
    <div class = "container">
        <div class "neredenNereye">
            <select name="nereden" id="nereden">
            <option value="" disabled selected>Nereden</option>
            <optgroup label= Yunanistan>
                <?php
                $query = $db->get('greece_port', null, 'portPoint');
                foreach($query as $key => $row)
                {
                    echo'<option value = "'.$row["portPoint"].'">'.$row["portPoint"].'</option>';
                }
                ?>
            </optgroup>
            <optgroup label= Türkiye>
                <?php
                $query = $db->get('turkey_port', null, 'portPoint');
                foreach($query as $key => $row)
                {
                    echo'<option value = "'.$row["portPoint"].'">'.$row["portPoint"].'</option>';
                }
                ?>
            </optgroup>
            </select>
            <select name="nereye" id="nereye">

            </select>
        </div>
    </div><br><br>
    <a href='/RotaYapisi/cikis-yap'>
        <button>Çıkış Yap</button>
    </a>
</body>
</html>