<?php $pageName = "links"; $description = "Links to Johan Vandegriff's profiles on other sites."; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<p class="terminal greenLink" style="color: #0f0; width: calc(100vw - 40px); margin: 0">
$ cat <a class="greenLink" href="/links.txt">links.txt</a><br/>
<?php
$filename = $_SERVER['DOCUMENT_ROOT'].'/links.txt';
$contents = file($filename);

foreach($contents as $line) {
  if ($line == "\n") {
    echo "<br/>\n";
  } else {
  $parts = preg_split('/\t/', rtrim($line));
    echo '<br/><a class="greenLink" target="_blank" href="' . $parts[1] . '">' . $parts[0] . "</a>\n";
  }
}

?>

<br/><br/><a class="greenLink" id="9dda4e98_0" href="#9dda4e98_0" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamydnav'+'&#x40;'+'nahoj'+'&#x202d;'">tutanota</a><br/><a class="greenLink" id="9dda4e98_1" href="#9dda4e98_1" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamnotorp'+'&#x40;'+'navjj'+'&#x202d;'">protonmail</a>
<?php $GLOBALS['email_counter'] += 2; ?>

<br/><br/>
$ <span class="blinking">█</span>
</p>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
