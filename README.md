# WebGIS Penyebaran COVID-19 in Indonesia

## Introduction

This is a WebGIS application that provides information about the spread of COVID-19 in Indonesia. This project is built for learning GIS (Geographic Information System) in a web app.  The system is built using Laravel for the backend and Bootstrap for the frontend, and it aims to demonstrate the implementation of GIS (Geographic Information System) in visualizing COVID-19 data on a map.

## Features

### 1. Login

- Admin Login: Authorized users with administrative privileges can log in to access the backend functionalities.
- Public Login: General users can log in to view the map and COVID-19 data without administrative privileges.

### 2. Register

- Users can register to access the public features of the WebGIS application.

### 3. CRUD (Create, Read, Update, Delete) - Map Point Location

- Admin users can add, view, update, and delete map point locations on the map. These locations represent specific areas or incidents related to COVID-19 in Indonesia.

### 4. Map View

- The map view displays a map of Indonesia with polygons representing each province's boundary.
- When clicking on a province, a modal will show detailed COVID-19 information for that province, such as the number of cases, deaths, and recoveries.

## Technologies Used
- PHP Version: 7.2
- Laravel: The PHP framework used for backend development, handling authentication, and database operations. (Version 7)
- Leaflet.js: The JavaScript library used for frontend map visualization and interaction.
- MySQL: The database management system used to store COVID-19 data and user information.

## Installation

1. Clone the repository: `git clone https://github.com/your-username/webgis-covid19.git`
2. Install dependencies: `composer install && npm install`
3. Set up the database: Create a MySQL database.
4. create a new `.env` file and setup with your database credentials.
5. Start the development server: `php artisan serve`.

## Usage

1. Access the WebGIS application in your browser by visiting `http://localhost:8000`.
2. Login with your admin or public credentials to access the respective features.
3. Explore the map to view COVID-19 data for each province, and click on a province to see detailed information in the modal.

## Contribution

Contributions are welcome! If you find any issues or have suggestions for improvement, please feel free to submit a pull request. also, feel free to fork it for any purpose.

## License

This project is licensed under the [MIT License](LICENSE). You are free to use and modify the code as per the terms of the license.
