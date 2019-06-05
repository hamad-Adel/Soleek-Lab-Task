## About Repository

This Repository is about building simple API with laravel framework it consists of 3 endpoint as following:

1- endpoint: http://127.0.0.1:8000/api/auth/register  Method: POST
	
	headers['accept'=>'appliction/json', 'Content-type'=>'applications/json']
	
	parameters: name, email, password

2- endpoint: http://127.0.0.1:8000/api/auth/login  Method: POST
	
	headers['accept'=>'appliction/json', 'Content-type'=>'applications/json']
	
	parameters: email, password

3- endpoint: http://127.0.0.1:8000/api/home  Method: GET
	
	headers['accept'=>'appliction/json', 'Content-type'=>'applications/json', Authorization which holds the token_type and access_token]
	
	parameters: JWT token
