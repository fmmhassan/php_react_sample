# About this App
This application was built using ReactJs for frontend and PHP for the backend APIs. This is about importing imaginary expenses report which are stored in various CSV files, which as a result provides a summary of each category expenses with their sum as a dashboard.
The summary results also can be exported as a CSV file.

# About the architecture

-Backend Application - PHP
    * Composer's autoload was used for bootstraping the application
    * PSR-4 was used for autoloading
    * All the routes are handled by route class, which then calls the necessary controller functions from there.
    * Not found Excepption is handled incase if a non-specified route is called.
    * Responses are handled via a response object
    * Helper file was used, where more of common functions can be added in here.
    * Use of .htaccess was made use here so all apache requests go via index.php
    * Credentials and other configurations were handles using config.php file for the backend process
    * The databse provider used for the project was MySQL
    * Contract abstraction were defined Contracts folder for the generated classes
    * PHP version steady with 7.4.21
    

-Frontend Application - React
    * Bootstrap library was used for designing, which ofcourse has a big part that could be improved at.
    * API Requests responses are handled in an appropriate manner inwhich both success and error responses are shown
    * Usage of environment variable was implemented for api base_url so that its not necesary to rename base_urls throughout all the functions within the system
    * Handled downloading of export using API call
    * Irrelevant functions comments or packages were removed in-which they were in-appropriate

-Common
    * The application was more likely built on MVC structure.

-Room for improvement
    There's more room for improvement on the application on both backend and frontend projects.
    -On the frontend part, the designs, use of state management, routers, menu/navigations, promises, authentication, validations etc could be implemented
    -On the backend, design patters such as Facade pattern, middlewares, test cases, validations, authorizations, authentications , environment variables, test cases, database migrations etc could be implemented


# Setting App environment with configuration variables
    * backend-services/config.php
        $servername -> <db_host_to_be_defined>
        $username -> <db_username_to_be_defined>
        $password -> <db_password_to_be_defined>
        $database -> <db_name_to_be_defined>
        $front_end_url -> <frontend_url_to_be_defined> <!-- this will be used to allow access for frontend app -->

    * frontend-app/.env
        REACT_APP_API_BASE_URL-><api_location_to_defined>

    * SET DB configuration/queries
        -Database configuration(use mysql).
        -Create a database of any name you prefer.
        -Run the below script for working with expenses data within the database:
            CREATE TABLE `expenses` (
            `id` int NOT NULL AUTO_INCREMENT,
            `category` varchar(255) DEFAULT NULL,
            `unit_price` double DEFAULT NULL,
            `qty` double DEFAULT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

    * * Note
    Configurations parameters that were used while development are already available, which can be changed according to the configurations available in your setup

# Running the projects with necessary commands
    # Run the below commands within backend project(backend-services)
        composer dump-autoload #will regenerates all that need to be included in the project
        php -S localhost:8000
    # Run the below commands within frontend project(frontend-app)
    npm install #install all npm packages listed in package.json
    npm start #starts the react project


# CSV Import template example
    the sample template can be found at OOP_PHP_REACT/test_sample.csv.
    more, different or various other items can be added to import according to given format
