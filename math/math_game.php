<?php $pageName = "Math"; include '../header.php'; ?>

<h2>

The Math Game

</h2>

<p>

This game makes addition and subtration math problems, and after you do them, it gives you your score.

</p>

<p>

To adust the difficulty of the game, you can change the maximum and the minimum value of the numbers to be subtracted or added. You can also change the number of questions below.

</p>

<p>

Do not enter text in the answer boxes.

</p>

<form action="math_game.pl">

What do you want the minimum value of the numbers to be subtracted or added to be?

<select name="min">

<option selected="selected">1</option>

<option>2</option>

<option>3</option>

<option>4</option>

<option>5</option>

<option>6</option>

<option>7</option>

<option>8</option>

<option>9</option>

<option>10</option>

<option>11</option>

<option>12</option>

<option>13</option>

<option>14</option>

<option>15</option>

<option>16</option>

<option>17</option>

<option>18</option>

<option>19</option>

<option>20</option>

<option>21</option>

<option>22</option>

<option>23</option>

<option>24</option>

<option>25</option>

<option>26</option>

<option>27</option>

<option>28</option>

<option>29</option>

<option>30</option>

<option>31</option>

<option>32</option>

<option>33</option>

<option>34</option>

<option>35</option>

<option>36</option>

<option>37</option>

<option>38</option>

<option>39</option>

<option>40</option>

<option>41</option>

<option>42</option>

<option>43</option>

<option>44</option>

<option>45</option>

<option>46</option>

<option>47</option>

<option>48</option>

<option>49</option>

<option>50</option>

</select>

<br>

The maximum will be 

<select name="max">

<option>1</option>

<option>2</option>

<option>3</option>

<option>4</option>

<option>5</option>

<option>6</option>

<option>7</option>

<option>8</option>

<option>9</option>

<option selected="selected">10</option>

<option>11</option>

<option>12</option>

<option>13</option>

<option>14</option>

<option>15</option>

<option>16</option>

<option>17</option>

<option>18</option>

<option>19</option>

<option>20</option>

</select>

more than the minimum.

<br>

<br>

How many questions do you want?

<select name="questions">

<option>1</option>

<option>2</option>

<option>3</option>

<option>4</option>

<option>5</option>

<option>6</option>

<option>7</option>

<option>8</option>

<option>9</option>

<option>10</option>

<option>11</option>

<option>12</option>

<option>13</option>

<option>14</option>

<option selected="selected">15</option>

<option>16</option>

<option>17</option>

<option>18</option>

<option>19</option>

<option>20</option>

<option>21</option>

<option>22</option>

<option>23</option>

<option>24</option>

<option>25</option>

<option>26</option>

<option>27</option>

<option>28</option>

<option>29</option>

<option>30</option>

<option>31</option>

<option>32</option>

<option>33</option>

<option>34</option>

<option>35</option>

<option>36</option>

<option>37</option>

<option>38</option>

<option>39</option>

<option>40</option>

<option>41</option>

<option>42</option>

<option>43</option>

<option>44</option>

<option>45</option>

<option>46</option>

<option>47</option>

<option>48</option>

<option>49</option>

<option>50</option>

</select>

<br>

<br>

<input value="Start" type="submit">

</form>

</body>

</html>

<?php include '../footer.php'; ?>
