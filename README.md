# TAN Rep

## About TAN Rep

TANESCO Recruitment Portal is a Laravel application where internal employees can post, apply, shortlist and complete all the interview processes, and external users can apply for apply for various posts.

## Modules

TAN Rep has various modules for external users, internal employees which some are administrators of the system. The following are modules within this application:

    1. User Management
        Contains:
            Users, Profile, Permissions, Roles

    2. Activity/Audit Log

    3. Recruitment
        Contains:
            Qualification Categories, Qualification Items,
            Job Categories, Job level, Job Posts, Applicants, Job Applications
            Assessments (Shortlist QAs), Interviews

    4. Notification Templates
        Contains:
            Text Templates, Mail Templates

## Dependencies and Technology

The following are the packages and technology used, as follows:

- [Laravel Modules](https://github.com/nWidart/laravel-modules)

- [Spatie Media Library](https://github.com/spatie/laravel-medialibrary)

- [Laravel Snappy, PDF Generator](https://github.com/barryvdh/laravel-snappy)

- [Slugs for SEO friendly urls](https://github.com/cviebrock/eloquent-sluggable)

- Databases:

    `MariaDB` for all normal application functionalities

    `MongoDB` for storing media's and audit/activity logs

- Cache: `Redis`

- Deployment: `Docker`

- Tests: PHP Unit

## Security Vulnerabilities

If you discover a security vulnerability within TAN Rep, please send an e-mail to Muhammad Mwinchande via [ammwinchande@gmail.com](mailto:ammwinchande@gmail.com) / [timmwasile@gmail.com](mailto:timmwasile@gmail.com). All security vulnerabilities will be promptly addressed.

## Metups

### First Meet-up

Items to showcase:

    - Frontend: Authentication (login/register),
    - Frontend: Home with Categorized Jobs
    - Frontend: List of All Jobs (uncategprized/active)
    - Frontend: Single Job View
    - Frontend: Job Application Form
    - Backend: Authentication
    - Backend: User Management
        - Users
        - Roles
        - Permissions

    - Backend: Recruitment
        - Qualification Categories (Education/Experience/Age/Gender)
        - Qualification Items (Education-> Diploma, Certicficate etc, Experience-> 4years, 6months etc,)
        - Job Categories (Accounts/IT/HR etc)
        - Job level (Officer/Manager/Senior Manager/Director/CFO/DMD/MD etc)
        - Job Type (Full time/Intern/Temp)
        - Applicants (List of all user's unspecific for the job)

    - QNs: NIDA service?? Authentication using Active Directory?? {Integrations}
