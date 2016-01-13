#!/usr/bin/env python
import requests
import sys

usr = 'usuario'
pwd = 'password'
url = 'http://dominio.jira/rest/api/latest/issue/'+sys.argv[1]+'/worklog'
r = requests.post(url, auth=(usr, pwd), json={ "comment": sys.argv[3], "timeSpent":sys.argv[2] })
print r.status_code
