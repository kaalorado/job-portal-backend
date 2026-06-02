<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->


# Job Portal API

## Overview

Job Portal API is a RESTful backend application built with Laravel that enables employers to post jobs and manage applications, while allowing applicants to search for jobs, upload resumes, and apply for positions.

The project implements authentication, role-based authorization, file uploads, job management, application tracking, and resume downloads.

---

## Features

### Authentication

* User registration
* User login
* User logout
* Laravel Sanctum token authentication

### Role-Based Authorization

* Employer role
* Applicant role
* Protected routes using middleware

### Employer Features

* Create employer profile
* Post jobs
* Update jobs
* Delete jobs
* View own jobs
* View applicants for a job
* Download applicant resumes
* Update application status

### Applicant Features

* Create applicant profile
* Upload resume (PDF, DOC, DOCX)
* Browse jobs
* Search jobs
* Filter jobs by location and job type
* Apply for jobs
* View submitted applications
* Track application status

### Job Management

* Create jobs
* Update jobs
* Delete jobs
* Public job listing
* Job search and filtering
* Pagination

### Application Management

* Submit applications
* Prevent duplicate applications
* View applications
* Update application status:

  * Pending
  * Reviewed
  * Accepted
  * Rejected

---

## Technologies Used

* PHP
* Laravel
* Laravel Sanctum
* MySQL
* REST API
* Postman

---

## Database Structure

### Users

Stores registered users and their roles.

### Employer Profiles

Stores employer/company information.

### Applicant Profiles

Stores applicant information and resume paths.

### Jobs

Stores job postings created by employers.

### Applications

Stores job applications submitted by applicants.

---

## API Endpoints

### Authentication

| Method | Endpoint      |
| ------ | ------------- |
| POST   | /api/register |
| POST   | /api/login    |
| POST   | /api/logout   |
| GET    | /api/me       |

### Employer

| Method | Endpoint                      |
| ------ | ----------------------------- |
| POST   | /api/employer/profile         |
| POST   | /api/jobs                     |
| GET    | /api/my-jobs                  |
| PUT    | /api/jobs/{id}                |
| DELETE | /api/jobs/{id}                |
| GET    | /api/jobs/{id}/applications   |
| PATCH  | /api/applications/{id}/status |
| GET    | /api/applications/{id}/resume |

### Applicant

| Method | Endpoint                     |
| ------ | ---------------------------- |
| POST   | /api/applicant/profile       |
| POST   | /api/applicant/upload-resume |
| POST   | /api/jobs/{id}/apply         |
| GET    | /api/my-applications         |

### Public

| Method | Endpoint                  |
| ------ | ------------------------- |
| GET    | /api/jobs                 |
| GET    | /api/jobs?search=backend  |
| GET    | /api/jobs?location=Lagos  |
| GET    | /api/jobs?job_type=remote |

---

## Installation

1. Clone the repository

```bash
git clone <repository-url>
```

2. Navigate into the project

```bash
cd job-portal
```

3. Install dependencies

```bash
composer install
```

4. Create environment file

```bash
cp .env.example .env
```

5. Generate application key

```bash
php artisan key:generate
```

6. Configure database credentials in `.env`

7. Run migrations

```bash
php artisan migrate
```

8. Create storage link

```bash
php artisan storage:link
```

9. Start development server

```bash
php artisan serve
```

---

## Future Improvements

* Email notifications
* Interview scheduling
* Saved jobs functionality
* Admin dashboard
* Advanced search filters
* Cloud storage integration (AWS S3)
* API Resources
* Queue processing

---

## Author

Developed by Aderibole Bolade Ayodeji as a backend-focused Laravel project demonstrating REST API development, authentication, authorization, file handling, and relational database design.
