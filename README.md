On the main page there are two fields and a button:
Field #1 - Name
Field #2 - Email
Button - Submit

Both fields are mandatory. If one of the fields is not filled in and the form is submitted the error is returned:

"You haven't entered your name"
or "You haven't entered your email address"

If the email is not in the correct format (x@x.x) then the error is returned

"Please check your email address"

If everything is fine the form is processed.

When form is processed a new row is created in the MySQL dabatabse.

Table structure:

ID
Name
Email

The ID start from 1

When form is processed a person is taken success.php page where the message is printed:

"Success! Your ID is: X"

Upon submission of form we need to check whether the email address is not already in use. If it's in use we print the error:

"This email address is already taken! The ID is: X" - and we return the ID for that email address

