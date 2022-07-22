# php-rest-api
This is an API that perform data-upload and endpoint to read the uploaded data in JSON, witten in PHP 8.1 & MySQL REST API. 

## PHP ENDPOINT
* `GET - http://localhost/api/v1/currency/read` Fetch ALL currency Records without pargination
* `GET - http://localhost/api/v1/currency/read/{page_number}` Fetch ALL Currency Records parginated
* `POST - localhost/api/v1/currency/upload` Accepts CSV file (currency list)
* `GET - http://localhost/api/v1/country/read` Fetch ALL country Records without pargination
* `GET - http://localhost/api/v1/country/read/{page_number}` Fetch ALL country Records parginated
* `POST - localhost/api/v1/country/upload` Accepts CSV file (country list)

## FOLDER STRUCTURE
- api
    - v1
        - class
            - Country.php (Country class, interface with the DB for country data manipulation)
            - Currency.php (Currency class, interface with the DB for currency data manipulation)
            - Upload.php (Upload Class, Handles file upload)
        - config
            - database.php (Database connection class and files)
        - core
            - constant.php (Contains Define Constants for the API)
            - sql.sql (Database query for table creation)
        - country
            - index.php (handles routing and calls essential methods, load essential files and perfom necessary validation country activites)
            - read.php (interface with country class and passes data to and from the class)
            - upload.php (interface and data communication to upload class)
        - currency
            - index.php (handles routing and calls essential methods, load essential files and perfom necessary validation for currency activities)
            - read.php (interface with currency class and passes data to and from the class)
            - upload.php (interface and communicate data to upload class)
        - uploads (contains all the uploaded files)
        index.php (Handles general routing and dispatching)


## Installation
- create database change the name from the constant.php file in core folder
- change the base_url to your root folder name
- run the sql query to create the database table
- lunch you application and test in postman or order api-testing that support file upload


Thanks
Ibrahim A.

            


