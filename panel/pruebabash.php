<?php
$my_url = 'my url';
$cmd = "php -q pruebamailer.php '" . $my_url . "' > /dev/null 2>&1 &";
shell_exec($cmd);

?>
