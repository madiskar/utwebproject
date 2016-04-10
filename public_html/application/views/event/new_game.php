<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

echo "data: " . $data['id'] . "\n\n";
flush();
?> 