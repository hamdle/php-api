#!/usr/bin/php
<?php

/*
 * Run me:
 * $ ./curl_api.php auth
 */

$url = "http://localhost/api/".($argv[1] ?? "");
$cookies = "user=Eric;pass=123";
exec("curl -X GET \"".$url."\" -H \"Cookie: ".$cookies."\"", $output);

print "\nrequest\n".$url."\n";
print "\nresponse\n".print_r($output, true);

?>
