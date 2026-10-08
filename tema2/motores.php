<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $tipo = ["Gasolina", "Diésel", "Motocicleta", "Eléctrico"];
    echo "Opciones: 1 (Gasolina), 2 (Diésel), 3 (Motocicleta), 4 (Eléctrico) <br>";
    $opcion = 2;


    switch ($opcion) {
        case 1:
            printf("El motor es %s", $tipo[$opcion - 1]);
            break;
        case 2:
            printf("El motor es %s", $tipo[$opcion - 1]);
            break;
        case 3:
            printf("El motor es %s", $tipo[$opcion - 1]);
            break;
        case 4:
            printf("El motor es %s", $tipo[$opcion - 1]);
            break;
        default:
            echo "Sin tipo";
    }
    ?>
</body>

</html>