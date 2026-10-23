<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estiloServer.css">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Clave</th>
                <th>valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($_SERVER as $key => $value) {
                print "<tr>";
                print "<td>" . $key . "</td>";
                print "<td>" . $value . "</td>";
                print "</tr>";
            }
            ?>

        </tbody>

    </table>
</body>

</html>