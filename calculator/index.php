<?php $pageName = "Calc"; include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
<h1>Command-line Calculator</h1>
<p><a href="calculator.zip" target="frame">Download .zip file</a></p>
<p>This is a calculator that you can run in a terminal.
To run it, you need Python 2 or 3.</p>
<p>You can either use argument mode:</p>
<table bgcolor="black" cellpadding=10><tr><td>
<b><font color="white">$ ./calculator.py '1+1'<br/>
2</font><br/></b>
</td></tr></table>
<p>or interpreter mode:</p>
<table bgcolor="black" cellpadding=10><tr><td><b>
<font color="white">$ ./calculator.py</font><br/>
<font color="lightblue">Type help for more info.</font><br/>
<font color="cyan">~ </font><font color="white">1+1</font><br/>
<font color="white">2</font><br/>
<font color="cyan">~ </font><font color="white">123sin(4!rad(56+log4))/(3+ln(3!))</font><br/>
<font color="white">-25.390453736</font><br/>
<font color="cyan">~</font>
</b></td></tr></table>
<p>In both modes, you can assign variables with either of the following:</p>
<table bgcolor="black" cellpadding=10><tr><td><b><font color="white">
83->abc<br/>
83@abc
</font></b></td></tr></table>
<p>And access them like this:</p>
<table bgcolor="black" cellpadding=10><tr><td><b><font color="white">
3+abc<br/>
86<br/>
cos abc<br/>
0.249540117973
</font></b></td></tr></table>
<p>To see more of the features, type help in interpreter mode or run <b>./calculator.py help [page #]</b>.</p>
<p><a href="colors.zip" target="frame">Download terminal colors python module</a></p>
<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
