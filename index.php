<?php $pageName = "home"; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<script>
function new_fact() {
  $.ajax('/fact/')
    .done(response => $("#fact").html(response))
    .fail((xhr, status) => console.log('error:', status));
}

$(window).resize(function() {
  set_video_size();
});
function set_video_size() {
  var w = $("#drawing").width() - 4;
  $("#video").width(w);
  $("#video").height(w*315/560);
}

</script>

<style>
body {
  background-color: #cecece;
}
</style>

<div class="boxes">
  <div class="box">
    <h2>welcome to johanv.xyz</h2>
    <p>Hi, I'm <a href="https://blog.johanv.xyz/about-me">Johan Vandegriff</a> and this is my website, which STINKS: <b>S</b>tores <b>T</b>hings <b>I</b> <b>N</b>eed to <b>K</b>eep <b>S</b>omewhere :)</p>

    <img class="popup" style="width:30%; display:block; float: right; max-width: 300px; border-radius: 12px; margin: 5px" src="/ATinyGame/off.jpg">
    <p>My most recent project is <a href="/ATinyGame">ATinyGame</a>, a $1 handheld game console with 5 different games, including whack-a-mole, stacker (like at an arcade), and a memory game. It only has 1kB of storage, and 32B of ram (bytes, not gigabytes or megabytes), so I had to write the code in assembly.</p>

    <p>Here's a random interesting fact about me:</p>
    <p id="fact" class="purple"><?php include $_SERVER['DOCUMENT_ROOT'].'/fact/index.php'; ?></p>
    <input class="greenButton" type="button" value="get new fact!" onclick="new_fact();"/>
  </div>

  <div class="box">
    <h2>boggle</h2>
    <img class="popup" style="width:25%; display:block; float: right; max-width: 300px; margin: 5px" src="https://games.johanv.xyz/static/boggle/5x5.png">

    <p>This is probably the reason you ended up on my site, to play this awesome game and ignore all the other stuff here.
      But who could blame you, after all BOGGLE is the <b>BO</b>mb di<b>GG</b>ety <b>LE</b>tter game!</p>
      <form method="get" action="https://games.johanv.xyz/boggle">
        <input style="font-size: 1em; margin: 1em auto; padding: .5em .6em; border: none; border-bottom: 2px solid black; outline: 0;" type="text" id="name" name="username" placeholder="nickname" required/>
        <input class="greenButton" type="submit" value="play ▹" onmouseover="this.value=this.value.replace(/.$/,'▸')" onmouseleave="this.value=this.value.replace(/.$/,'▹')"/>
      </form>
  </div>
  
  <div class="box">
    <h2 id="drawings">drawings</h2>
    <?php echo getThumbImg("/f/galleries/Drawings/0_2019-05-13_ErasableIncAndFriends.png", 'id="drawing" style="width:66%; display:block; float: right; border-radius: 12px; margin: 5px" alt="Draing of the Erasable Inc Improv Group at UMD and Friends"'); ?>
    <p>This is a drawing I made of the <a target="_blank" href="https://twitter.com/ErasableInc">Erasable Inc.</a> improv group at the University of Maryland (UMD) after their 24-hour show. (click the image for full size)</p>
    <p>For this drawing and others, I used the free and open source drawing software <a target="_blank" href="https://krita.org/">Krita</a> and a Wacom tablet on Linux.</p>
    <a class="greenButton" href="/gallery/?g=Drawings" onmouseover="this.innerHTML=this.innerHTML.replace(/.$/,'▸')" onmouseleave="this.innerHTML=this.innerHTML.replace(/.$/,'▹')">see more ▹</a>
  </div>

  <div class="box">
    <h2 id="videos">videos</h2>
    <a href="https://odysee.com/@johanv:5/makers-case-gemstone-commercial:e"><img style="width:66%; display:block; float: right; border-radius: 12px; margin: 5px" src="makers-case.jpg"></a>
    <p>I publish my videos on <a target="_blank" href="https://odysee.com/@johanv:5">Odysee</a>, an awesome new platform that solves the demonitization issues of YouTube! <a target="_blank" href="https://odysee.com/$/invite/@johanv:5">Follow me with my invite link</a>. This video is for a propsed research project for Gemstone at UMD. I ended up joining another project instead, but I still have the initial version and plan to make it into a product someday.</p>
    <a class="greenButton" href="/videos/" onmouseover="this.innerHTML=this.innerHTML.replace(/.$/,'▸')" onmouseleave="this.innerHTML=this.innerHTML.replace(/.$/,'▹')">watch more ▹</a>
  </div>

  <div class="box">
    <h2 id="blog">blog</h2>
    <p>Here's a snippet from <a href="https://blog.johanv.xyz/log-e-tales-from-the-electron-volts">a quintessential blog post</a> of mine:</p>
    <p class="mono">An account follows of the myriad of adventures I have had with the electronVolts. My aim is that the narrative shall be as accurate as possible and will serve useful in reference during future events.</p>
    <p class="mono">Saturday, October 1, 2016</p>
    <p class="mono">We were visited by a band of rookies. They do not perceive the insurmountable tasks that lie ahead of them. I attempted to affright them by disclosing to them the monster that is The Code, but alas, they took an interest in this beast. I fear there is no way to warn them; their days ahead appear grim.</p>
    <p class="mono">The Great Git attacked our code today. I researched its weaknesses in the Archives of Google and found individuals who were in a similar predicament. Armed with this knowledge, we were able to send it howling back from whence it came.</p>
    <a class="greenButton" href="https://blog.johanv.xyz/" onmouseover="this.innerHTML=this.innerHTML.replace(/.$/,'▸')" onmouseleave="this.innerHTML=this.innerHTML.replace(/.$/,'▹')">read more ▹</a>
  </div>

  <div class="box">
    <h2 id="games">games</h2>
    <p>You can play <a href="https://games.johanv.xyz/boggle">Boggle</a>, a multiplayer word game, talk to <a href="https://games.johanv.xyz/carl">CARL</a>, a chatbot that learns phrases from you, or play some of my <a href="https://games.johanv.xyz/">other games</a>, including some old ones written in perl. Speaking of old games, you can also check out my old stuff on <a target="_blank" href="https://scratch.mit.edu/users/jjvan/">scratch.</a></p>

    <a href="https://games.johanv.xyz/carl">CARL</a> says:
    <pre><?php echo file_get_contents("https://games.johanv.xyz/carl_api"); ?></pre>

    <a class="greenButton" href="https://games.johanv.xyz/" onmouseover="this.innerHTML=this.innerHTML.replace(/.$/,'▸')" onmouseleave="this.innerHTML=this.innerHTML.replace(/.$/,'▹')">play games ▹</a>
  </div>

  <div class="box">
    <h2 id="projects">projects</h2>
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
  </div>

  <div class="box">
    <h2 id="resume">resume</h2>
    <?php echo getThumbImg("/f/galleries/Random/GSFC.jpg", 'style="width:40%; display:block; float: right; border-radius: 12px; margin: 5px" alt="me with my internship mentors and poster"'); ?>
    <h3>NASA GSFC Internship</h3>
    <h4>summer 2017</h4>
    <p>I fixed bugs in C code for <a target="_blank" href="https://cfs.gsfc.nasa.gov/">NASA’s core Flight System</a> by writing unit tests on a CentOS Linux virtual machine (using VirtualBox). To help write unit tests, I wrote some bash scripts to generate skeleton functions, then filled them in manually with code to test each case. At the end of the summer, I created a <a target="_blank" href="/resume/images/GSFC_poster.png">poster</a> and presented it at a lab-wide showcase day.</p>
    <a class="greenButton" href="/resume/" onmouseover="this.innerHTML=this.innerHTML.replace(/.$/,'▸')" onmouseleave="this.innerHTML=this.innerHTML.replace(/.$/,'▹')">full resume ▹</a>
  </div>

  <div class="box">
    <h2 id="contact">contact</h2>
    <?php echo getThumbImg("/f/galleries/Random/IMG_20190301_154227.jpg", 'style="width:20%; display:block; float: right; border-radius: 12px; margin: 5px" alt="picture of me"'); ?>
    <p>Feel free to contact me, I have multiple ways to <a href="/contact/">get in touch securely</a>. You can also follow me on <a rel="me" href="https://fosstodon.org/@johanv">Mastodon</a> or find me at any of the other links on the right sidebar of this page.</p>
    <a class="greenButton" href="/contact/" onmouseover="this.innerHTML=this.innerHTML.replace(/.$/,'▸')" onmouseleave="this.innerHTML=this.innerHTML.replace(/.$/,'▹')">contact me ▹</a>
    </form>
  </div>

</div>

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
