<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilet Satış</title>
</head>
<body>
    <div class = "container">
        <div class "neredenNereye">
            <select name="nereden" id="nereden"></select>
            <option value="" disabled selected>Nereden</option>
            <optgroup label= Yunanistan>
                <?php
                echo $yunanistanLiman;
                ?>
            </optgroup>
        </div>
    </div>
</body>
</html>