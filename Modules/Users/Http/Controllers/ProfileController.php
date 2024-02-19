<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Recruitments\Entities\JobPost;
use Modules\Users\Entities\Profile;
use Modules\Users\Entities\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('users::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $userID = Profile::where('user_id', auth()->user()->id)->first();


        if (!$userID) {
            Profile::create($request->all());
            $request->addMediaFromRequest('photo')->toMediaCollection('photo');


            foreach ($request->file('photo', []) as $file) {
                $photo = $request->file('photo');
                $request->addMedia(storage_path('public/' . $file))->toMediaCollection('photo');
                $photoName = time() . '.' . $photo->extension();
                $destination = '/uploads/photo/';
                $request->move(public_path() . $destination, $photoName);
            }
            return redirect()->back();
        } else {
            Profile::where('user_id', $userID->user_id)->update(
                [
                    'nin' => $request->nin,
                    'address' => $request->address,
                    'country' => $request->country,
                    'dob' => $request->dob,
                    'job_title' => $request->job_title,
                    'phone_no' => $request->phone_no
                ]
            );

            return redirect()->route('profile')->with('success', ' ' . ucwords(auth()->user()->name) . '  is Updated successfully.');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(User $user)
    {
        return view('users::user.index', [
            'user' => $user,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
