<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">
<!--
This HTML source code and the PHP source code used to generate it is licensed under the GNU Affero General Public License 3.0. (https://www.gnu.org/licenses/agpl-3.0.html)

The PHP code is available at: https://git.sr.ht/~johanvandegriff/johanv.xyz
-->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<?php
if (!isset($no_extras)) {
    echo '<script src="/jquery-3.4.1.min.js" type="text/javascript"></script>' . "\n";
}
?>
<link rel="stylesheet" type="text/css" href="/style.css">
<title><?php
$title = "johanv.xyz | Johan Vandegriff | my chill website";
if (!isset($description)) {
    $description = "Johan Vandegriff's website where he shares his games, videos, blog, drawings, projects, and more.";
}
if (!isset($image)) {
    $image = "https://johanv.xyz/f/galleries/Random/IMG_20190301_154227.jpg";
}
if (!isset($url)) {
    $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
$site_name = "johanv.xyz";

if ($pageName != "Home") {
    if (isset($pageNameExtra)) {
        $title = $pageNameExtra.' | '.$pageName.' | '.$title;
    } else {
        $title = $pageName.' | '.$title;
    }
}
echo $title;
?></title>

<meta name="description" content="<?php echo $description; ?>">
<meta name="robots" content="index, follow">
<meta name="author" content="Johan Vandegriff">

<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:site_name" content="<?php echo $site_name; ?>">
<meta property="og:url" content="<?php echo $url; ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<meta property="og:image" content="<?php echo $image; ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?php echo $url; ?>">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:image" content="<?php echo $image; ?>">

<link rel="icon" href="/favicon.ico?" type="image/x-icon">
<?php
if (!isset($viewport)) {
  $viewport = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
}
echo $viewport . "\n";
?>
<style>
  @media not all and (max-width: 600px) {
    nav ul li {
      width:<?php
$filename = $_SERVER['DOCUMENT_ROOT'].'/nav.txt';
$contents = file($filename);
$width = 100.0/count($contents);
echo "$width";
      ?>%
    }
  }
</style>
</head>
<body>
<div id="ribbon"><header><a href="/" class="greenLink"><pre id="titleText">johanv.xyz</pre><pre id="asciiArtSmall">
  ___  _       _                    _  
   |  | | |_| |_| |\ | | /   \/ \ /  / 
 |_|  |_| | | | | | \| |/  o /\  |  /_ 
 
</pre><pre id="asciiArt">
      _         _                                                   
     (_)       | |                                                  
      _  _____ | |___  ___ _  _____ __    __    __  __ _   _  ____  
     | |(  _  )|  _  )(  _` ||  _  )\ \  / /    \ \/ /| | | |(__  / 
     | || (_) || | | || (_| || | | | \ \/ /  _   )  ( | |_| |  / /_ 
   _ | |(_____)|_| |_|(___,_||_| |_|  \__/  (_) /_/\_\(____ | /____)
  | || |                                               ___| |       
  (____)                                              (_____)       </pre>
</a></header>
<nav><div id="navDropdown">&#9776; menu</div><input id="navToggle" type="checkbox" checked><ul>
<?php
if (strcmp($pageName, "") == 0) $pageName = $argv[1];

foreach($contents as $line) {
  $parts = preg_split('/\t/', rtrim($line));
  $name = $parts[0];
  $url = $parts[1];
  if (strcmp($pageName, $name) == 0){
    echo '<li id="active"><a href="'.$url.'">'.$name."</a></li>\n";
  } else {
    echo '<li><a href="'.$url.'">'.$name."</a></li>\n";
  }
}

function hideEmail($email, $text) {
  hideEmailOpts($email, $text, '');
}

$GLOBALS['email_counter'] = 0;

function hideEmailOpts($email, $text, $options) {
  $email = strrev($email);
  $email = implode("'+'&#x40;'+'", explode("@", $email));
  $email = implode("'+'&#x2e;'+'", explode(".", $email));
  $email = "'" . $email . "'";
  echo '<a ' . $options . 'id="9dda4e98_' . $GLOBALS['email_counter'] . '" href="#9dda4e98_' . $GLOBALS['email_counter'] . '" onclick="this.innerHTML=' . "'&#x202e;'+" . $email . "+'&#x202d;'" . '">' . $text . '</a>';
  $GLOBALS['email_counter']++;
}

function getThumbUrl($imgUrl) {
  $thumbUrl = $imgUrl.".jpg";
  if (substr($imgUrl, 0, 3) == "/f/") {
    $thumbUrl = "/thumbs/".substr($imgUrl, 3).".jpg";

    if (file_exists($_SERVER['DOCUMENT_ROOT'].$thumbUrl)) {
      return $thumbUrl;
    }
  }
  return $imgUrl;
}

function getThumbImg($imgUrl, $props) {
  $thumbUrl = getThumbUrl($imgUrl);
  return '<img class="popup" src="'.$thumbUrl.'" '.$props.'>';
}

?>
</ul></nav></div>

<div class="show">
  <div class="overlay"></div>
  <div class="img-show">
    <span>X</span>
    <img src="">
  </div>
</div>
<?php
if (!isset($no_extras)) {
  echo '<script src="/img-popup.js"></script>' . "\n";
}
?>

<div id="main">
<!-- <aside class="right">
</aside> -->
<section>
