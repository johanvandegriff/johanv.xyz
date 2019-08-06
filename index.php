<?php $pageName = "Home"; include 'header.php';
if (isset($_GET['h']) && !empty($_GET['h'])) {
  $link_name = $_GET['h'];
  echo '<script>window.location="https://bag.johanv.xyz/f.php?h=' . $link_name . '";</script>';
}
?>

<p>Hi, I'm Johan Vandegriff. This is my new website, which looks a lot like <a target=_blank href="https://johan.vandegriff.net">the old site</a>... Anyway, I have a <a href="https://blog.johanv.xyz">blog</a> that has some joking posts and some informative posts, and some that are a mixture of both. Right now there isn't much here, but more is on the way <a href="https://blog.johanv.xyz/how-i-created-johanv-xyz">thanks to Dokku</a>.

<p>A great place to start is watching some of my <a href="/videos">videos</a> or checking out some of my <a href="/projects">projects</a>! Feel free to contact me, I have multiple ways to <a target=_blank href="contact">get in touch securely</a>. You can also follow me on <a rel="me" href="https://fosstodon.org/@johanv">Mastodon</a>.</p>

<h3>Other People's Sites</h3>
<ul>
<li><a target="_blank" href="https://joe.vandegriff.net/">https://joe.vandegriff.net/</a></li>
<li><a target="_blank" href="https://gearbox4h.org/">https://gearbox4h.org/</a></li>
<li><a target="_blank" href="https://lincoln.vandegriff.net/">https://lincoln.vandegriff.net/</a></li>
<li><a target="_blank" href="https://hairydiode.xyz/">https://hairydiode.xyz/</a></li>
<li><a target="_blank" href="https://junktext.com/">https://junktext.com/</a></li>
<!--
<li><a target="_blank" href="/asocialsafety.net">asocialsafety.net (archived)</a></li>
<li><a target="_blank" href=""></a></li>
-->
</ul>
<?php include 'footer.php'; ?>
