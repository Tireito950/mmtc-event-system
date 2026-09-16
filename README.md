# Macmillan College Student Event Registration System

A beginner-to-intermediate PHP/MySQL web application for students to view college events and register online.

## Technologies
- HTML5
- CSS3
- Bootstrap 5
- Bootstrap Icons
- JavaScript
- PHP + MySQLi
- MySQL

## Project Pages
| File | Purpose |
|---|---|
| `index.php` | Homepage and upcoming event preview |
| `events.php` | Displays events from MySQL |
| `register.php` | Student registration form and selected-event preview |
| `process_registration.php` | Server-side validation and MySQL insert |
| `records.php` | Registration records, counter and live search |

## Setup with XAMPP
1. Start Apache and MySQL in XAMPP.
2. Create/import the database using `database/student_events.sql` in phpMyAdmin.
3. Put the `student-event-registration` folder inside `htdocs`.
4. If your MySQL settings differ, update `includes/db.php`.
5. Open `http://localhost/student-event-registration/`.

## JavaScript Features
1. Client-side form validation.
2. Bootstrap confirmation modal before submission.
3. Success/error status messages.
4. Live search/filtering on registration records.
5. Dynamic selected-event information on the registration page.

## Design
The interface uses a simple Macmillan-inspired navy, blue, white and gold colour scheme with a college-style navigation bar, event cards, registration layout and footer. It is intentionally kept at an intermediate student-developer level rather than using a complex framework.

The visual direction references the current Macmillan College website's education-focused cards, events section, blue/white presentation and clear calls to action.

## Note
The project uses Bootstrap and Google Fonts through CDN links, so an internet connection is needed for those external assets when running locally.
