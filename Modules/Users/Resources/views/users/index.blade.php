@extends(Auth::user() ? 'layouts.app' : 'layouts.auth')
@section('content')
    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->

        <div class="clearfix"></div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->

        <!-- ============================ Hero Banner  Start================================== -->
        {{-- <div class="page-title-wrap">
            <div class="container">
                <div class="col-lg-12 col-md-12">
                    <div class="pt-caption">
                        <h1>{{ Auth::user()->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div> --}}
        <!-- ============================ Hero Banner End ================================== -->


        <!-- ============== Candidate Dashboard ====================== -->
        <section class="tr-single-detail gray-bg">
            <div class="container">
                <div class="row">

                    <!-- Sidebar Start -->
                    <div class="col-md-4 col-sm-12">
                        <div class="dashboard-wrap">

                            <div class="dashboard-thumb">
                                <div class="dashboard-th-pic">
                                    <img src="{{ asset('assets/img/user-3.jpg') }}" class="img-fluid mx-auto img-circle"
                                        alt="" />
                                </div>
                                <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                                <span class="text-success">Web Designer</span>
                            </div>

                            <!-- Nav tabs -->
                            <ul class="nav dashboard-verticle-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#profile"><i class="ti-user"></i>My
                                        Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#resume"><i class="ti-file"></i>My
                                        Resume</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#shortlisted"><i
                                            class="lni-heart-filled"></i>Shortlisted Job</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#applied"><i
                                            class="lni-briefcase"></i>Applied jobs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#alert"><i class="lni-alarm"></i>Alert
                                        job</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cv"><i class="ti-email"></i>CV &
                                        Cover Letter</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="lni-user"></i>View
                                        Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#change-password"><i
                                            class="lni-lock"></i>Change Password</a>
                                </li>
                                <li class="nav-item">
                                    {{-- <a class="nav-link" href="login.html"><i class="lni-exit"></i>Log Out</a> --}}
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                        <div class="nav-link"><i data-feather="log-out"></i></div>
                                        Logout
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <!-- /col-md-4 -->

                    <div class="col-md-8 col-sm-12">
                        <!-- Tab panes -->
                        <div class="tab-content">

                            <!-- My Profile -->
                            <div class="tab-pane active container" id="profile">
                                <form action="{{ route('user-profile') }}" method="post">
                                    @csrf
                                    <input hidden class="form-control" type="text" name="user_id"
                                        value="{{ auth::user()->id }}">
                                    <!-- Basic Info -->
                                    <div class="tr-single-box">
                                        <div class="tr-single-header">
                                            <h4><i class="ti-desktop"></i> Basic Info</h4>
                                        </div>

                                        <div class="tr-single-body">
                                            <div class="row">

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input disabled class="form-control" type="text"
                                                            value="{{ ucwords(auth::user()->name) }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ date('Y-m-d', strtotime($profiles->dob)) }}"
                                                            name="dob">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>NIDA NUMBER</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ $profiles->nin }}" name="nin">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Job Title</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ ucwords($profiles->job_title) }}" name="job_title">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Profile Picture</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="ccover">
                                                            <label class="custom-file-label" for="ccover">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Basic Info -->

                                    <!-- Contact Info -->
                                    <div class="tr-single-box">
                                        <div class="tr-single-header">
                                            <h4><i class="ti-headphone"></i> Contact Info</h4>
                                        </div>

                                        <div class="tr-single-body">
                                            <div class="row">

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="social-nfo">Phone Number</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ $profiles->phone_no }}" name="phone_no">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="social-nfo">Email</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ auth()->user()->email }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="social-nfo">Country</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ strtoUpper($profiles->country) }}"
                                                            name="country">
                                                    </div>
                                                </div>



                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="social-nfo">Complete Address</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ ucwords($profiles->address) }}" name="address"
                                                            placeholder="2850, Chamwino Dodoma">
                                                    </div>
                                                </div>



                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Contact Info -->


                                    <button class="btn btn-info btn-md full-width" type="submit">Save & Update</button>
                                </form>



                            </div>

                            <!-- My Resume -->
                            <div class="tab-pane" id="resume">

                                <!-- Add Educations -->
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="lni-graduation"></i> Add Education</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <table class="table table-striped mb-5">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Qualification</th>
                                                    <th scope="col">Dates</th>
                                                    <th scope="col">School / Colleges</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($educations as $id => $education)
                                                    <tr>
                                                        <th scope="row">{{ $education->title }}</th>
                                                        <td>{{ date('Y', strtotime($education->started_at)) }} -
                                                            {{ date('Y', strtotime($education->endend_at)) }}</td>
                                                        <td>{{ $education->country }}</td>
                                                        <td>
                                                            <div class="dash-action">
                                                                <a href="#" class="dg-edit" data-toggle="tooltip"
                                                                    data-placement="top" title="Edit"><i
                                                                        class="ti-pencil"></i></a>
                                                                <a href="#" class="dg-delete" data-toggle="tooltip"
                                                                    data-placement="top" title="Delete"><i
                                                                        class="ti-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                        <form method="POST" action="{{ route('user-education') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input hidden name="user_id" class="form-control" type="text"
                                                value="{{ auth()->user()->id }}">
                                            <table class="price-list-wrap">
                                                <tbody class="ui-sortable">
                                                    <tr class="pricing-list-item pattern ui-sortable-handle">
                                                        <td>
                                                            <div class="box-close"><a class="delete" href="#"><i
                                                                        class="ti-close"></i></a></div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Title</label>
                                                                        <select
                                                                            class="form-control select {{ $errors->has('education_level_id') ? 'is-invalid' : '' }}"
                                                                            name="education_level_id"
                                                                            id="education_level_id" required>
                                                                            <option value="">
                                                                                {{ trans('global.pleaseSelect') }}
                                                                            </option>
                                                                            @foreach ($education_levels as $education_level)
                                                                                <option
                                                                                    value="{{ $education_level->id }}">
                                                                                    {{ $education_level->title }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('education_level_id'))
                                                                            <div class="invalid-feedback">
                                                                                {{ $errors->first('education_level_id') }}
                                                                            </div>
                                                                        @endif
                                                                        <strong>{{ $errors->first('education_level_id') }}</strong>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>From</label>
                                                                        <input name="started_at" placeholder="06.11.2007"
                                                                            type="text" value=""
                                                                            class="form-control datepicker">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>To</label>
                                                                        <input name="ended_at" placeholder="07.17.2010"
                                                                            type="text" value=""
                                                                            class="form-control datepicker">
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>University</label>
                                                                        <input name="country"
                                                                            placeholder="University Name" type="text"
                                                                            value="" class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn add-pr-item-btn" type="submit">Add Item</button>
                                        </form>
                                    </div>

                                </div>
                                <!-- /Education Info -->

                                <!-- Add Experience -->
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="lni-briefcase"></i> Experience</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <table class="table table-striped mb-5">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Skills @ Company</th>
                                                    <th scope="col">Dates</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($experiences as $experience)
                                                    <tr>
                                                        <th scope="row">{{ $experience->title }} at
                                                            {{ $experience->company_name }}</th>
                                                        <td>{{ date('Y', strtotime($experience->started_at)) . ' - ' . date('Y', strtotime($experience->ended_at)) }}
                                                        </td>
                                                        <td>
                                                            <div class="dash-action">
                                                                <a href="#" class="dg-edit" data-toggle="tooltip"
                                                                    data-placement="top" title="Edit"><i
                                                                        class="ti-pencil"></i></a>
                                                                <a href="#" class="dg-delete" data-toggle="tooltip"
                                                                    data-placement="top" title="Delete"><i
                                                                        class="ti-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <form method="POST" action="{{ route('user-experience') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input hidden name="user_id" class="form-control" type="text"
                                                value="{{ auth()->user()->id }}">
                                            <table class="price-list-wrap">
                                                <tbody class="ui-sortable">
                                                    <tr class="pricing-list-item pattern ui-sortable-handle">
                                                        <td>
                                                            <div class="box-close"><a class="delete" href="#"><i
                                                                        class="ti-close"></i></a></div>
                                                            <div class="row">

                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Title</label>
                                                                        <input class="form-control" type="text"
                                                                            value="" name="title">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>From</label>
                                                                        <input placeholder="06.11.2007" value=""
                                                                            type="text" name="started_at"
                                                                            class="form-control datepicker">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>To</label>
                                                                        <input placeholder="07.17.2010" value=""
                                                                            type="text" name="ended_at"
                                                                            class="form-control datepicker">
                                                                    </div>
                                                                </div>


                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Company</label>
                                                                        <input placeholder="Company Name"
                                                                            name="company_name" value=""
                                                                            type="text" class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn add-pr-item-btn" type="submit">Add Item</button>

                                        </form>
                                    </div>

                                </div>
                                <!-- /Experience Info -->

                                <!-- Add Skills -->
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="lni-briefcase"></i> Skill Or Expertise</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <table class="table table-striped mb-5">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Skills @ Company</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($skills as $skill)
                                                    <tr>
                                                        <th scope="row">{{ $skill->title }}</th>

                                                        <td>
                                                            <div class="dash-action">
                                                                <a href="#" class="dg-edit" data-toggle="tooltip"
                                                                    data-placement="top" title="Edit"><i
                                                                        class="ti-pencil"></i></a>
                                                                <a href="#" class="dg-delete" data-toggle="tooltip"
                                                                    data-placement="top" title="Delete"><i
                                                                        class="ti-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <form method="POST" action="{{ route('user-skill') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input hidden name="user_id" class="form-control" type="text"
                                                value="{{ auth()->user()->id }}">
                                            <table class="price-list-wrap">
                                                <tbody class="ui-sortable">
                                                    <tr class="pricing-list-item pattern ui-sortable-handle">
                                                        <td>
                                                            <div class="box-close"><a class="delete" href="#"><i
                                                                        class="ti-close"></i></a></div>
                                                            <div class="row">

                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Skills</label>
                                                                        <input class="form-control" type="text"
                                                                            name="title" value="">
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn add-pr-item-btn" type="submit">Add Item</button>

                                        </form>
                                    </div>

                                </div>
                                <!-- /Skills Info -->

                                <a href="#" class="btn btn-info btn-md full-width">Save & Update<i
                                        class="ml-2 ti-arrow-right"></i></a>

                            </div>

                            <!-- shortlisted -->
                            <div class="tab-pane" id="shortlisted">

                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="ti-check"></i> Shortlisted Jobs</h4>
                                    </div>

                                    <div class="tr-single-body">

                                        <!-- Single Manage List -->
                                        <div class="manage-list">

                                            <div class="mg-list-wrap">
                                                <div class="mg-list-thumb">
                                                    <img src="{{ asset('assets/img/google.png') }}" class="mx-auto"
                                                        alt="" />
                                                </div>
                                                <div class="mg-list-caption">
                                                    <h4 class="mg-title">Web Designer</h4>
                                                    <span class="mg-subtitle">Google Info</span>
                                                    <span><em>Last activity</em> 4 weeks ago. <em>Posted</em> 4 weeks
                                                        ago</span>

                                                </div>
                                            </div>

                                            <div class="mg-action">
                                                <div class="btn-group ml-2">
                                                    <a href="#" class="btn btn-view" data-toggle="tooltip"
                                                        data-placement="top" title="View Job"><i class="ti-eye"></i></a>
                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                </div>

                            </div>

                            <!-- applied job -->
                            <div class="tab-pane" id="applied">

                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="ti-briefcase"></i> Applied job</h4>
                                    </div>

                                    <div class="tr-single-body">

                                        <!-- Single Manage List -->
                                        <div class="manage-list">
                                            @foreach ($appliedjobs as $id => $appliedjob)
                                                <div class="mg-list-wrap">
                                                    <div class="mg-list-thumb">
                                                        <img src="{{ asset('assets/img/logo.png') }}" class="mx-auto"
                                                            alt="" />
                                                    </div>
                                                    <div class="mg-list-caption">
                                                        <h4 class="mg-title">{{ $appliedjob }}</h4>
                                                        <span class="mg-subtitle">{{ $appliedjob->id }}</span>
                                                        <span><em>Last activity</em> 4 weeks ago. <em>Posted</em> 4 weeks
                                                            ago</span>

                                                    </div>
                                                </div>

                                                <div class="mg-action">
                                                    <div class="btn-group ml-2">
                                                        <a href="#" class="btn btn-view" data-toggle="tooltip"
                                                            data-placement="top" title="View Job"><i
                                                                class="ti-eye"></i></a>
                                                        <a href="#" class="mg-delete ml-2" data-toggle="tooltip"
                                                            data-placement="top" title="Delete"><i
                                                                class="ti-trash"></i></a>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- alert job -->
                            <div class="tab-pane" id="alert">

                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="ti-bell"></i> Alert Jobs</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <div class="alert alert-success">
                                            <strong>Hi Dear!</strong> There is no any job alert.
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- CV & Cover letter -->
                            <div class="tab-pane" id="cv">
                                <!-- CV & Cover letter -->
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="ti-desktop"></i> CV & Cover letter</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <div class="row">

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control" type="text" value="Adam Muklarial">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Job Title</label>
                                                    <input class="form-control" type="text"
                                                        value="Web Designer & Developer">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Overview</label>
                                                    <div id="cv-cover">
                                                        <p>Hello Description</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <form>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- /CV -->

                                <a href="#" class="btn btn-info btn-md full-width">Save & Update<i
                                        class="ml-2 ti-arrow-right"></i></a>

                            </div>

                            <!-- change-password -->
                            <div class="tab-pane" id="change-password">
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="lni-lock"></i> Change Password</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input class="form-control" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input class="form-control" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" type="password">
                                        </div>
                                    </div>

                                </div>

                                <a href="#" class="btn btn-info btn-md full-width">Save & Update<i
                                        class="ml-2 ti-arrow-right"></i></a>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>


    </div>
@endsection
