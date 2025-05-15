<?php
function log_to_file($message) {
    $logfile = __DIR__ . "/../logs/app.log";
    $entry = date("Y-m-d H:i:s") . " - $message\n";
    file_put_contents($logfile, $entry, FILE_APPEND);
}
?>

