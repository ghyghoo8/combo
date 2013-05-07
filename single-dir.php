/**
单目录下的combo脚本
ex：http://local.tmall.net/pi/rules/??seed-min.js,htmlHint.js,cssLint.js,jsHint.js,main.js
**/
<?php

$LOCAL_ROOT = dirname($_SERVER['SCRIPT_FILENAME']);

$REAL_CDN = "http://assets.taobaocdn.com";

$parts = explode("??", $_SERVER["REQUEST_URI"]);
//$base = $parts[0];
$files = explode(",", $parts[1]);

if (strpos($files[0], ".js")) {
    header("Content-type: application/x-javascript");
} else {
    header("Content-type: text/css");
}

foreach($files as $file) {
    $url = '/'.$file;
    $root = $REAL_CDN;
    //echo $LOCAL_ROOT.$url;
    if(file_exists($LOCAL_ROOT.$url)) {
        echo "/* fetched from local file system */\n";
        $root = $LOCAL_ROOT;
    }

    echo file_get_contents($root.$url);
}
?>