<?php $pageName = "ATinyGame"; $image = "https://johanv.xyz/f/galleries/Random/ATinyGame.jpg"; $description = "A $1 game console that fits in 1 hand, with a program smaller than 1kB."; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<h1 style="text-align: center; ">ATinyGame: A Tiny Inexpensive Nugget for Your Gaming and All Manner of Entertainment</h1>
<p>ATinyGame is a $1 game console that fits in 1 hand, with a program smaller than 1kB. Download the <a target="_blank" href="ATinyGame.pdf">instruction PDF</a> to learn how to use it. Read the harrowing tale of its development: <a target="_blank" href="https://blog.johanv.xyz/the-assembly-instruction-that-saved-christmas">The Assembly Instruction that Saved Christmas</a>.
You can see the <a target="_blank" href="https://easyeda.com/jjvan/aTinyGame-5a98fb4c47414c39bf407d7c0f4ad94f">board design on EasyEDA</a> (<a target="_blank" href="https://easyeda.com/jjvan/GamesAttiny-0c60b91066fd4798b2eaa3da66746e06">old version here</a>).
Note that there are some changes and caveats to this design. The PCB design was incorrect, which required some adjustments and extra components after the fact. More details will be added soon.</p>

<img style="width:40%; display:block; margin-left:auto; margin-right:auto" src="/f/galleries/Random/ATinyGame.jpg" alt="">

<p>I might put un-assembled kits up for sale (since it takes me 45 min to solder each one), or at the very least I will post instructions for creating it from scratch. Either way expect tutorials and videos soon! Follow me on <a target="_blank" href="https://fosstodon.org/@johanv">mastodon</a> for updates.</p>
<p>If you have a question or comment, or if you would like to purchase one, send me and email. <a id="9dda4e98_2" href="#9dda4e98_2" onclick="this.innerHTML='&#x202e;'+'moc'+'&#x2e;'+'liamydnav'+'&#x40;'+'nahoj'+'&#x202d;'">[click to show email address]</a></p>

<p>"1kB you say?", you say. Well here's the code below as loaded onto the ATTiny9. This contains 4 games, a random number generator, a state machine, etc.
The assembly code is on <a target="_blank" href="https://codeberg.org/johanvandegriff/ATinyGame">Codeberg</a>, <a target="_blank" href="https://git.sr.ht/~johanvandegriff/ATinyGame">Sourcehut</a>, and <a target="_blank" href="https://github.com/johanvandegriff/ATinyGame">Github</a>
</p>
<pre>
      +0 +1 +2 +3 +4 +5 +6 +7 +8 +9 +A +B +C +D +E +F
4000: E0 E0 EE BF EF E5 ED BF E0 E0 F8 ED FC BF E6 BF 
4010: 00 00 87 E0 33 27 8F D1 99 27 26 E0 00 E0 E3 E1 
4020: E2 0F F0 E0 09 94 14 C0 9C C0 2C C0 40 C0 6E C0 
4030: 8F C0 1E C0 44 C0 52 C0 6D C0 6E C0 9C C0 14 C1 
4040: B4 C0 CA C0 CC C0 7C C0 3F C0 DA C0 1F C0 24 C0 
4050: E0 2F 81 D1 BB 27 32 FD 0A 95 00 50 09 F0 31 FD 
4060: 03 95 E0 2F E6 50 09 F4 0A 95 30 FD 26 E0 06 C1 
4070: 42 E2 5B D1 80 62 B3 95 B5 FF 00 C1 20 2F 01 E0 
4080: 5A D1 FC C0 96 D1 9F 2F 23 E1 F8 C0 90 50 19 F4 
4090: 60 61 11 E4 24 E1 F2 C0 1A 95 11 F0 30 FF EE C0 
40A0: 16 95 16 95 BB 27 26 E0 0C E0 A2 E0 E7 C0 81 D1 
40B0: AF 2F 11 E0 B1 E0 99 27 2E E0 07 E0 DF C0 8E D1 
40C0: 99 27 2E E0 01 E1 DA C0 99 27 2E E0 07 E0 33 D1 
40D0: BA 95 19 F4 A0 A9 B1 2F 28 E0 D0 C0 30 50 61 F0 
40E0: 7D D1 29 D1 C3 23 49 F0 BA 95 31 F4 A0 A9 99 27 
40F0: 2E E0 07 E0 55 D1 B1 2F C1 C0 5B D1 BA 95 E9 F7 
4100: 16 95 BB 27 26 E0 0C E0 A3 E0 B8 C0 BB 27 10 E0 
4110: 29 E0 B4 C0 2A E0 62 D1 B3 95 71 F0 30 50 59 F0 
4120: EC 2F E3 23 29 F0 3C D1 06 D1 20 E1 09 E0 A6 C0 
4130: 10 50 09 F0 1A 95 A2 C0 26 E0 0C E0 A4 E0 9E C0 
4140: B3 95 D1 F3 E8 2F E7 70 E0 50 71 F5 20 2F 96 C0 
4150: 32 FD 26 E0 00 E0 BB 27 2C D1 E3 95 31 FD FB D0 
4160: 8D C0 41 E1 50 E1 E2 D0 80 61 99 27 A0 E7 C1 E0 
4170: BD E0 10 E0 2B E0 30 FD 18 C0 E9 2F EB 1B A1 F4 
4180: 99 27 C0 FD A6 95 C0 FF AA 0F E1 D0 A4 FD 40 61 
4190: A3 FD 51 60 A2 FD 70 61 50 FD 70 C0 C0 FF 02 C0 
41A0: 74 FD C0 E0 44 FD C1 E0 69 C0 2D E0 40 FD 04 C0 
41B0: 44 FF 02 C0 4F 70 40 64 64 FD 04 C0 50 FF 02 C0 
41C0: 50 7F 54 60 70 FD 04 C0 74 FF 02 C0 7F 70 70 64 
41D0: 99 27 2E E0 0F E0 52 C0 95 FD 20 2F 4F C0 46 FF 
41E0: 02 C0 40 70 44 60 52 FF 03 C0 50 7F 6F 70 60 64 
41F0: 76 FF 02 C0 70 70 74 60 99 27 2E E0 02 E1 3E C0 
4200: 4B 7F 6F 7B 7B 7F AA 27 44 FD A4 60 50 FD A2 60 
4210: 74 FD A1 60 A0 FF A6 95 A0 FF A6 95 A0 50 29 F4 
4220: BB 27 26 E0 0C E0 A1 E0 29 C0 88 D0 10 FF 04 C0 
4230: 40 61 A2 95 C1 E0 06 C0 C0 E0 70 61 A2 FF AA 0F 
4240: A2 FF AA 0F 99 27 AC D0 2B E0 E1 2F E3 50 08 F4 
4250: BA 95 E1 2F E9 50 08 F4 BA 95 E2 50 09 F4 BA 95 
4260: E3 50 61 F4 BA 95 0A C0 E1 2F 75 D0 3E 7F 30 50 
4270: 29 F0 BB 27 26 E0 0A 2F 32 FD 00 E0 38 2F 88 7F 
4280: D4 E0 D1 B9 E0 E0 E2 B9 48 D0 03 9B 8D 2B D6 95 
4290: D0 50 B9 F7 30 95 38 23 37 70 E4 2F E2 95 FC E0 
42A0: D4 E0 28 D0 E4 2F FA E0 D2 E0 24 D0 E5 2F E2 95 
42B0: F9 E0 D1 E0 1F D0 E5 2F F6 E0 D2 E0 1B D0 E6 2F 
42C0: E2 95 F6 E0 D4 E0 16 D0 E6 2F F5 E0 D4 E0 12 D0 
42D0: E7 2F E2 95 F5 E0 D1 E0 0D D0 E7 2F F3 E0 D1 E0 
42E0: 09 D0 E8 2F E2 95 F3 E0 D2 E0 04 D0 E0 E0 E1 B9 
42F0: 93 95 95 CE F1 B9 F0 E0 F2 B9 E0 FD 05 C0 E1 FD 
4300: 06 C0 E2 FD 92 FD 01 C0 D2 B9 09 D0 08 95 07 D0 
4310: D2 B9 E0 E4 F0 E0 05 D0 08 95 FB E0 01 C0 F8 E0 
4320: EF EF E1 50 F0 40 E9 F7 08 95 54 2F 64 2F 75 2F 
4330: 72 95 8F 70 08 95 44 27 F8 DF 08 95 40 FB 54 F9 
4340: 62 95 70 FB 84 F9 42 95 50 FB 64 F9 72 95 4F 70 
4350: 50 7F 7F 70 08 95 EF DF EA 50 A0 F4 E6 5F E0 FD 
4360: 60 61 E2 50 E0 F0 40 61 80 61 E2 50 C0 F0 50 61 
4370: 70 61 E2 50 A0 F0 41 60 71 60 E2 50 80 F0 51 60 
4380: 61 60 0D C0 EF 50 10 F0 60 61 EF EF E0 5F E0 FD 
4390: 51 60 E1 FD 41 60 E2 FD 61 60 E3 FD 71 60 08 95 
43A0: 17 FF 13 95 08 95 88 60 93 95 09 F4 93 95 9A 95 
43B0: 90 A9 83 FF F8 CF E0 A1 FE 2F EE 0F EE 0F FE 27 
43C0: EE 0F FE 27 EE 0F FE 27 F0 95 E0 A1 FF 1F EE 1F 
43D0: E0 A9 FE 2F E6 50 F0 F7 EA 5F 08 95 AC DF E9 DF 
43E0: E2 50 28 F0 E2 50 30 F0 40 61 C4 E0 08 95 70 61 
43F0: C2 E0 08 95 80 61 C1 E0 08 95 FF FF FF FF FF FF 
</pre>
<?php $GLOBALS['email_counter']++; ?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
