# Uniq Project

Welcome to the Uniq project! This document serves as a comprehensive guide to help you understand, install, and use the project effectively.

## Table of Contents
- [Project Overview](#project-overview)
- [Project Stack](#project-stack)
- [Installation](#installation)
    - [With Docker](#with-docker)
- [How to Use the Project](#how-to-use-the-project)
- [Functionality](#Functionality)
- [Running Tests](#running-tests)
- [Technical Aspects](#technical-aspects)
- [Missing parts](#Missing-parts)
- [Modular Architecture](#modular-architecture)
- [Documentation](#Documentation)
- [Tests](#tests)
- [Contact](#contact)

## Project Overview
**Uniq** is a collaborative platform designed for users to manage their events. It allows a user to save calendar events with optional recurring pattern and list them.

## Project Stack
### PHP 8.3
A popular general-purpose scripting language that is especially suited to web development. It is fast, flexible, and pragmatic.

### Laravel 11
A web application framework with expressive, elegant syntax. Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality.

### MySQL
An open-source relational database management system. It is a central component of the LAMP web application software stack.

### Docker
Docker provides a way to run applications securely isolated in a container, packaged with all its dependencies and libraries. For those preferring a Docker-based environment, Laravel Sail is an optional tool that offers a simple command-line interface for interacting with Laravel's default Docker development environment.

## Installation
### **With Docker**
1. Clone the repository.
2. `cd <project directory>`
3. Run the following command:
`docker-compose up -d`
4. **Important Note:** After running containers, please wait for couple of minutes, or check your container to see when composer install, migrations, seeds are done. Then, you are good to go. For the first setup, it normally takes 3 to 8 minutes, depending on your computer and network speeds.

## How to Use the Project
You can start using the project by sending REST request:
<br>`GET - localhost/api/calendar-event`
<br>`POST - localhost/api/calendar-event`
<br>`PUT - localhost/api/calendar-event/{id}`
<br>`Delete - localhost/api/calendar-event/{id}`
<br>you can use following JSON RAW to create and update:
<br>`{
"title":"test",
"start":"2027-04-16",
"end":"2027-04-16",
"description":"describe",
"recurring":true,
"frequency":"daily",
"repeat_until":"2027-04-18"
}`

<br>please check `PUBLIC/swagger.yml` to find swagger document.

## Functionality
In this project as it was on my decision, I decided to only cover Dates, so that you can create an event for the given date(Whole day)

<br>Conditions:
<br>if user wants to add new event in same day, user will get error.
<br>if user wants to add recurring options, for daily, the Start and End date must be in same date, so that I will add that event till the given 'repeat_until'. this is same for weekly/Monthly/Yearly. for example if user wants to have weekly repeated, I will get give weekdays, and repeat it throw other weeks.
<br>if user try to add another event which even one of given events get conflict by other events (included recurring ones) he/she will get appropriate error validation.
<br>to update an event, I used the simples way of updating which is (delete/create) for Calendar Events.(might not be the best solution, but the fastest for my time limitation)

## Running Tests
You can run tests by using this command:
`docker-compose exec app php artisan test`

## Technical Aspects
Please note that the project was written in three days and will have some issues. To me, it's a 70% good project. 

## SOLID
I tried to follow SOLID/KISS as much as possible, you can check that I used single action classes for my services, means they only do one task(Single Responsibility),
<br>for Interface segregation, you can see that I always create Interface before I start writing a service.
<br>for Dependency Inversion, you can easily change/add new implementation to any classes in my project, my classes are not depend on each other

## Modular Architecture
Please check the `app/Modules/CalendarEvent` directory to see all the codes. I wrote it in a modular way to have everything in one place, making the project expandable. The manipulation of it is focused, and each team can work on one module. Also, if needed, we can easily extract each module into a separate microservice.

## Application Layers
In this application, I used four different layers: Controllers, Services, and Repositories. Although I could have used Actions Layer, I decided not to because it might looks more complicate(following KISS).In my module each layer interacts with the others, making it easily manageable. This separation ensures that the logic representing business processes is distinct from the representation layer and database layer.
You can check resources directories to find :
<br> Resources and Collections for presentation layer
<br> All logics in Services directory
<br> All necessary queries in Repositories
<br> All validations in Requests directory

## Missing parts
    - Didn't support hours in the project functionlity
    - In this project I haven't used dictionaries, so all my texts/messages are hard coded which is missed.
    - I tried to use configs in project (Atleast for pagination size which I put it in .env) but I should have covered more.
    - I haven't used CONSTs in the project. there were some cases that I could used
    - Functional tests were missed In the project
    - Unit tests are not covering edge cases

## Documentation
I used OpenAPI to document everything, you can check all annotations in top of my controller/resources/requests classes.

### Dependency Injection
I used Dependency Injection as much as I could (I might have missed some cases) but I believe its covering most of the services. Most classes will be auto-wired by Laravel, but to be sure, I added providers for most of them. In some cases, I needed to use instant binding so my workflow would have access to that through the container.

## Tests
I tried to use Test-Driven Development (TDD) as much as I could. The test coverage might not be full, but I tried to cover as much as I had time for.

## Contact
Feel free to contact me if you had any issues running the project at mhmd_nzri@yahoo.com.
