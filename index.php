<?php $pageName = "Home"; include 'header.php';
if (isset($_GET['h']) && !empty($_GET['h'])) {
  $link_name = $_GET['h'];
  echo '<script>window.location="https://bag.johanv.xyz/f.php?h="' . $link_name . ';</script>'
}
?>

<p>Hi, I'm Johan. This is my new website, which looks a lot like <a target=_blank href="https://johan.vandegriff.net">the old site</a>... Anyway, I have a <a href="https://blog.johanv.xyz">blog</a> that has some joking posts and some informative posts, and some that are a mixture of both. Right now there isn't much here, but more is on the way <a href="https://blog.johanv.xyz/how-i-created-johanv-xyz">thanks to Dokku</a>. Feel free to contact me, I have multiple ways to <a target=_blank href="contact">get in touch securely</a>.</p>

<p>Here are a few of my old projects:</p>

<h3>ArduinOLED</h3>
<p>A board with an OLED screen, buttons, a joystick, and alligator clip connectors. More info <a href="ArduinOLED">here</a>.</p>

<h3>HexaGame</h3>
<p>A handheld game that consists of a hexagon of LEDs with buttons. More info <a href="hexagame">here</a>.</p>

<h3>Python Programs</h3>
<ul>
<li><a href="calculator">Command-line calculator</a></li>
<li><a href="quest">Quest Game</a></li>
</ul>
<?php include 'footer.php'; ?>
