# FACTQUEST

**FACTQUEST** is an interactive platform that allows users to post facts or news items along with a source URL. Other users can then vote on the authenticity of the posted items by marking them as either "True" or "False." This platform fosters community-driven verification and validation of information.

## Website Screenshots

![Screenshot 2024-08-24 173646](https://github.com/user-attachments/assets/594f4e30-a91d-4964-a21a-62a54d28a524)

![Screenshot 2024-08-24 173955](https://github.com/user-attachments/assets/b23bc45e-2557-4e91-9aa9-3d8ddcdcb688)

## Table of Contents

1. [Technology Overview](#technology-overview)
   - [Front End](#front-end)
   - [Back End](#back-end)
2. [Installation Requirements](#installation-requirements)
3. [Installation Steps](#installation-steps)
4. [Live Demo](#live-demo)

## Technology Overview

### Front End

- **HTML:** Used for structuring the content on the web. The pages are created and saved as web documents.
- **Tailwind CSS:** A utility-first CSS framework that allows for rapid UI development with predefined classes.
- **JavaScript:** A programming language used to make web pages interactive. It is commonly used with web browsers to create dynamic and interactive experiences.

### Back End

- **PHP (Hypertext Preprocessor):** A server-side scripting language used to create dynamic and interactive web pages. PHP processes the server-side logic, interacts with the database, and renders the necessary content to the client.
- **MySQL:** An open-source relational database management system used to store and manage the data for the application.

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

1. **Download the Project:**
   - Run git clone or Download the ZIP file of the project from the repository.

2. **Extract the Project Files:**
   - Unzip the downloaded file.
   - Navigate to your local server directory. This is typically:
     - For XAMPP: `c:/xampp/htdocs`
     - For Laragon: `c:/laragon/www`
   - Copy the extracted project folder into this directory.

3. **Set Up the Database:**
   - Start the Apache and MySql server to allow local hosting of the application.
   - Open your web browser (Google Chrome or Mozilla Firefox recommended).
   - Go to `http://localhost/phpmyadmin`.
   - Import the .sql file into your database system (MySQL).
     

4. **Run the Project:**
   - After setting up the database, navigate to `http://localhost/[PROJECT_FOLDER_NAME]/` in your browser to access the application.

## Live Demo

You can also explore a live version of the project here: [FACTQUEST Live Demo](https://problemsolvingsl.com/factquest/)
