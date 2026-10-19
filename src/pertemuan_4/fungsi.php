<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fungsi</title>
</head>
<body>
    <!-- 25.12.3654 -->
    
    <?php 
    $a = 10;
    function pangkatdua($a) {
        return $a * $a;
    }

    echo pangkatdua($a);

    echo "<br>";

    function gabungstring($str1, $str2) {
        return $str1 . " " . $str2;
    };

    $string1 = "Rida";
    $string2 = " pada mata kuliah PWL";

    $gabung = gabungstring($string1, $string2);

    echo $gabung;
    ?>
</body>
</html>