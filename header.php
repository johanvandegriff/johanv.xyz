<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8">
<!--
This HTML source code and the PHP source code used to generate it is licensed under the GNU Affero General Public License 3.0. (https://www.gnu.org/licenses/agpl-3.0.html)

The PHP code is available at: https://gitlab.com/johanvandegriff/johanv.xyz
-->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/style.css">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<title><?php
$title = "johanv.xyz | Johan Vandegriff | my chill website";
if (!isset($description)) {
    $description = "Johan Vandegriff's website where he shares his games, videos, blog, drawings, projects, and more.";
}
if (!isset($image)) {
    $image = "https://johanv.xyz/f/galleries/Random/IMG_20190301_154227.jpg";
}
$url = "https://johanv.xyz/";
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

<meta charset="utf-8">
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
</head>
<body>
<div class="ribbon"><header><a href="/" class="green"><pre>
      _         _                                                   
     (_)       | |                                                  
      _  _____ | |___  ___ _  _____ __    __    __  __ _   _  ____  
     | |(  _  )|  _  )(  _` ||  _  )\ \  / /    \ \/ /| | | |(__  / 
     | || (_) || | | || (_| || | | | \ \/ /  _   )  ( | |_| |  / /_ 
   _ | |(_____)|_| |_|(___,_||_| |_|  \__/  (_) /_/\_\(____ | /____)
  | || |                                               ___| |       
  (____)                                              (_____)       </pre>
</a></header>
<nav><ul>
<?php
$filename = $_SERVER['DOCUMENT_ROOT'].'/nav.txt';
$contents = file($filename);

if (strcmp($pageName, "") == 0) $pageName = $argv[1];

$width = 100.0/count($contents);
foreach($contents as $line) {
  $parts = preg_split('/\t/', rtrim($line));
  $name = $parts[0];
  $url = $parts[1];
  if (strcmp($pageName, $name) == 0){
    $active = ' class="active"';
  } else {
    $active = '';
  }
  echo '<li'.$active.' style="width:'.$width.'%"><a href="'.$url.'">'.$name."</a></li>\n";
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

?>
</ul></nav></div>
<div class="main">
<aside class="right">
<p class="monospace green">
$ cat <a target="_blank" class="green" href="/links.txt">links.txt</a><br/>
<?php
$filename = $_SERVER['DOCUMENT_ROOT'].'/links.txt';
$contents = file($filename);

foreach($contents as $line) {
   $parts = preg_split('/\t/', rtrim($line));
   echo '<br/><a target="_blank" class="green" href="' . $parts[1] . '">' . $parts[0] . "</a>\n";
}

?>

<br/><br/><a class="green" id="9dda4e98_0" href="#9dda4e98_0" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamydnav'+'&#x40;'+'nahoj'+'&#x202d;'">tutanota</a><br/><a class="green" id="9dda4e98_1" href="#9dda4e98_1" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamnotorp'+'&#x40;'+'navjj'+'&#x202d;'">protonmail</a>
<?php $GLOBALS['email_counter'] += 2; ?>

</p></aside>
<section>
