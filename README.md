h1 Diploma work
***
The project is based on the task to the diploma project of the University of netology course PHP / SQL: back-end development and database (performed without additional task). This project allows users to view questions and answers by category and ask new questions. The administrator panel allows you to manage categories (add / remove) and questions for each category (view, edit, publish, delete). The full assignment is [here](https://netology-university.bitbucket.io/php/graduate-work/faq/index.html).
***
h2 Requirements
* PHP 7.1.3 or higher;
* PDO-SQLite PHP extension enabled.
***
h2 Install
    git clone https://github.com/EvaFlareon/PHP_Diploma_work.git
	cd PHP_Diploma_work
	composer install
	php artisan migrate
	php artisan db:seed
