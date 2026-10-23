<?php
$ciclos = [
    "DAW" => ["PR" => "Programación", "BD" => "Bases de datos", "PMDMO" => "Programacion Multimedia"],
    "DAM" => ["PR" => "Programacion", "BD" => "Bases de datos", "DWES" => "Desarrollo web"]
];


print $ciclos["DAM"]["BD"];


foreach ($ciclos as $ciclo => $asignaturas) {
    echo "<h2>Ciclo: $ciclo</h2>";
    foreach ($asignaturas as $codigo => $nombre) {
        echo "$codigo: $nombre <br>";
    }
}
