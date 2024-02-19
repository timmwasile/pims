# Database Structure and Processes

## User Management

    users
        name, username, email, email_verified_at, password, remember_token, created_at, updated_at, disabled_at, disabled_by, disabled_reason, is_admin

    permissions
        title, description, created_at, updated_at

    roles
        title, description, created_at, updated_at

    profile
        user_id, photo, phone_number, website, nin, address, facebook_url, twitter_url, linkedin_url, dob, job_title, country

    education
        user_id, education_level_id, qualification, institution, start_date, end_date(nullable), created_at, updated_at

    experiences
        user_id, company_name, achievements (wysiwyg - free text), location (string), start_date, end_date(nullable), cover_letter(wysiwyg, nullable)

    candidate_skills
        user_id, skill_id, skill_level_id, years_of_experience, created_at, updated_at

## Education/Skill Settings

    education_levels
        title, description, created_at, updated_at (e.g. diploma, certificate, degree etc.)

    skills
        title, description, created_at, updated_at (e.g. marketing, transformer technician, php, laravel, reactjs etc.)

    skill_levels
        title, description, created_at, updated_at (e.g. beginner, intermediate, expert, etc.)

## Recruitment

    qualification_categories
        title, description, created_at, updated_at
    qualification_items
        qualification_category_id, title, description, created_at, updated_at

    job_categories
        title, description, created_at, updated_at (e.g. IT, Finance, HR Generalists etc.)
    job_levels
        title, description, created_at, updated_at (e.g. officer, senior, principal, manager, senior manager, chief etc.)
    job_types
        title, description, created_at, updated_at (e.g. Full time/Intern/Temp)

    job_posts
        job_category_id, job_level_id, title, description (wysiwyg), types(enum: full time, internship, part time, freelancing),
        gender (enum: male, female, none), start_date, application_end_date, end_date, approved_at, approved_by, interview_date, created_at, updated_at

    minimum_qualification
        job_post_id, education_level_id, job_level_id, years_of_experience, age, skills (json: {skill_id: skill_level_id,})

    applications
        user_id, job_post_id, cover_letter(wysiwyg, nullable - use default in experiences), is_qualified/qualified_at, first_assessment (nullable)/first_assessed_at, second_assessment (nullable)/second_assessed_at, third_assesment (nullable)/third_assessed_at, interview_date, joining_date

## Assessments

    questions
        job_post_id, title, created_at, updated_at
    answers
        questions_id, answer, is_correct, created_at, updated_at
    applicant_questions
        applicant_id, question_id, created_at, updated_at (prevent same question to be asked to the same candidate)
    qualification_assessments
        user_id, token, url, start_date, end_date, attempt_time (in minutes), attempted_at

## Oral Interview

    1. invited_interviwers -> send link to their emails for accepting invitation
    2. provide a way for them to login or reach the submission page for prepared oral interview questions and answers

    3. after submission of oral interview question: share a link which contains specific invited interviewer token and password
    to login into during the interview day (set on job_post)

    4. on a daily basis have a screen showing all job posts that require to start interview
        Oral Interview Leader can login to the system and click START INTERVIEW for a specific job post.
        Once clicked, all interviews (invited and internally) after they have logged in using the 3. above
        provided credentials, each will see random selected questions with their accurate answers
        - candidate name will be filled,
        - marks for each question will be shown
        - assessed_marks: interviewer will be able to add points based on the answer
        - candidate attendance will also be marked i.e. if attended or not
        - skipping a candidate will be provided to leading interviewer in which all intreviewers screens will be skipped (future)
        - after, completion of all questions for that candidate then all interviewers will be able to submit their responses
        proceed with another candidate
        - Once all candidates are completed, interview session will be closed.
