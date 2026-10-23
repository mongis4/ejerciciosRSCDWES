<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $matriz = [
        [5, 8, 0, 3],
        [7, 9, -1, 4],
        [2, 6, 1, 8],
        [7, 5]
    ];

    //recorrer fila 0
    echo "Recorro la primera fila <br>";

    for ($col = 0; $col < count($matriz[0]); $col++) {
        echo $matriz[0][$col] . " ";
    }

    echo "<br><br>";

    //recorrer todo

    for ($fil = 0; $fil < count($matriz); $fil++) {
        for ($col = 0; $col < sizeof($matriz[$fil]); $col++) {
            $num = $matriz[$fil][$col];
            if ($num < 1) {
                continue;
            }
            echo $matriz[$fil][$col] . " ";
        }
        echo "<br>";
    }

    ?>
</body>

</html>