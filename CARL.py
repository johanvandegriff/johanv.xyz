#!/usr/bin/python
import cgi, os, sys
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

print '''Content-type: text/html
'''
sys.stdout.write(CARL_CORE.answer(carl, user, int(channelID)))
