#!/usr/bin/python
import cgi, os, sys, subprocess
sys.path.append("/home/johanadmin/CARL/")
import CARL_CORE

form = cgi.FieldStorage()

if "carl" in form:
    carl = form["carl"].value
else:
    carl = ""

if "user" in form:
    user = form["user"].value
else:
    user = ""

if "channelID" in form:
    channelID = form["channelID"].value
else:
    channelID = "0"

selected0=""
selected1=""
selected2=""
if channelID == "0": selected0=" selected"
if channelID == "1": selected1=" selected"
if channelID == "2": selected2=" selected"

def php(filename):
  proc = subprocess.Popen("php " + filename, shell=True, stdout=subprocess.PIPE)
  print proc.stdout.read()

def header():
  print """Content-type: text/html

"""
  php("header.php CARL")

def footer():
  php("footer.php")

carl2 = CARL_CORE.answer(carl, user, int(channelID))

header()
print '''<div style="font-size:50px"><form method="GET">
<select name="channelID">
<option value="0"'''+selected0+'''>default (profanity filter)</option>
<option value="1"'''+selected1+'''>E2 (no filter)</option>
<option value="2"'''+selected2+'''>movies (no memory of what you said)</option>
</select>
<br/>
'''
print "CARL:", carl, "<br/>"
print "YOU:", user, "<br/>"
print "CARL:", carl2, "<br/>"
print '''
YOU: <input type="text" name="user" autocomplete="off" style="height:75px">
<input type="hidden" name="carl" value="'''+carl2+'''"><br/>
<input type="submit" value="Talk">
</form></div>'''
footer()
