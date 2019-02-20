<p align="center"><img src="https://arogfaeit.gq/public/images/logo.png"></p>


## About Alogfaeit

We designed and developed a representation of Geospatial festivals and events in Thailandusing Laravel Framework, a tool which has a MVC(Model-View-Controller) structure.  The  eventsinformation can  be  represented  in Geographic Information System (GIS)and we also identifythe  location  of  the  events with  Geolocation. The MediaWiki  Action  API,  a  web  servicewhich isprovided  in  Wikipedia was  used  to aggregate the text content for the description of the events.


## Demo

* **[Live Demo](https://arogfaeit.gq/)**
* Admin : admin@admin.com / admin
* Approver : approver@approver.com / approver
* User : user@user.com / user
* Pswd : 123321

## Installation

* Run `git clone https://github.com/oxideclop/arogfaeit.git projectname`
* Run `composer install` or `php composer.phar install`
* Create `.env`in application root `cp .env.example .env`
* Create a database and optional inform *.env*
* Run `php artisan key:generate` to generate key
* Run `php artisan migrate --seed` to install the database & required data
* Run `php artisan serve` to start the app on http://localhost:8000/

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
