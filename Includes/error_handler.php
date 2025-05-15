<?php
function error_handler($errno, $errstr, $errfile, $errline) {
    echo "<b>Gabim:</b> $errstr në $errfile në linjën $errline<br>";
    error_log("Gabim [$errno]: $errstr në $errfile në linjën $errline\n", 3, __DIR__ . "/../logs/errors.log");
    return true;
}
set_error_handler("error_handler");
?>

