<?php $pageName = "ArduinOLED"; $pageNameExtra = "Software Setup Tutorial"; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<a href="/ArduinOLED"><-Back to ArduinOLED</a>

<h2 style="text-align: center;">Tutorial</h2>
<p>Steps:</p>
<ul>
  <li><a href="#ArduinoIDE">Installing the Arduino IDE</a></li>
  <li><a href="#Libraries">Downloading the Libraries</a></li>
  <li><a href="#PlugIn">Plug in the Programmer Cable</a></li>
  <li><a href="#Examples">Uploading the Example Sketches</a></li>
  <li><a href="#NextSteps">Next Steps</a></li>
</ul>
<a id="ArduinoIDE">
  <h2>Installing the Arduino IDE</h2>
</a>
<a href="#top">[Back to top]</a>
<p>Visit the <a href="https://www.arduino.cc/en/Main/Software">Arduino Software Page</a> and click on the link for your operating system.<br /></p>
<img alt="Download the Arduino IDE" style="width: 100%" src="DownloadIDE.png" />
<p> I chose "Windows Installer", but if you don't have admin access, download the "Windows ZIP file for non admin install".</p>
<p>Click "Yes" when it asks you if the app should be allowed to make changes. Then click "Next" until the steps are done.<br /></p>
<p><img alt="Allow app to make changes" style="width: 100%" src="Allow.png" />
</p>
<p><br /></p>
<a id="Libraries">
  <h2>Downloading the Libraries</h2>
</a>
<a href="#top">[Back to top]</a>
<p>You need three libraries to use the ArduinOLED: the U8g2 library, the DirectIO library, and the ArduinOLED library.<br /></p>
<h2><span style="font-size: 17.4px;">The U8g2 library</span></h2>
<p>Open the Arduino IDE and click "Sketch", then "Include Library", then "Manage Libraries..."<br /></p>
<p><img alt="Manage Libraries" style="width: 100%" src="ManageLibraries.png" /></p>
<p>Type "U8g2" in the search bar and click "Install".<br /></p>
<p><img alt="U8g2 Library" style="width: 100%" src="U8g2Download.png" /></p>
<p>After it installs, click "Close".</p>
<h2><span style="font-size: 17.4px;">The DirectIO Library</span><br /></h2>
<p>The DirectIO library provides a faster way to set the I pins on the Arduino if the pin number is a constant. It is needed by the ArduinOLED library in the next step.</p>
<p></p>
<div data-ephox-embed-iri="https://github.com/mmarchetti/DirectIO" style="border: 1px solid rgb(170, 170, 170); box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.3); padding: 10px; overflow: hidden; margin-bottom: 1em; max-width: 500px;">
  <a href="https://github.com/mmarchetti/DirectIO" style="text-decoration: none; color: inherit;">
    <img alt="Michael Marchetti on GitHub" src="https://avatars0.githubusercontent.com/u/2903390?v=4&amp;s=400" style="max-width: 180px; max-height: 180px; margin-left: 2em; float: right;" />
  </a>
  <a href="https://github.com/mmarchetti/DirectIO" style="text-decoration: none; color: inherit;">
    <span style="font-size: 1.2em; display: block;">mmarchetti/DirectIO</span>
    <span style="margin-top: 0.5em; display: block;">DirectIO - Fast, simple I/O library for Arduino</span>
    
    <span style="opacity: 0.5; display: block; margin-top: 0.5em;">GitHub</span>
  </a>
</div><br />Go to the link above, click the "Clone or Download" button, then Click "Download ZIP".
<p></p>
<p>Alternatively, click this link to download the ZIP file:</p>
<p><a href="https://github.com/mmarchetti/DirectIO/archive/master.zip">https://github.com/mmarchetti/DirectIO/archive/master.zip</a><br /></p>
<p>Then, in the Arduino IDE, click "Sketch", "Include Library", then "Add .ZIP Library".<br /></p>
<p><img alt="Add Zip Library" style="width: 100%" src="ZipLibrary.png" /></p>
<p>Navigate to the "Downloads" folder, select "DirectIO-master.zip" that you just downloaded, and click "Open".</p>
<p><br /></p>
<h2><span style="font-size: 17.4px;">The ArduinOLED Library</span><br /></h2>
<p>The ArduinOLED library was written by me specifically for this board. The setup is very similar to that of DirectIO in the previous step.<br /></p>
<p></p>
<div data-ephox-embed-iri="https://github.com/johanvandegriff/ArduinOLED" style="border: 1px solid rgb(170, 170, 170); box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.3); padding: 10px; overflow: hidden; margin-bottom: 1em; max-width: 500px;">
  <a href="https://github.com/johanvandegriff/ArduinOLED" style="text-decoration: none; color: inherit;">
    <img alt="Johan Vandegriff on GitHub" src="https://avatars1.githubusercontent.com/u/18060905?v=4&amp;s=400" style="max-width: 180px; max-height: 180px; margin-left: 2em; float: right;" />
  </a>
  <a href="https://github.com/johanvandegriff/ArduinOLED" style="text-decoration: none; color: inherit;">
    <span style="font-size: 1.2em; display: block;">johanvandegriff/ArduinOLED</span>
    <span style="margin-top: 0.5em; display: block;">Library for the ArduinOLED board.</span>
    
    <span style="opacity: 0.5; display: block; margin-top: 0.5em;">GitHub</span>
  </a>
</div>
<p>Go to the link above, click the "Clone or Download" button, then Click "Download ZIP".</p>
<p>Alternatively, click this link to download the ZIP file:</p>
<p><a href="https://github.com/johanvandegriff/ArduinOLED/archive/master.zip">https://github.com/johanvandegriff/ArduinOLED/archive/master.zip</a></p>
<p>Then, in the Arduino IDE, click "Sketch", "Include Library", then "Add .ZIP Library".<br /></p>
<p><img alt="Add Zip Library" style="width: 100%" src="ZipLibrary.png" /></p>
<p>Navigate to the "Downloads" folder, select "ArduinOLED-master.zip" that you just downloaded, and click "Open".</p>
<p><br type="_moz" /></p>
<p>Optional: Go to the Arduino libraries folder (Documents/Arduino/libraries) and rename "DirectIO-master" to "DirectIO" and "ArduinOLED-master" to "ArduinOLED".<br /></p>
<a id="PlugIn">
  <h2>Plug in the Programmer Cable</h2>
</a>
<a href="#top">[Back to top]</a>
<p>Look at the back of the programmer and find the pin labelled "GND". Make a note of the pin color:</p>
<img alt="Programmer Cable" style="width: 100%" src="ProgrammerCable.JPG">
<p>Then plug the cable into the middle 4 pins of the connector on the ArduinOLED board, making sure the color you made note of is on the side labeled "GND".</p>
<img alt="ArduinOLED with cable plugged in" style="width: 100%" src="WithCable.JPG">
<p>Finally, plug the USB end of the programmer cable into your computer.</p>

<a id="Examples">
  <h2>Uploading the Example Sketches</h2>
</a>
<a href="#top">[Back to top]</a>
<p>Click on "File", "Examples", "ArduinOLED", then "ArduinOLED_u8g2_StackerGame".<br /></p>
<p><img alt="Stacker game example sketch" style="width: 100%" src="StackerExampleSketch.png" /></p>
<p>Hold down the button labelled "RST" on the ArduinOLED board:</p>
<img alt="Pressing the reset button" style="width: 100%" src="ResetButton.JPG">
<p>Click the "Upload" button:</p>
<img alt="Upload button" style="width: 100%" src="Upload.png">
<p>When the status changes from "Compiling..." and "Uploading...", release the "RST" button.</p>
<p>Text should appear on the screen:</p>
<img alt="Stacker game running on the ArduinOLED" style="width: 100%" src="StackerMenu.JPG">
<p>Congratulations! You did it!</p>
<p>You may notice that the highscore for the game is 255. To reset it, hold down the "R" button while the ArduinOLED powers up (either from the power switch or reset button). You will see a screen telling you that the highscore was reset.</p>

<a id="NextSteps">
  <h2>Next Steps</h2>
</a>
<a href="#top">[Back to top]</a>
<ul>
  <li>Try out the other example sketches</li>
  <li>Try making some of the projects listed on <a href="/ArduinOLED">the main ArduinOLED page</a></li>
</ul>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
