<?php

namespace Modules\Users\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\UserSkill;
use Modules\Users\Entities\UserEducation;
use Modules\Users\Entities\UserExperience;
use Illuminate\Contracts\Support\Renderable;
use Modules\Recruitments\Entities\EducationLevel;
use Modules\Recruitments\Entities\JobApplication;
use Modules\Users\Entities\Profile;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {

        $educations = UserEducation::join('education_levels', 'user_educations.education_level_id', '=', 'education_levels.id')
            ->where('user_educations.user_id', Auth()->user()->id)
            ->get();

        $experiences = UserExperience::where('user_id', Auth()->user()->id)
            ->get();

        $skills = UserSkill::where('user_id', Auth()->user()->id)
            ->get();
        $education_levels = EducationLevel::all();
        $appliedjobs = JobApplication::where('id', Auth()->user()->id)
            ->get();
        $profiles = Profile::where('user_id', Auth()->user()->id)
            ->first();

        return view('users::users.index', compact('profiles', 'appliedjobs', 'educations', 'experiences', 'skills', 'education_levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function destroy($id)
    {
    }
}
