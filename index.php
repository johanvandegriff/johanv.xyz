<?php $pageName = "Home"; include 'header.php';
if (isset($_GET['h']) && !empty($_GET['h'])) {
  $link_name = $_GET['h'];
  echo '<script>window.location="https://bag.johanv.xyz/f.php?h=' . $link_name . '";</script>';
}
?>

<p>Hi, I'm <a href="https://blog.johanv.xyz/about-me">Johan Vandegriff</a>. Here's an random interesting fact about me (reload for another):</p>
<p class="purple"><?php
$facts = file("facts.txt", FILE_IGNORE_NEW_LINES);
echo $facts[array_rand($facts)];
?></p>

<p>A great place to start is watching some of my <a href="/videos">videos</a>, reading my <a href="https://blog.johanv.xyz">blog</a> or checking out my <a href="/resume">resume</a> which describes some of my projects! I also have some games such as <a href="https://games.johanv.xyz/carl">CARL</a>, a chatbot, and <a href="https://games.johanv.xyz/boggle">Boggle</a>, a multiplayer word puzzle. Feel free to contact me, I have multiple ways to <a target=_blank href="contact">get in touch securely</a>. You can also follow me on <a rel="me" href="https://fosstodon.org/@johanv">Mastodon</a> or find me at any of the other links on the right sidebar of this page.</p>

<!-- <h3>Other People's Sites</h3>
<ul>
<li><a target="_blank" href="https://joe.vandegriff.net/">https://joe.vandegriff.net/</a></li>
<li><a target="_blank" href="https://gearbox4h.org/">https://gearbox4h.org/</a></li>
<li><a target="_blank" href="https://lincoln.vandegriff.net/">https://lincoln.vandegriff.net/</a></li>
<li><a target="_blank" href="https://hairydiode.xyz/">https://hairydiode.xyz/</a></li>
<li><a target="_blank" href="https://junktext.com/">https://junktext.com/</a></li>
<li><a target="_blank" href="/asocialsafety.net">asocialsafety.net (archived)</a></li>
<li><a target="_blank" href=""></a></li>
</ul>
-->
<?php include 'footer.php'; ?>
