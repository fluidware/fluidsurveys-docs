import json, requests
password = 'password'
api_key = 'ABCDDEFGHIJKLMNOPQRSTUVWXYZ'	#you can find your API key on the settings page
headers  = {"Content-Type": "application/json"}
URL = 'https://app.fluidsurveys.com/api/v2/'


#Create a contact
payload = {"name":"John Doe", 'email':"john_doe_1@example.com"}
r = requests.post(URL+'contacts/', data=json.dumps(payload), headers=headers, auth=(api_key, password))
result = json.loads(r.content)
contact_id = result['contact']['id']
print 'Created contact', contact_id


# Get Survey id - we are just grabbing the first survey for this example
r = requests.get(URL+'surveys/',auth=(api_key,password))
result = json.loads(r.content)
survey_id = result['surveys'][0]['id']
print 'Got Survey',survey_id


#Create an Email - the message MUST include the string '[Invite Link]'
payload = {"subject":"Hello",
			"message":"Hi, [Full Name], check out our survey: [Invite Link]!",
			"sender":"Bob <bob@example.com"
		  }
r = requests.post(URL+'emails/?survey=%d' % (survey_id,), data=json.dumps(payload), headers=headers, auth=(api_key,password))
result = json.loads(r.content)
send_uri = result['send_uri']
email_id = result['id']
recipients_uri = result['recipients_uri']
print 'Created email', email_id


#Add Contact to Email - note we are not sending this data as json, just a regular old POST.
payload = {"contacts":contact_id}
r = requests.post(recipients_uri, data='contacts=%d' % (contact_id,), auth=(api_key,password))
result = json.loads(r.content)
print 'Added contact:',result['added']

#Send The Email - note that because we are not sending any data we have to specify Content-Length:0
r = requests.post(send_uri, headers={"Content-Length": '0'}, auth=(api_key,password))
print r.content
result = json.loads(r.content)
print 'Email ',result['status'],'to',result['num_recipients'],'recipeints.'



























