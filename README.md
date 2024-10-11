# FACTQUEST

**FACTQUEST** is an interactive platform that allows users to post facts or news items along with a source URL. Other users can then vote on the authenticity of the posted items by marking them as either "True" or "False." This platform fosters community-driven verification and validation of information.

## Website Screenshots

![Screenshot 2024-08-24 173646](https://github.com/user-attachments/assets/594f4e30-a91d-4964-a21a-62a54d28a524)

![Screenshot 2024-08-24 173955](https://github.com/user-attachments/assets/b23bc45e-2557-4e91-9aa9-3d8ddcdcb688)

## Table of Contents

1. [Technology Overview](#technology-overview)
   - [Front End](#front-end)
   - [Back End](#back-end)
2. [Features](#features)
3. [Installation Requirements](#installation-requirements)
4. [Installation Steps](#installation-steps)
5. [Live Demo](#live-demo)

## Technology Overview

### Front End

- **HTML:** Used for structuring the content on the web. The pages are created and saved as web documents.
- **Tailwind CSS:** A utility-first CSS framework that allows for rapid UI development with predefined classes.
- **JavaScript:** A programming language used to make web pages interactive. It is commonly used with web browsers to create dynamic and interactive experiences.

### Back End

- **PHP (Hypertext Preprocessor):** A server-side scripting language used to create dynamic and interactive web pages. PHP processes the server-side logic, interacts with the database, and renders the necessary content to the client.
- **MySQL:** An open-source relational database management system used to store and manage the data for the application.

## Features

### 1. User Authentication
- **Secure Registration and Login**: Users can securely register and log in to their accounts.
- **Password Recovery and Update**: Provides functionality for password recovery and updates.

### 2. Idea Submission
- **Submit Fact**: Users can submit their fact with source.

### 3. Idea Exploration
- **Browse Fact**: Users can explore a list of submitted facts.

### 4. Voting System
- **Vote on Facts**: Users can vote on ideas they find compelling.

### 5. Responsive Design
- **Mobile-Friendly**: The interface is designed to be mobile-friendly.
- **Consistent UX**: Ensures a consistent user experience across different devices.

### 6. Interactive UI
- **Modern Interface**: Features a modern and intuitive user interface.
- **Tailwind CSS**: Utilizes Tailwind CSS for a sleek and responsive design.


### 7. Performance
- **Fast Loading Times**: Optimized for fast loading times.
- **Efficient Database Queries**: Implements efficient database queries and caching mechanisms.

## Installation Requirements

Before installing and running the project locally, ensure that you have the following software installed on your machine:

- PHP (latest version)
- MySQL (latest version)
- A local server environment such as:
  - WAMP Server (Windows)
  - XAMPP Server (Cross-platform)
  - MAMP Server (MacOS)
  - LAMP Server (Linux)
  - Laragon (Windows)

## Installation Steps

To set up FACTQUEST on your local machine, follow these steps:

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/factquest.git
   
2. **Navigate to the project directory:**
   ```bash
   cd factquest

3. **Set up your local server:**
   - If using Laragon or Xampp, place the project folder in the www/htdocs directory.
     - For XAMPP: `c:/xampp/htdocs`
     - or Laragon: `c:/laragon/www`
   - Start the server.
   - Navigate to your local server directory. This is typically:
   ```bash
   http://localhost/

4. **Set Up the Database:**
   - Open your web browser (Google Chrome or Mozilla Firefox recommended).
   - Go to
   ```bash
   http://localhost/phpmyadmin
  - Import the .sql file into your database system (MySQL). 
     


## Usage
1. **Navigate to the project directory:**
   ```bash
   http://localhost/factquest

## Live Demo

You can also explore a live version of the project here: [FACTQUEST Live Demo](https://factquest.ingmelo.com)
