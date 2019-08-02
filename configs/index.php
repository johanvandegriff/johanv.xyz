<?php $pageName = "Configs"; include '../header.php'; ?>

<h1 style="text-align: center; ">Config Files</h1>
<p>"You can tell a lot about a woman by the contents of her purse..." ~Mr. Incredible, 2004</p>
<p>Well, I say you can tell a lot about a Linux nerd by the contents of his/her config files! These are a few of my config files for various Linux applications.</p>
<h2>.zshrc</h2>
<p>I installed <a href="https://github.com/robbyrussell/oh-my-zsh">oh-my-zsh</a> to manage the themes for zsh. <a href="zshrc">Here</a> are my modifications to the .zshrc file. I also separated the theme into a separate file I named <a href="zshtheme">.zshtheme</a>.</p>
<h2>.emacs.d/init.el</h2>
<p><a href="init.el">This config file</a> turns off the welcome screen, scratch message, tool bar, menu bar, backups, and auto-save; sets the default directory to /DATA since I store most of my files in that directory; defines a function to backwards-kill more intelligently; and sets some abbreviations and other shortcuts. I followed <a href="https://sites.google.com/site/steveyegge2/effective-emacs">this page</a> to set up my emacs configuration. Instead of using the recommended way of swapping the caps lock and control keys, I put this: <pre>setxkbmap -option "shift:both_capslock,caps:ctrl_modifier"</pre> into my <a href="profile">.profile</a></p>
<h2>.tmux.conf</h2>
<p>I changed the prefix key to Ctrl-a from Ctrl-b since it is closer to the control key, especially with caps lock set to control. Other settings in <a href="tmux.conf">.tmux.conf</a> make splitting the window easier to remember with / and \ instead of " and %.</p>
<h2>.nanorc</h2>
<p><a href="nanorc">.nanorc</a> includes syntax highlighting, makes text wrap on the end of the line, and remaps the keys for cut, paste, save, and exit.</p>
<h2>.face</h2>
<p>The <a href="face">.face</a> file is used for your profile picture on your computer. I created this shape in inkscape and used it for my website favicon, profile picture, etc.</p>
<h2>.config/user-dirs.dirs</h2>
<p>Since I use /DATA for a lot of my files, I changed <a href="user-dirs.dirs">.config/user-dirs.dirs</a> file to point to directories in /DATA.</p>
<h2>.nethackrc</h2>
<p>NetHack is a roguelike dungeoncrawler game released in 1987 (that's older than me!), and after 2003, it stopped getting updates. But in 2016, development began again and NetHack 3.6.0 was released! I've been playing it off and on for a few years, and I've accumulated a growing config file as I discovered useful options or saw other players' setups at <a href="https://alt.org/nethack/">https://alt.org/nethack/</a>. You can see my user page <a href="https://alt.org/nethack/player-all.php?player=jjvan">here</a>, which includes records of all my games, and even a <a href="https://alt.org/nethack/browsettyrec.php?player=jjvan">ttyrec recording</a> of them. When the new version was released, some config options changed, which is why so much of my <a href="nethackrc">.nethackrc</a> is commented out. I made an <a href="https://github.com/johanvandegriff/InstallScript">install script</a> so I could install nethack whenever I install a new Linux distribution.</p>
<?php include '../footer.php'; ?>
