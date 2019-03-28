# MED IT EASY ("made" it easy)
* [General info](#general-info)
* [Technologies](#technologies)
* [Features](#features)
* [Setup](#setup)
* [To do](#to-do)

## General info
This project aims to To connect the Doctors and Patients in order to relieve the workload of the Doctor at the secretarial level (booking management, follow-up ..) and facilitate appointment's booking for patients, via a simple form (SPEECH To TEXT to study).
	
## Technologies
Project is created with:
#### Javascript:
* JQuery: 3.3.1
* Moment: 2.22.2
* TempusDominus-bootstrap-4: 5.0.1
* FullCalendar: 3.4.0
* JQuery cookies: 1.3.1
* Personnal files: app/public/js/script.js & app/public/js/agenda.js

#### CSS:
* FontAwesome: 4.7.0
* BootStrap: 4.2.1
* Personnal files: app/public/css/style.css
* CSS is compiled using SASS (app/public/scss/style.scss)

### Common
* MailDev (for local use: on terminal -> write 'maildev' then in your browser's url input write 'localhost:1080') to receive email once your account his created (later: once patient's appointment is booked)
* (later: switch Maildev to PHPMailer)

## Features
### As user
You can navigate freely on the site, you can create an account as a patient or doctor.
### As Patient
You can : 
* visit the site
* register
* login
* book an appointment
* cancel an appointment (later version)
* update email and/or password
* delete your account

### As Doctor
You can :
* visit the site
* register
* login
* display patient(s) list (later : it'll be possible to access patient informations such as booked appointments...)
* follow-up of consultations via the calendar with type of acte, scheduled time/hour and patient First and Last name
* update a given appointment : to change scheduled date/time and sending an email to this patient with updated appointment
* delete your account

### The site is composed of these different modules
* Registration module: 
This module must allow users (Patients / Doctors) to register independently through the website.

* Log in module:
Allow both Patient/Doctor the ability to log in with informations given in registration form

* Account Management Module: 
This module allows each member to manage his or her user account. It will be possible to modify personal information or preferences (patient side) and to manage the planned consultations, and the patient (doctor side).

* Appointment module: 
This module allows each logged in patient to make an appointment (consultation) via his user account. The desired time and date, the type of consultation (a confirmation email will be sent to the patient who made an appointment). The patient's contact details as well as his choices during the appointment-making module will be found in the agenda corresponding to the doctor bound to "this" patient.

* Administration module: 
This module allows each doctor to be able to see the follow-up of his patients (via a calendar), to cancel / edit an appointment(s). It will then be possible to create free time slots (appointment of "emergency" type, to give the doctor free time range so patient can't book on "this" hour).

### The different classes of users of the system are as follows
* Administrator: 
Only the administrator has access to the complete system information. He can do the complete management of the system, for example, create accounts. It is also possible for him to suspend any account.
 
* Patients: 
Patients can feed the system by appointment (consultation), they will have an interesting database in the system.

* Doctors: Doctors are the ones who benefit the most from the system. They can have access to a whole range of information (agenda, rates, type of consultation, Patient details ...). (A research system will be integrated in the longer term in order to consult the file of a Patient (medical history, allergies ...) A listing of his patient is integrated in the main page of the Doctor.

### Once an account is created as a patient
* You will receive an email (Confirm link has to be worked out)
* You can make an appointment, by choosing a type of consultation, the date and time chosen
* List all your scheduled appointments
* Update your information (email and password)
* Delete your account.
### Once an account is created as a doctor
* You can see on a calendar the patients who have made an appointment with you, with the type of consultation (and its associated color code), and the desired date and time
* List all your patients
* Delete your account and reset the patient's doctor having the deleted ID, so once doctor's account is deleted, the patient has to choose a new doctor once patient is connected.

### TO DO:
* Add more content on the pages, especially on the homepage, a list of rates applied by this doctor depending on the type of consultation, a list of the hours applied by this doctor and the possibility of updating his account.
The ability to update, delete and move appointments from the doctor's calendar is also under consideration.


## Setup
To run this project, install it locally using npm:

```
$ npm install --save composer
_$ composer require phpmailer/phpmailer_
$ npm install jquery moment fullcalendar
$ npm install maildev
$ maildev
```
