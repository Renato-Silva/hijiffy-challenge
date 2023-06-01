# Challenge!


## How to run
- Place the dialogflow_credentials.json inside the /storage/dialogflow folder
- Copy .env.copy to .env and fill the following variables 
	> DIALOGFLOW_PROJECT_ID=hijiffy-123456

    > DIALOGFLOW_KEY_FILE=hijiffy-123456-AAAAAAAAA.json
- Install dependencies
	> composer install
- Fire up Docker, in the project directory run
	> vendor/bin/sail up -d
- Run migrations and seed the database with a test user
	> vendor/bin/sail php artisan migrate --seed
	
	If you have trouble with permissions run on your host machine
	> sudo chmod o+w ./storage/ -R
    
	> sudo chmod o+w ./bootstrap/ -R
	
	Credentials for the test user are: 
		- **johndoe@mail.com** 
		- **password**
- On the frontend repository just run
	> npm install
	> npm run dev
	
- Access the chat UI here: [http://localhost:5173](http://localhost:5173)

### Other
- Run tests
	> vendor/bin/sail php artisan test
- On the project root there's a Postman collection with the API endpoints
	> Hijiffy.postman_collection.json
