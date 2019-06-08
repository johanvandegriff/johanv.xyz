#!/usr/bin/python
import os, re, subprocess
from distutils.version import StrictVersion

def php(filename):
  proc = subprocess.Popen("php " + filename, shell=True, stdout=subprocess.PIPE)
  print proc.stdout.read()

def header():
  print """Content-type: text/html

"""
  php("header.php 'Quest Game'")

def footer():
  php("footer.php")


QUEST_DIR = 'quest'

if not os.path.exists(QUEST_DIR):
  os.makedirs(QUEST_DIR)


files = os.listdir(QUEST_DIR)
versions = []
for file in files:
  try:
    version = re.search(r'quest-([\d]+\.[\d]+\.[\d]+)', file).group(1)
    versions.append(version)
  except:
    pass

versions.sort(key=StrictVersion, reverse=True)

version = ''
if len(versions) > 0:
  version = versions[0]

header()
print('''<h1>Quest v''' + version + '''</h1>
<p>This is a roguelike I am working on. It is written in Python, using the
curses module. Right now it runs fine on Linux, Unix, and Mac terminals, but
if you want to run it on Windows, you need Cygwin or Powershell.</p>
<h3>Downloads</h3>
<p>The most recent version:</p>'''
)

def printLink(version):
  file = ""
  for f in files:
    if re.search(version, f):
      file = f
  print '<li><a href="quest/' + file + '">Quest v' + version + '</a></li>'


printLink(version)

if len(versions) > 1:
  print('<p>Older versions:</p><ul>')
  for version in versions[1:]:
    printLink(version)

  print('</ul>')
else:
  print('<p>No older versions yet.</p>')

footer()
