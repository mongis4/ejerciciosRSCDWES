<?php

function esPrimo($numero)
{
    if ($numero <= 1) {
        return false;
    }

    for ($i = 2; $i < $numero; $i++) {
        if ($numero % $i == 0) {
            return false;
        }
        if ($i > sqrt($numero)) {
            break;
        }
    }
    return true;
}


function mostrarPrimos($inicio, $cantidad)
{

    $contador = 0;
    $num = $inicio;
    while ($contador !== $cantidad) {
        if (esPrimo($num)) {
            echo $num .  " ";
            $contador++;
        }
        $num++;
    }
}

mostrarPrimos(1, 15);
