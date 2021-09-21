# divido

Developed this application using Codeigniter 3.0 version.

To run the aplication we must need Apache server installed. I used **WAMP64** Apache server to build and execute this application.
In WAMP64, please copy the given folder into **www** directory and keep the **.htaccess** file as it is.

Note: Placed the _fixture_ folder inside the divido app directory.

Now the application is ready to run. Start WAMP server and type **_http://127.0.0.1/divido/_** or _**http://{domain name}/divido/**_
The application will open screen where you can give configuration key or Section and system will return its value.

I used 2 approaches to complete this code, one is using PHP and another method by using JavaScript.

Approach 1 can handle .csv, .txt, .json files but Approach 2 can handle only .json files.
Both Approaches will show list of invalid files from the _fixture_ directory.

Approach 1 URL - **_http://127.0.0.1/divido/_**

Approach 2 URL - **_http://127.0.0.1/divido/FileOperation/method2/_**
