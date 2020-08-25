<?php $pageName = "Home"; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<script>
function new_fact() {
  $.ajax('/fact/')
    .done(response => document.getElementById("fact").innerHTML = response)
    .fail((xhr, status) => console.log('error:', status));
}
</script>

<h1>johanv.xyz, my chill website</h1>
<p>Hi, I'm <a href="https://blog.johanv.xyz/about-me">Johan Vandegriff</a>, and this is johanv.xyz: my new, awesome, spectacular, and chill website! Here's a random interesting fact about me:</p>
<p id="fact" class="purple"><?php include $_SERVER['DOCUMENT_ROOT'].'/fact/index.php'; ?></p>
<input type="button" value="Get New Fact!" onclick="new_fact();">

<h2>Personal Livestream Site</h2>
<p>My most recent project is a livestream hosted on this site! You can watch me live at <a target="_blank" href="https://live.johanv.xyz">live.johanv.xyz</a>. Follow me on <a target="_blank" rel="me" href="https://fosstodon.org/@johanv">Mastodon</a> for announcements when I go live.</p>

<h2 id="drawings">Drawings</h2>
<p>This is a drawing I made of the <a target="_blank" href="https://twitter.com/ErasableInc">Erasable Inc.</a> improv group at the University of Maryland (UMD) after their 24-hour show.</p>
<?php echo getThumbIMG("/f/galleries/Drawings/0_2019-05-13_ErasableIncAndFriends.png", 'class="img65left" alt="Draing of the Erasable Inc Improv Group at UMD and Friends"'); ?>
<p>For this drawing and others, I used the free and open source drawing software <a target="_blank" href="https://krita.org/">Krita</a>, a Wacom tablet, and a <a target="_blank" href="https://manjaro.org/">Manjaro</a> Linux laptop. I've also made some drawings on physical media.</p>
<p><a href="/gallery/?g=Drawings">See more of my drawings...</a></p>

<h2 id="videos">Videos</h2>
<p>I publish my videos on <a target="_blank" href="https://lbry.tv/@johanv:5">LBRY</a>, an awesome new platform that solves the demonitization issues of YouTube! <a target="_blank" href="https://lbry.tv/$/invite/@johanv:5">Follow me with my invite link</a>. This video is for a propsed research project for Gemstone at UMD. I ended up joining another project instead, but I still have the initial version and plan to make it into a product someday.</p>
<h3><a target="_blank" href="https://lbry.tv/@johanv:5/makers-case-gemstone-commercial:e">Maker's Case Gemstone Commercial</a></h3>
<!-- <iframe src="https://spee.ch/video-embed/@johanv:5/makers-case-gemstone-commercial" allowfullscreen="true" style="border:0"></iframe> -->
<!-- <iframe width="560" height="315" src="https://lbry.tv/$/embed/makers-case-gemstone-commercial/e3e0edee20fbab97268a8e7dfcc35c798cd74d6c" allowfullscreen></iframe> -->
<iframe title="Maker's Case Gemstone Commercial" onload="this.width=Math.min(560, screen.width-20); this.height=this.width*315/560" width="56" height="31.5" sandbox="allow-same-origin allow-scripts" src="https://peertube.social/videos/embed/bf19ee3e-b4e2-484d-ae08-bd52b2bf6c1e" frameborder="0" allowfullscreen></iframe>
<p><a href="/videos/">Watch more of my videos...</a></p>

<h2 id="games">Games</h2>
<p>You can play <a href="https://games.johanv.xyz/boggle">Boggle</a>, a multiplayer word game, talk to <a href="https://games.johanv.xyz/carl">CARL</a>, a chatbot that learns phrases from you, or play some of my <a href="https://games.johanv.xyz/">other games</a>, including some old ones written in perl.</p>
<a href="https://games.johanv.xyz/carl">CARL says:</a><br/><embed onload="this.width=document.body.clientWidth-20;" height="60" width="315" src="https://games.johanv.xyz/carl_api"/>
<p><a href="https://games.johanv.xyz/">Play more of my games...</a></p>

<h2 id="projects">Projects</h2>
<p>Here are some of my projects:</p>
<ul>
  <li><a href="/ArduinOLED/">ArduinOLED</a> - A handheld Arduino-based platform to create games, test equipment, and other projects. <a href="/ArduinOLED/">Learn how to make and use it!</a></li>
  <li><a href="/hexagame/">HexaGame</a> - A handheld multi-game system that consists of a hexagon of LEDs with buttons surrounding it, as well as a hex-shaped dpad.</li>
  <li><a href="/games-system/">GAMES</a> (Glamorous Automatic Multi-game Emulator System) - A tiny Arduino game system with a 3x3 LED screen and 4 buttons.</li>
  <li><a href="/calculator/">Calculator</a> - A calculator you can run in the terminal.</li>
  <li><a href="/quest/">Quest Game</a> - A roguelike game I am working on.</li>
  <li><a href="/asocialsafety.net/">asocialsafety.net</a> (archived) - The website for a hackathon project my friends and I made.</li>
  <li><a href="/configs/">My Config Files</a> - Some files with settings the way I like them, with descriptions.</li>
</ul>

<h2 id="blog">Blog</h2>
<p>Here's a snippet from a quintessential blog post of mine:</p>
<a href="https://blog.johanv.xyz/log-e-tales-from-the-electron-volts"><h3>Log.e() – Tales from the electron Volts</h3></a>
<p class="mono">An account follows of the myriad of adventures I have had with the electronVolts. My aim is that the narrative shall be as accurate as possible and will serve useful in reference during future events.</p>
<p class="mono">Saturday, October 1, 2016</p>
<p class="mono">We were visited by a band of rookies. They do not perceive the insurmountable tasks that lie ahead of them. I attempted to affright them by disclosing to them the monster that is The Code, but alas, they took an interest in this beast. I fear there is no way to warn them; their days ahead appear grim.</p>
<p class="mono">The Great Git attacked our code today. I researched its weaknesses in the Archives of Google and found individuals who were in a similar predicament. Armed with this knowledge, we were able to send it howling back from whence it came.</p>
<p><a href="https://blog.johanv.xyz/">Read more of my blog...</a></p>

<h2 id="resume">Resume</h2>
<h3>NASA GSFC Internship</h3>
<h4>summer 2017</h4>
<a target="_blank" href="/resume/images/GSFC.jpg"><img src="/resume/images/GSFC.jpg.jpg" class="img65left" alt="me with my internship mentors and poster"></a>
<p>I fixed bugs in C code for <a target="_blank" href="https://cfs.gsfc.nasa.gov/">NASA’s core Flight System</a> by writing unit tests on a CentOS Linux virtual machine (using VirtualBox). To help write unit tests, I wrote some bash scripts to generate skeleton functions, then filled them in manually with code to test each case. At the end of the summer, I created a <a target="_blank" href="/resume/images/GSFC_poster.png">poster</a> and presented it at a lab-wide showcase day.</p>
<p><a href="/resume/">Read my full resume...</a></p>

<h2 id="contact">Contact</h2>
<?php echo getThumbIMG("/f/galleries/Random/IMG_20190301_154227.jpg", 'class="img35left" alt="picture of me"'); ?>
<p>Feel free to contact me, I have multiple ways to <a target=_blank href="/contact/">get in touch securely</a>. You can also follow me on <a rel="me" href="https://fosstodon.org/@johanv">Mastodon</a> or find me at any of the other links on the right sidebar of this page.</p>

<!-- <h3>Other People's Sites</h3>
<ul>
<li><a target="_blank" href="https://joe.vandegriff.net/">https://joe.vandegriff.net/</a></li>
<li><a target="_blank" href="https://gearbox4h.org/">https://gearbox4h.org/</a></li>
<li><a target="_blank" href="https://lincoln.vandegriff.net/">https://lincoln.vandegriff.net/</a></li>
<li><a target="_blank" href="https://hairydiode.xyz/">https://hairydiode.xyz/</a></li>
<li><a target="_blank" href="https://junktext.com/">https://junktext.com/</a></li>
<li><a target="_blank" href="/asocialsafety.net/">asocialsafety.net (archived)</a></li>
<li><a target="_blank" href=""></a></li>
</ul>
-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
