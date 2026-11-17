<?php
echo 'Versión PHP: ' . PHP_VERSION . '<br>';

var_dump(extension_loaded('intl'));

echo '<br>';

var_dump(class_exists('IntlDateFormatter'));
