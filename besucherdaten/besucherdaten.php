<?php
/*======================================================================*\
|| #################################################################### ||
|| # Besucherdaten for Home of the Sebijk.com		                      # ||
|| # ---------------------------------------------------------------- # ||
\*======================================================================*/

// ####################### SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// #################### DEFINE IMPORTANT CONSTANTS #######################
define('NO_REGISTER_GLOBALS', 1);
define('THIS_SCRIPT', 'besucherdaten');

// ################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array();

// get special data templates from the datastore
$specialtemplates = array();

// pre-cache templates used by all actions
$globaltemplates = array('sj_besucherdaten');

// pre-cache templates used by specific actions
$actiontemplates = array();

// ######################### REQUIRE BACK-END ############################
require_once("./global.php");

$ip = IPADDRESS;
$host = gethostbyaddr($ip);
$useragent = USER_AGENT;
if ($useragent == '') $useragent = trim($_SERVER['HTTP_USER_AGENT']);

if(strstr($useragent, "Windows 95")){ 
 $system = "Windows 95"; 
}elseif(strstr($useragent, "Win95")){ 
 $system = "Windows 95"; 
}elseif(strstr($useragent, "Win 9x 4.90")){ 
 $system = "Windows Millenium Edition"; 
}elseif(strstr($useragent, "Windows 98")){ 
 $system = "Windows 98"; 
}elseif(strstr($useragent, "Win98")){ 
 $system = "Windows 98"; 
}elseif(strstr($useragent, "NT 3.51")){ 
 $system = "Windows NT 3.51"; 
}elseif(strstr($useragent, "NT 4.0")){ 
 $system = "Windows NT 4.0"; 
}elseif(strstr($useragent, "NT 5.0")){ 
 $system = "Windows 2000"; 
}elseif(strstr($useragent, "NT 5.1")){ 
 $system = "Windows XP";
}elseif(strstr($useragent, "NT 5.2")){ 
 $system = "Windows Server 2003 oder Windows XP x64";
}elseif(strstr($useragent, "NT 6.0")){ 
 $system = "Windows Vista"; 
}elseif(strstr($useragent, "NT 6.1")){ 
 $system = "Windows 7"; 
}elseif(strstr($useragent, "Win")){ 
 $system = "Windows"; 
}elseif(strstr($useragent, "Mac OS X")){ 
 $system = "Mac OS X"; 
}elseif(strstr($useragent, "Mac")){ 
 $system = "Mac Intosh"; 
}elseif(strstr($useragent, "Debian")){ 
 $system = "Debian Linux"; 
}elseif(strstr($useragent, "Ubuntu/8.10")){ 
 $system = "Ubuntu 8.10 „Intrepid Ibex“"; 
}elseif(strstr($useragent, "Ubuntu")){ 
 $system = "Ubuntu Linux"; 
}elseif(strstr($useragent, "SUSE")){ 
 $system = "SuSE Linux"; 
}elseif(strstr($useragent, "Linux")){ 
 $system = "Linux"; 
}elseif(strstr($useragent, "Unix")){ 
 $system = "Unix"; 
}else{ 
 $system = "unbekannt";} 
 
if(strstr($useragent, "Firefox/3.0")){ 
 $browser = "Mozilla Firefox 3.0"; 
}elseif(strstr($useragent, "Firefox/2.0")){ 
 $browser = "Mozilla Firefox 2.0"; 
}elseif(strstr($useragent, "Firefox/1.5")){ 
 $browser = "Mozilla Firefox 1.5"; 
}elseif(strstr($useragent, "Firefox/1.0")){ 
 $browser = "Mozilla Firefox 1.0"; 
}elseif(strstr($useragent, "Firefox/0.10")){ 
 $browser = "Mozilla Firefox 0.10"; 
}elseif(strstr($useragent, "Firefox")){ 
 $browser = "Mozilla Firefox"; 
}elseif(strstr($useragent, "Minefield")){ 
 $browser = "Mozilla Firefox Code Name „Minefield“ 3.1 Pre-Beta"; 
}elseif(strstr($useragent, "Iron")){ 
 $browser = "SRWare Iron"; 
}elseif(strstr($useragent, "Chrome")){ 
 $browser = "Google Chrome"; 
}elseif(strstr($useragent, "MSIE 8.0")){ 
 $browser = "Internet Explorer 8.0";
}elseif(strstr($useragent, "MSIE 7.0")){ 
 $browser = "Internet Explorer 7.0";
}elseif(strstr($useragent, "MSIE 7.0b")){ 
 $browser = "Internet Explorer 7.0 Beta 1"; 
}elseif(strstr($useragent, "MSIE 6.0")){ 
 $browser = "Internet Explorer 6.0"; 
}elseif(strstr($useragent, "MSIE 6.0b")){ 
 $browser = "Internet Explorer 6.0 (Pre-Release)"; 
}elseif(strstr($useragent, "MSIE 5.5")){ 
 $browser = "Internet Explorer 5.5"; 
}elseif(strstr($useragent, "MSIE 5.01")){ 
 $browser = "Internet Explorer 5.01"; 
}elseif(strstr($useragent, "MSIE 5.0")){ 
 $browser = "Internet Explorer 5.0"; 
}elseif(strstr($useragent, "MSIE 5.0b1")){ 
 $browser = "Internet Explorer 5.0 Beta 1"; 
}elseif(strstr($useragent, "MSIE 4.01")){ 
 $browser = "Internet Explorer 4.01"; 
}elseif(strstr($useragent, "MSIE 3.0")){ 
 $browser = "Internet Explorer 3.0"; 
}elseif(strstr($useragent, "MSIE")){ 
 $browser = "Internet Explorer"; 
}elseif(strstr($useragent, "Opera")){ 
 $browser = "Opera"; 
}elseif(strstr($useragent, "Netscape")){ 
 $browser = "Netscape"; 
}else{ 
 $browser = "<script type=\"text/javascript\" language=\"JavaScript\">
            <!--
            document.write(navigator.appName);
            // -->
            </script><noscript>unbekannt</noscript>";}
 

if(strstr($useragent, "SV1")){ 
 $is_sv1_active = "aktiv"; 
 } else { $is_sv1_active = "nicht aktiv"; }

if($_SERVER['HTTP_REFERER'])
{
  $referer = trim($_SERVER['HTTP_REFERER']);
} else { $referer = "Adresse eingetippt oder vom Lesezeichen aufgerufen"; }
 
$navbits = construct_navbits(array('' => "Besucherdaten"));
eval('$navbar = "' . fetch_template('navbar') . '";');
eval('print_output("' . fetch_template('sj_besucherdaten') . '");');
?>