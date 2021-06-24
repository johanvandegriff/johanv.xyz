<?php $pageName = "configs"; $description = "Johan Vandegriff's config files for zsh, emacs, tmux, nano, nethack, etc."; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<h1 style="text-align: center; ">My Config Files</h1>
<p>Here are a few of my config files for various Linux applications.</p>
<h2 id="zsh">.zshrc</h2>
<p>I installed <a href="https://github.com/robbyrussell/oh-my-zsh">oh-my-zsh</a> to manage the themes for zsh and made some modifications to the <a href="zshrc">.zshrc</a> file. I also separated the theme into a separate file I named <a href="zshtheme">.zshtheme</a>.</p>
<h2 id="tmux">.tmux.conf</h2>
<p>I changed the prefix key to Ctrl-a from Ctrl-b since it is closer to the control key, especially with caps lock set to control. Other settings in <a href="tmux.conf">.tmux.conf</a> make splitting the window easier to remember with / and \ instead of " and %.</p>
<h2 id="gitconfig">.gitconfig</a></h2>
<p>My <a href="gitconfig">.gitconfig</a> has my name, email, and my gpg key for verifying commits. It also has a custom alias "git pushall" which pushes to all the remote repos with one command.</p>
<h2 id="face">.face</h2>
<p>The <a href="face">.face</a> file is used for your profile picture on your computer. I created this shape in inkscape and used it for my website favicon, profile picture, etc.</p>
<h2 id="nethack">.nethackrc</h2>
<p>NetHack is a roguelike dungeoncrawler game released in 1987 (that's older than me!), and after 2003, it stopped getting updates. But in 2016, development began again and NetHack 3.6.0 was released! I've been playing it off and on for a few years, and I've accumulated a growing config file as I discovered useful options or saw other players' setups at <a href="https://alt.org/nethack/">https://alt.org/nethack/</a>. You can see my user page <a href="https://alt.org/nethack/player-all.php?player=jjvan">here</a>, which includes records of all my games, and even a <a href="https://alt.org/nethack/browsettyrec.php?player=jjvan">ttyrec recording</a> of them. When the new version was released, some config options changed, which is why so much of my <a href="nethackrc">.nethackrc</a> is commented out. I made an <a href="https://github.com/johanvandegriff/InstallScript">install script</a> so I could install nethack whenever I install a new Linux distribution.</p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
