#!/usr/bin/php
<?php

/*
 * Run me:
 * $ ./curl_api.php
 * $ php curl_api.php
 */

exec("curl \"http://localhost/api/auth\"", $output);
print_r($output);

?>
