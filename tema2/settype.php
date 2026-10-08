<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $a = $b = "3.1416";
        settype($b, "float");
        print "\$a vale $a y es de tipo ".gettype($a);
        print "<br>";
        print "\$b vale $b y es de tipo ".gettype($b);
    ?>
</body>
</html>