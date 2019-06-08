<!DOCTYPE html><html><head><meta charset="UTF-8">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/style.css">
<title>johanv.xyz | Johan Vandegriff</title>
<meta name="description" content="Johan Vandegriff's website where he shares his projects, blog, and games.">
<link rel="icon" href="/favicon.ico?" type="image/x-icon">
</head>
<body>
<div class="ribbon"><header><a href="/" class="green"><pre>
      _         _                                                    
     (_)       | |                                                   
      _  _____ | |___  ___ _  _____ __    __     __  __ _   _  ____  
     | |(  _  )|  _  )(  _` ||  _  )\ \  / / __  \ \/ /| | | |(__  / 
     | || (_) || | | || (_| || | | | \ \/ / |\_\  )  ( | |_| |  / /_ 
   _ | |(_____)|_| |_|(___,_||_| |_|  \__/  \|_| /_/\_\(____ | /____)
  | || |                                                ___| |       
  (____)                                               (_____)       </pre>
<!---<pre>
    _____  _                 __        __           _              _  ___ ___                    
   (_   _)| |                \ \      / /          | |            (_)/  _/  _|                _  
     | |__| |__ __ ______     \ \    / __ ______ __| |____ ___   _ _ | / | /      _____ ____ | | 
     | /  | __ / _` | __ )  __ \ \  / /  ` | __ /  \ /  _ / _ |\/_| |_ _|_ _| __  | __ / __ |_ _|
  /\_| |()| || |(_| | || | |\_\ \ \/ /| -  | || | -  | ___\__ | / | || | | | |\_\ | ||_| \__/| |_
  \____\__|_||_\__,_|_||_| \|_|  \__/ \__,_|_||_\__/_\___/__/ |_| |_||_| |_| \|_| |_||_\____||__/
                                                         |___/                                   </pre>--->
</a></header>
<nav><ul>
<?php
$filename = '/nav.txt';
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

function hideEmailOpts($email, $text, $options) {
  $email = strrev($email);
  $email = implode("'+'&#x40;'+'", explode("@", $email));
  $email = implode("'+'&#x2e;'+'", explode(".", $email));
  $email = "'" . $email . "'";
  echo '<a ' . $options . 'href="#" onclick="this.innerHTML=' . "'&#x202e;'+" . $email . "+'&#x202d;'" . '">' . $text . '</a>';
}

?>
</ul></nav></div>
<div class="main">
<!--<aside class="left"></aside>-->
<aside class="right">
<!--<p class="title">External Links</p>-->
<p class="monospace green">
$ cat <a target="_blank" class="green" href="/links.txt">links.txt</a><br/>
<?php
$filename = '/links.txt';
$contents = file($filename);

foreach($contents as $line) {
   $parts = preg_split('/\t/', rtrim($line));
   echo '<br/><a target="_blank" class="green" href="' . $parts[1] . '">' . $parts[0] . "</a>\n";
}

?>
<br/><br/><a class="green" href="#" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamydnav'+'&#x40;'+'nahoj'+'&#x202d;'">tutanota</a><br/><a class="green" href="#" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamnotorp'+'&#x40;'+'navjj'+'&#x202d;'">protonmail</a>

</p></aside><section>
<br/>
