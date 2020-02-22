# back-test

content:
the .sql file contains the db solution I propuse, there are 3 table: person, email, phone, I think this is a good option to be possible to 
save mutliple email and phone for the same person. 


calls:

using get:
http://test-api-back.herokuapp.com/api/contact/read.php  -->show a list of all the registered contacts

using post:
all post request need a json as a enter parameters, I'll be providing the call and the data input for each one of the calls

http://test-api-back.herokuapp.com/api/contact/create.php  --> add a new contact
{
	"first_name" : "hector",
	"surnames" : "rojas"
}

http://test-api-back.herokuapp.com/api/contact/addPhone.php  --> add a new phone and associate the new phone to the user

{
	"person_id" : "1",
	"phone" : "444444"
}

http://test-api-back.herokuapp.com/api/contact/addEmail.php  --> add a new email and associate the new email to the user

{
	"person_id" : "1",
	"email" : "mail@gmail.com"
}

http://test-api-back.herokuapp.com/api/contact/update.php  --> updates the contanct info, it is necesary to give an id to be able to do
it 
{
  "id": "1",
	"first_name" : "hector",
	"surnames" : "rojas"
}

http://test-api-back.herokuapp.com/api/contact/updateEmail.php  --> this call update the email found by the id on the email table,
not in the person_id
{
  "id": "1",
	"email" : "new@gmail.com"
}

http://test-api-back.herokuapp.com/api/contact/updatePhone.php  --> this call update the phone found by the id on the phone table,
not in the person_id
{
  "id": "1",
	"phone" : "333232"
}


http://test-api-back.herokuapp.com/api/contact/delete.php  --> deletes the person found by the id given
{
  "id": "1"
}
