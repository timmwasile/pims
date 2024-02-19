<?php

namespace App\Http\Controllers;

use Modules\Users\Entities\User;
use Illuminate\Contracts\Support\Renderable;
use Modules\Recruitments\Entities\EducationLevel;
use Modules\Recruitments\Entities\JobApplication;
use Modules\Recruitments\Entities\Skill as Skill;
use Modules\Recruitments\Entities\JobPost as EntitiesJobPost;
use Modules\Recruitments\Entities\JobCategory as EntitiesCategory;
use Modules\Users\Entities\Profile;
use Modules\Users\Entities\UserEducation;
use Modules\Users\Entities\UserExperience;
use Modules\Users\Entities\UserSkill;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        // $categories       = EntitiesCategory::orderBy('id', 'DESC')->get()->pluck('title', 'id', 'description')->prepend(trans('global.pleaseSelect'), '');
        // $skills           = Skill::orderBy('id', 'DESC')->get()->pluck('title', 'id');
        // $category_list    = EntitiesCategory::withCount('active_jobs')->get();
        // $count_categories = EntitiesCategory::get()->count();
        // return view('home', compact('categories', 'category_list', 'count_categories', 'skills'));

        $educations = UserEducation::join('education_levels', 'user_educations.education_level_id', '=', 'education_levels.id')
            ->where('user_educations.user_id', Auth()->user()->id)
            ->get();

        $experiences = UserExperience::where('user_id', Auth()->user()->id)
            ->get();

        $skills = UserSkill::where('user_id', Auth()->user()->id)
            ->get();
        $education_levels = EducationLevel::all();
        $appliedjobs = JobApplication::where('email', Auth()->user()->email)
            ->get();
        $shortlisted_jobs = JobApplication::where('email', Auth()->user()->email)
            ->where('status_id', 3)
            ->where('interview_date', '<=', date('Y-m-d H:i:s'))->get();
        $profiles = Profile::where('user_id', Auth()->user()->id)
            ->first();
        $categories       = EntitiesCategory::orderBy('id', 'DESC')->get()->pluck('title', 'id', 'description')->prepend(trans('global.pleaseSelect'), '');

        return view('home', compact('shortlisted_jobs', 'categories', 'profiles', 'appliedjobs', 'educations', 'experiences', 'skills', 'education_levels'));
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    // public function joblist()
    // {
    //     $categories       = EntitiesCategory::orderBy('id', 'DESC')->get()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
    //     $category_list    = EntitiesCategory::all()->pluck('title', 'id');
    //     $jobposts         = EntitiesJobPost::get();
    //     $skills           = Skill::all()->pluck('title', 'id');
    //     $count_categories = EntitiesCategory::get()->count();

    //     $count_jobposts   = EntitiesJobPost::get()->count();

    //     return view('joblist', compact('categories', 'category_list', 'skills', 'count_categories', 'jobposts', 'count_jobposts'));
    // }

    public function joblist_sidebar()
    {
        $categories = EntitiesCategory::orderBy('id', 'DESC')->get()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobposts         = EntitiesJobPost::all()->pluck('title', 'id');

        $skills = Skill::all()->pluck('title', 'id');

        $category_list = EntitiesCategory::all()->pluck('title', 'id');

        $count_categories = EntitiesCategory::get()->count();
        $count_jobposts   = EntitiesJobPost::get()->count();

        return view('joblist-sidebar', compact('categories', 'category_list', 'skills', 'count_categories', 'jobposts', 'count_jobposts'));
    }

    public function user_profile(User $user)
    {
        $categories = EntitiesCategory::orderBy('id', 'DESC')->get()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('user-profile', compact('categories'));
    }

    public function job_details()
    {
        $categories = EntitiesCategory::orderBy('id', 'DESC')->get()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('job-details', compact('categories'));
    }

    public function store_application()
    {
        $categories = EntitiesCategory::orderBy('id', 'DESC')->get()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('application-form', compact('categories'));
    }
}
