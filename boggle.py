#!/usr/bin/python
import sys, cgi, pickle, datetime, re, os, time, decimal, subprocess
importpath = "/home/johanadmin/hst/" #this is to import the custom modules
sys.path.append(importpath)
import htmlmanager as html

#replace quotes
def rq(s):
  return cgi.escape(s).replace("'", "&apos;").replace('"', '&quot;')

#format
def f(s, *args):
  return s.format(*[rq(str(arg)) for arg in args])

def php(filename):
  proc = subprocess.Popen("php " + filename, shell=True, stdout=subprocess.PIPE)
  print proc.stdout.read()

def header():
  print """Content-type: text/html

"""
  php("header.php Boggle")

def footer():
  php("footer.php")

LOGIN = 0
LOBBY = 1
JOIN_GAME = 2
VIEW_GAME = 3
PLAY_GAME = 4
GAME_OVER = 5

ROOT_DIR = "/home/johanadmin/boggle"
GAMES_FILE = os.path.join(ROOT_DIR, "games")
GAME_DURATION = 3 * 60 * 1000 #3 minutes in milliseconds
formMethod = "get"

games = pickle.load(open(GAMES_FILE, 'r'))

form = cgi.FieldStorage()

if "action" in form:
  action = int(form["action"].value)
else:
  action = LOBBY

#print html.startPage("Action")
#print action

if not "username" in form:
  header()
#  print html.startPage("Boggle")
  print html.tag("h1", "Boggle")
  print html.tag("p", "Boggle is a word game with a grid of random letters. The goal is to find letters next to each other that form words. The game lasts 3 minutes and the person with the highest score (longer words are worth more) at the end wins.")
  print html.tag("h3", "Enter your nickname")
  print html.startForm(formMethod)
  print html.input("text", "username", "", isRequired=True)
  print html.input("submit", "", "Enter", isRequired=True)
  print html.hiddenInput("action", LOBBY)
  print html.endForm()
  footer()
#  print html.endPage()
  quit()

username = form["username"].value

def display(board, buttons):
  size = len(board)

  print '<h1><font color="black"><table style="background-color:black" bgcolor="black">'
  for i in range(size):
    print "<tr>"
    for j in range(size):
      letter = board[i][j]
      if letter == "Qu":
        space = ""
      else:
        space = "&nbsp;"
      if buttons == 1:
        #letter = '<a style="text-decoration : none; color : #000000;" href="javascript:type("' + letter.lower() + '")">' + letter + '</a>'
        letter = '<a style="text-decoration:none;color:#000000" href="javascript:type(\'' + letter.lower() + '\')">' + letter + '</a>'
      print '<td width="62" height="62" background="boggle_img/letter.bmp">&thinsp;' + space + letter + "</td>"
    print "</tr>"
  print "</table></font></h1>"


def calculatePoints(word):
  length = len(word)
  if length < 7:
    points = length - 3
  elif length == 7:
    points = 5
  else:
    points = 11
  if points < 1:
    points = 1;
  return points

if action == VIEW_GAME:
  header()
#  print html.startPage("Boggle Past Game")
  print html.tag("h1", "Boggle")
  print html.tag("h3", "Past Game")

  myGameID = 0
  username = ""
  if len(sys.argv) == 3:
    myGameID = sys.argv[1]
    username = sys.argv[2]
  else:
    myGameID = int(form["gameID"].value)
    username = form["username"].value

  myGame = []
  for game in games:
    gameID = game[0]
    if myGameID == gameID:
      break
  myGame = game

  board = myGame[5]

  size = myGame[2]
  size2 = int(size[0])

  players = myGame[7]
  playerWords = myGame[8]
  host = myGame[1][0]

  print '<a href="boggle.py?username=' + rq(username) + '">Back to Lobby</a>'
  print "<h4>Game hosted by " + rq(host)  + ".</h4>"
  print "<table cellpadding=10><tr><td>"
  display(board, 0)
  print "</td><td>"

  print """<table border=1 cellpadding=7>
<tr><td>Players:</td>"""

  for player in players:
    print '<td>' + rq(player) + '</td>'
  print '</tr><tr><td valign="top" style="vertical-align:top">Words:</td>'

  allPlayerWords = []
  for words in playerWords:
    print '<td valign="top" style="vertical-align:top">'
    words.sort()
    score = 0
    numwords = 0
    for word in words:
      allPlayerWords.append(word)
      points = calculatePoints(word)
      print ("%2d" %(points)), word, "<br>"
      score += points
      numwords += 1
    print "Word Count:  " + str(numwords) + "<br>"
    print "Total Score: " + str(score) + "<br>"
    print '</td>'


  print "</tr></table></td></tr></table>"


  print "<br>All possible words for this board:<br><br>"

  if(len(myGame) > 6):
    words = myGame[6]
    words.sort()
    found = 0
    total = len(words)
    score = 0
    numwords = 0
    for word in words:
      if word in allPlayerWords:
        print '<span style="color:green; font-weight:bold">'
        found += 1
      points = calculatePoints(word)
      print ("%2d" %(points)), word, "<br>"
      score += points
      numwords += 1
      if word in allPlayerWords:
        print "</span>"
    print "Word Count:  " + str(numwords) + "<br>"
    print "Total Score: " + str(score) + "<br>"
    percent = int(found*100.0/total+0.5)
    print str(percent) + "% of all these words were found."

  footer()
#  print html.endPage()




def lobby():
  print """Content-type: text/html

<!DOCTYPE html>
<html>
<head>
<script>
window.location = 'boggle.py?username=""" + username + """';
</script>
<link rel="stylesheet" type="text/css" href="../stylesheet.css" media="all"/>
</head>
</html>"""
  quit()

def play():
  print """Content-type: text/html

<!DOCTYPE html>
<html>
<head>
<script>
window.location = 'boggle.py?username=""" + username + "&action=" + JOIN_GAME + "&size=" + size + "&gameID=" + str(myGameID) + """';
</script>
<link rel="stylesheet" type="text/css" href="../stylesheet.css" media="all"/>
</head>
</html>"""
  quit()


if action == JOIN_GAME:
  myGame = []
  myGameID = 0
  size = ""
  if "gameID" in form:
    myGameID = int(form["gameID"].value)
    for game in games:
     gameID = game[0]
     if myGameID == gameID:
       myGame = game
       size = myGame[2]
       break
  else:
    size = form["size"].value
    myGameID = 0;
    while any(myGameID == game[0] for game in games):
      myGameID += 1
    myGame = [myGameID, [username], size, 0]
    games.append(myGame)

    file = "/home/johanadmin/boggle/saved_games/" + str(myGameID)
    size2 = int(size[0])
    if len(myGame) < 6:
      minWordLength = 4
      if size == "4x4":
        minWordLength = 3
      os.system("/home/johanadmin/boggle/create.py " + str(size2) + " " + file)
#      os.system("(/home/johanadmin/boggle/solve.py " + file + " &) > /dev/null")
      os.system("/home/johanadmin/boggle/solve.py " + file + " " + str(minWordLength))
      file_contents = pickle.load(open(file, 'r'))
      os.system("rm " + file)
      myGame.append(-1)
      for item in file_contents:
        myGame.append(item)
      myGame.append([])
      myGame.append([])
      pickle.dump(games, open(GAMES_FILE, 'w'))

  if myGame == []:
    action = LOBBY
#    lobby()

  players = myGame[1]
  host = players[0]
  if not myGame[3] == 0:
    if username in players:
      play()
    else:
      action = LOBBY
#      lobby()

  if not username in players:
    players.append(username)
    pickle.dump(games, open(GAMES_FILE, 'w'))

  minWordLength = "Four"
  if size == "4x4":
    minWordLength = "Three"
  header()
#  print " ""Content-type: text/html
#
#<!DOCTYPE html>
#<html>
#<head>
#<title>
#New Game
#</title>
#<link rel="stylesheet" type="text/css" href="../stylesheet.css" media="all"/>
#</head>
#<body>
  print """<h1>Boggle</h1><h4>New Game hosted by """ + rq(host) + ".<br><br>" + rq(size) + " Board, " + rq(minWordLength) + """ letter
words or more.</h4>
<p>Waiting for players...</p>
<form action="">
<input type="hidden" name="username" value='""" + username + """'>
<input type="hidden" name="size" value='""" + size + """'>
<input type="hidden" name="gameID" value='""" + str(myGameID) + """'>
<input type="hidden" name="action" value='""" + str(JOIN_GAME) + """'>
<input type="submit" value="Refresh">
</form>
<br>
<table border=1 cellpadding=7>
<tr><td>Players:</td></tr>"""

  for player in players:
    print '<tr><td>' + player + '</td></tr>'
  print "</table><br>"
  if username == host:
    print """<form action="">
<input type="hidden" name="username" value='""" + username + """'>
<input type="hidden" name="action" value='""" + str(PLAY_GAME) + """'>
<input type="hidden" name="size" value='""" + size + """'>
<input type="hidden" name="gameID" value='""" + str(myGameID) + """'>
<input value="Start Game" type="submit">
</form>"""
  else:
    print """<script>
setTimeout(function(){
   window.location.reload(1);
}, 3000);
</script>"""
  footer()
#  print "</body></html>"

if action == PLAY_GAME:
  size = form["size"].value
  myGameID = int(form["gameID"].value)

  myGame = []
  for game in games:
    gameID = game[0]
    if myGameID == gameID:
      break
  myGame = game

  if myGame[3] == 2:
    header()
    print """Content-type: text/html

<!DOCTYPE html>
<html>
<head>
<script>
window.location = 'lobby.py?username=""" + username + """';
</script>
<link rel="stylesheet" type="text/css" href="../stylesheet.css" media="all"/>
</head>
</html>"""
    quit()

  myGame[3] = 1

  players = myGame[1]
  host = players[0]

  if username == host and myGame[4] == -1:
    myGame[4] = time.time() * 1000

  pickle.dump(games, open(GAMES_FILE, 'w'))

  minWordLength = "Four"
  if size == "4x4":
    minWordLength = "Three"
  header()
#  print " ""Content-type: text/html
#
#<!DOCTYPE html>
#<html>
#<head>
#<title>
#Boggle Game
#</title>
#<link rel="stylesheet" type="text/css" href="../stylesheet.css" media="all"/>
#</head>
#<body>
  print """<h1>Boggle</h1><h4>Game hosted by """ + rq(host) + ".<br><br>" + size + " Board, " + minWordLength + """ letter
words or more.</h4>
<p>The game has started! Good luck, """ + rq(username) + '!</p><h4><p id="time"></p></h4>'
#"""

  board = myGame[5]
  display(board, 1)

#<a style="text-decoration:none;color:#000000" href="javascript:type(' ')">Space</a><br>
#<a style="text-decoration:none;color:#000000" href="javascript:backspace()">Backpace</a><br>

  print """<form action="" id="words" name="words">
<input type="hidden" name="action" value='""" + str(GAME_OVER) + """'>
<input type="hidden" name="username" value='""" + username + """'>
<input type="hidden" name="size" value='""" + size + """'>
<input type="hidden" name="gameID" value='""" + str(myGameID) + """'>

<h1><table cellpadding=13 cellspacing=3>
<tr><td background="boggle_img/space.bmp">
<a style="text-decoration:none;color:#000000" href="javascript:type(' ')">
Space</a></td>
<td background="boggle_img/backspace.bmp">
<a style="text-decoration:none;color:#000000" href="javascript:backspace()">
Backspace</a></td></tr></table></h1>

<textarea rows="20" cols="75" name="words" id="wordBox">
</textarea>
</form>
<script>
var startTime = """ + str(myGame[4]) + """;
var endTime = startTime + """ + str(GAME_DURATION) + """;

countDown();

function type(letter){
  document.getElementById("wordBox").value += letter;
}

function backspace(){
  var box = document.getElementById("wordBox").value.slice(0, -1);
//  box = box.slice(0, -1);
  document.getElementById("wordBox").value = box;
}

function countDown(){
  time = new Date().getTime();
  timeLeft = Math.ceil((endTime - time) / 1000);
  millis = timeLeft;
  minutes = Math.floor(millis / 60);
  seconds = millis % 60;
  if(minutes < 10){
    minutes = "0" + minutes;
  }
  if(seconds < 10){
    seconds = "0" + seconds;
  }
  document.getElementById("time").innerHTML = minutes + ":" + seconds;
  if(millis <= 0){
    clearTimeout(timer);
    document.getElementById("time").innerHTML = "Time's up!";
    document.forms.words.submit();
  }
  var timer = setTimeout("countDown()", 1000);
}
</script>"""
  footer()
#</body>
#</html>"" "

if action == GAME_OVER:
  size = form["size"].value
  myGameID = int(form["gameID"].value)
  if "words" in form:
    wordBox = form["words"].value.lower()
    words = re.split("\s|\n|,", wordBox)
  else:
    words = []

  myGame = []
  for game in games:
    gameID = game[0]
    if myGameID == gameID:
      break
  myGame = game

  myGame[3] = 2

  file = "/home/johanadmin/boggle/saved_games/" + str(gameID)
  size2 = int(size[0])

  players = myGame[1]
  host = players[0]

  if not username in myGame[7]:
    allWords = myGame[6]
    validWords = []
    for word in words:
      if word in allWords and not word in validWords:
        validWords.append(word)
    myGame[7].append(username)
    myGame[8].append(validWords)
  pickle.dump(games, open(GAMES_FILE, 'w'))

  header()
#  print " ""Content-type: text/html
#
#<!DOCTYPE html>
#<html>
#<head>
#<title>
#Game Over
#</title>
#<link rel="stylesheet" type="text/css" href="../stylesheet.css" media="all"/>
#</head>
#<body>
  print """<script>
function redirect() {
  window.location = 'boggle.py?action=""" + str(VIEW_GAME) + "&gameID=" + str(gameID) + "&username=" + username + """';
}
setTimeout(redirect, 5000);
</script>
<h2>
Redirect in 5 seconds...
</h2>"""
  footer()
#<body>
#</html>"" "

if action == LOBBY:
  lobbyStartTime = time.time()
  header()
#  print html.startPage("Boggle Lobby",
#  '<script type="text/javascript" src="sorttable.js"></script>')
  print '<script type="text/javascript" src="sorttable.js"></script>'

  print html.tag("h1", "Boggle Lobby")
  print html.tag("p", "Welcome, " + username + "!")
  print html.startForm(formMethod)
  print html.hiddenInput("username", username)
  print html.hiddenInput("action", LOBBY)
  print html.hiddenInput("skip", True)
  print html.input("submit", "", "Refresh", isRequired=True)
  print html.endForm()
  print html.br()
  print html.tag("p", "You can join one of these games:")
  print html.startForm(formMethod)
  print html.hiddenInput("action", JOIN_GAME)
  print html.hiddenInput("username", username)

  rows = []

  disabled = "disabled "
  checked = "checked "
  for game in games:
    state = game[3]
    if state == 0:
      gameID = game[0]
      host = game[1][0]
      size = game[2]
      players = len(game[1])
      if checked == "checked ":
        rows.append(["Select", "Host", "Size", "Players"])
      rows.append(['<input type="radio" ' + checked  + 'name="gameID" value="' + str(gameID) + '">',
                                 host, size, str(players)])
      checked = ""
      disabled = ""
  if disabled == "disabled ":
    print html.tag("p", html.tag("b", "No games are waiting for players."))
  else:
    print html.table(rows, [["border", 1], ["cellpadding", 7],
                          ["id", "waiting"], ["class", "sortable"]])

  print html.br()
  print '<input value="Join Game" type="submit" ' + disabled + '>'
  print html.endForm()
  print html.br(2)
  print html.tag("p", "Or you can create a new game:")
  print html.startForm(formMethod)
  print html.hiddenInput("action", JOIN_GAME)
  print html.hiddenInput("username", username)
  print """<select name="size">
<option>5x5</option>
<option>4x4</option>
</select>"""
  print '<input value="Create Game" type="submit" id="create">'
  print html.endForm()
  print html.br()
  print html.tag("p", "Games in progress:")

  any = 0
  for game in games:
    state = game[3]
    startTime = game[4]
    if state == 1 and time.time() * 1000 > startTime + GAME_DURATION:
      game[3] = 2
      any = 1
  if any == 1:
    pickle.dump(games, open(GAMES_FILE, 'w'))

  rows = []

  any = 0
  for game in games:
    state = game[3]
    if state == 1:
      gameID = game[0]
      host = game[1][0]
      size = game[2]
      players = len(game[1])
      if any == 0:
        rows.append(["Host", "Size", "Players"])
      rows.append([host, size, str(players)])
      any = 1
  if any == 0:
    print html.tag("p", html.tag("b", "No games are in progress."))
  else:
    print html.table(rows, [["border", 1], ["cellpadding", 7],
                          ["id", "playing"], ["class", "sortable"]])
  print html.br(2)
  print html.tag("p", "Games that are over:")
  print html.tag("p", "Click on a column to sort by that column")

  rows = []
  rows.append(["Game #", "Host", "Size", "Players", "Total # of Words", "# of Words Found", "% of Words Found"])

  length = len(games)
  for i in range(length-1, -1, -1):
    game = games[i]
    state = game[3]
    if state == 2:
      gameID = game[0]
      host = game[1][0]
      size = game[2]
      players = len(game[1])
      allWords = game[6]
      allPlayerWords = []
      allPlayerWordLists = game[8]
      found = 0
      for playerWords in allPlayerWordLists:
        for word in playerWords:
          if not word in allPlayerWords:
            allPlayerWords.append(word)
            found += 1
      percent = int(found*10000.0/len(allWords)+0.5)/100.0
      percentStr = str(decimal.Decimal(percent).quantize(decimal.Decimal('0.01')))+"%"
      rows.append(['<a href="boggle.py?gameID=' + str(gameID) + '&username=' + username + '&action=' + str(VIEW_GAME) + '">' + str(gameID) + '</a>', host,
                   size, str(players), str(len(allWords)), str(found), percentStr])
  print html.table(rows, [["border", 1], ["cellpadding", 7],
                          ["id", "over"], ["class", "sortable"]])
  print html.tag("p", "It took " + str(time.time() - lobbyStartTime) + " seconds to load the lobby.")
  footer()
#  print html.endPage()
