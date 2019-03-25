# MED IT EASY ("made" it easy)
* [General info](#general-info)
* [Technologies](#technologies)
* [Features](#features)
* [Setup](#setup)

## General info
This project aims to facilitate the management of appointments between patients and doctors.
	
## Technologies
Project is created with:
#### Javascript:
* JQuery: 3.3.1
* Moment: 2.22.2
* TempusDominus-bootstrap-4: 5.0.1
* FullCalendar: 3.4.0
* JQuery cookies
* Personnal files: app/public/js/script.js & app/public/js/agenda.js

#### CSS:
* FontAwesome: 4.7.0
* BootStrap: 4.2.1
* Personnal files: app/public/css/style.css
* CSS is compiled using SASS (app/public/scss/style.scss)

## Features
### As user
You can navigate freely on the site, you can create an account as a patient or doctor.
### Once an account is created as a patient
* You will receive an email (Confirm link has to be worked out)
* You can make an appointment, by choosing a type of consultation, the date and time chosen
* List all your scheduled appointments
* Update your information (email and password)
* Delete your account.
### Once your account is created as a doctor
* You can see on a calendar the patients who have made an appointment with you, with the type of consultation (and its associated color code), and the desired date and time
* List all your patients
* Delete your account.

### TO Do:
* Add more content on the pages, especially on the homepage, a list of rates applied by this doctor depending on the type of consultation, a list of the hours applied by this doctor and the possibility of updating his account.
The ability to update, delete and move appointments from the doctor's calendar is also under consideration.


## Setup
To run this project, install it locally using npm:

```
$ cd ../lorem
$ npm install jquery moment fullcalendar
$ npm start
```