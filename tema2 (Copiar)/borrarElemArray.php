<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $array = ["Programacion", "Bases de datos", "Lenguaje de marcas"];

    foreach ($array as $value) {
        echo $value . "<br>";
    }
    echo "<br>";

    unset($array[0]);


    for ($i = 0; $i < count($array); $i++) {
        echo isset($array[$i]) ? $array[$i] . " - Este es la posicion $i <br>" : "Vacío" . " - Este es la posicion $i <br>";
    }

    echo "<br>";

    $array[0] = "Sistemas informáticos";

    for ($i = 0; $i < count($array); $i++) {
        echo isset($array[$i]) ? $array[$i] . " - Este es la posicion $i <br>" : "Vacío" . " - Este es la posicion $i <br>";
    }

    ?>
</body>

</html>