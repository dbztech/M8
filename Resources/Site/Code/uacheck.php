<!-- UA Ident -->
<?php
$useragent = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
echo "USER_AGENT = $useragent<BR><BR>";

if (preg_match ("/msie/i", $useragent)) {
    print "You are using Internet Exploiter.";
} elseif (preg_match ("/opera/i", $useragent)) {
    print "Good for you! You are using Opera!";
} elseif (preg_match ("/mozilla/i", $useragent)) {
    print "Are you using Netscrape or Mozilla?";
}

#IM THE BEST
?>
