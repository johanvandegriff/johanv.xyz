<?php $pageName = "Calc"; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
<h1>Command-line Calculator</h1>
<p><a href="calculator.zip" target="frame">Download .zip file</a></p>
<p>This is a calculator that you can run in a terminal.
To run it, you need Python 2 or 3.</p>
<p>You can either use argument mode:</p>
<div class="terminal">
$ ./calculator.py '1+1'<br/>
2
</div>
<p>or interpreter mode:</p>
<div class="terminal">
$ ./calculator.py<br/>
<span style="color: lightblue">Type help for more info.</span><br/>
<span style="color: cyan">~ </span>1+1<br/>
2<br/>
<span style="color: cyan">~ </span>123sin(4!rad(56+log4))/(3+ln(3!))<br/>
-25.390453736<br/>
<span style="color: cyan">~</span>
</div>
<p>In both modes, you can assign variables with either of the following:</p>
<div class="terminal">
83->abc<br/>
83@abc
</div>
<p>And access them like this:</p>
<div class="terminal">
3+abc<br/>
86<br/>
cos abc<br/>
0.249540117973
</div>
<p>To see more of the features, type help in interpreter mode or run <b>./calculator.py help [page #]</b>.</p>
<p><a target="_blank" href="colors.zip">Download terminal colors python module</a></p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
