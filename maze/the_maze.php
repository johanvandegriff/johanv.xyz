<?php $pageName = "Maze"; include '../header.php'; ?>

<h2>The Maze</h2>

<img src="door.jpg" alt="door">

<br>

This part of the website is a maze. This maze is like a room with doors, where only one of the doors leads to another room with doors. It keeps going until the final room with one door, and that door is the exit of the maze.<br>

<br>

<form action="showmaze.pl">

Choose how many doors per room:

<select name="doors">

<option>3</option>

<option>4</option>

<option>5</option>

<option>6</option>

<option>7</option>

<option>8</option>

<option>9</option>

<option>10</option>

</select>

<br>

Choose how many rooms per maze:

<select name="rooms">

<option>3</option>

<option>4</option>

<option>5</option>

<option>6</option>

<option>7</option>

<option>8</option>

<option>9</option>

<option>10</option>

</select>

<br>

<input value="Start" type="submit"></form>

<?php include '../footer.php'; ?>
