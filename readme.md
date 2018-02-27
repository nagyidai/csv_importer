# CSV Importer

This project is a Docker container of a Laravel application that imports values from a CSV file to database.


### Prerequisites

Docker is required to run this project - https://www.docker.com/get-docker

### Installing

Download the repository to your local folder.


Run Composer (on Windows):

<code>docker run --rm -v ${PWD}:/app composer update</code>


To start docker:

<code>docker-compose up</code>

To create the database:
<code>docker-compose exec app php artisan migrate</code>


Go to <a href="http://localhost:8080/">http://localhost:8080/</a> in your browser.

Upload a file - as an example you can use <b>stock.csv</b>


## Running the tests

<code>docker-compose exec app ./vendor/bin/phpunit</code>


