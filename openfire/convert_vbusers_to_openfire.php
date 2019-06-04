<?php
#### Converter by Home of the Sebijk.com
require_once("./global.php");


	
	$result= $db->query_read("SELECT username,email FROM " . TABLE_PREFIX . "user");
	
	vbmail_start();
	while ($convertusers = $db->fetch_array($result))
		{
			$zeichen = ("abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789");                                        
      mt_srand((double) microtime() * 1000000);               
                                                         
    for ($i = 0; $i < 9; $i++) {   
    $openfire_password .= $zeichen{mt_rand (0,strlen($zeichen))};
    }

    $sendjabber_register = file_get_contents("https://".$vbulletin->options['openfire_host'].":9091/plugins/userService/userservice?type=add&secret=".$vbulletin->options['openfire_secretkey']."&username=".utf8_encode(rawurlencode($convertusers['username']))."&password=".utf8_encode(rawurlencode($openfire_password))."&email=".utf8_encode(rawurlencode($convertusers['email'])));
    
    $username = $convertusers['username']; 

    eval(fetch_email_phrases('openfire_accountdata'));
    vbmail($convertusers['email'], $subject, $message);
    unset($openfire_password);
		}
	vbmail_end();
?>
<html dir="ltr" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Home of the Sebijk.com - Converter</title>
<body>
Converting vBulletin Users to Openfire. Please wait...
<p />
<p />
Converting was successfully! The Users get a email with the Jabber Account Details.
<p />
<b>For security reasons, please delete the file!</b>
</body>
</html>