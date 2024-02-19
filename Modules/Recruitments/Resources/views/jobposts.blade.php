@extends(Auth::user() ? 'layouts.app' : 'layouts.auth')
@section('content')
    <!-- ============================ Breadcrums Start================================== -->
    <div class="container-fluid breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{ url('/') }}">
                        Home
                    </a>
                    <a href="javascript:void(0)">
                        <span>
                            <i class="ti-arrow-right"></i>
                        </span>
                        {{-- Search With List --}}
                        {{ Route::currentRouteName() }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <section>
        <div class="container">


            <div class="row">

                <div class="col-xl-3 col-lg-4">

                    <div class="back-brow">
                        <a href="{{ URL::previous() }}" class="back-btn"><i class="ti-back-left"></i>Back</a>
                    </div>

                    <div class="d-block d-none d-sm-block d-md-none mb-3">
                        <a href="javascript:void(0)" onclick="openNav()" class="btn btn-info full-width btn-md"><i
                                class="ti-filter mrg-r-5"></i>Filter Search</a>
                    </div>

                    <div class="sidebar-container d-sm-none d-md-block d-none">

                        <!-- Category -->
                        <div class="sidebar-widget">
                            <div class="form-group">
                                <h5 class="mb-2">Job Category</h5>
                                <div class="side-imbo">
                                    <ul class="no-ul-list">
                                        @foreach ($category_list as $id => $category)
                                            <li>
                                                <input id="checkbox-ei{{ $id }}" class="checkbox-custom"
                                                    name="checkbox-ei{{ $id }}" type="checkbox">
                                                <label for="checkbox-ei{{ $id }}"
                                                    class="checkbox-custom-label">{{ $category }}</label>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Experince -->
                        <div class="sidebar-widget">
                            <div class="form-group">
                                <h5 class="mb-2">Skills</h5>
                                <div class="side-imbo">
                                    <ul class="no-ul-list">
                                        @foreach ($skills as $id => $skill)
                                            <li>
                                                <input id="checkbox-ep{{ $id }}" class="checkbox-custom"
                                                    name="checkbox-ep{{ $id }}" type="checkbox">
                                                <label for="checkbox-ep{{ $id }}"
                                                    class="checkbox-custom-label">{{ $skill }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Experince -->
                        <div class="sidebar-widget">
                            <div class="form-group">
                                <h5 class="mb-2">Experince</h5>
                                <div class="side-imbo">
                                    <ul class="no-ul-list">
                                        <li>
                                            <input id="checkbox-e1" class="checkbox-custom" name="checkbox-e1"
                                                type="checkbox">
                                            <label for="checkbox-e1" class="checkbox-custom-label">1 Year</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-e2" class="checkbox-custom" name="checkbox-e2"
                                                type="checkbox">
                                            <label for="checkbox-e2" class="checkbox-custom-label">2 Year</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-e3" class="checkbox-custom" name="checkbox-e3"
                                                type="checkbox">
                                            <label for="checkbox-e3" class="checkbox-custom-label">3 Year</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-e4" class="checkbox-custom" name="checkbox-e4"
                                                type="checkbox">
                                            <label for="checkbox-e4" class="checkbox-custom-label">4+ Year</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Job Type -->
                        <div class="sidebar-widget">
                            <div class="form-group">
                                <h5 class="mb-2">Job Type</h5>
                                <div class="side-imbo">
                                    <ul class="no-ul-list">
                                        <li>
                                            <input id="checkbox-j1" class="checkbox-custom" name="checkbox-j1"
                                                type="checkbox">
                                            <label for="checkbox-j1" class="checkbox-custom-label">Full Time</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-j2" class="checkbox-custom" name="checkbox-j2"
                                                type="checkbox">
                                            <label for="checkbox-j2" class="checkbox-custom-label">Part Time</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-j3" class="checkbox-custom" name="checkbox-j3"
                                                type="checkbox">
                                            <label for="checkbox-j3" class="checkbox-custom-label">Construction Base</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-j4" class="checkbox-custom" name="checkbox-j4"
                                                type="checkbox">
                                            <label for="checkbox-j4" class="checkbox-custom-label">Internship</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Job Type -->
                        <div class="sidebar-widget">
                            <div class="form-group">
                                <h5 class="mb-2">Job Level</h5>
                                <div class="side-imbo">
                                    <ul class="no-ul-list">
                                        <li>
                                            <input id="checkbox-jf1" class="checkbox-custom" name="checkbox-jf1"
                                                type="checkbox">
                                            <label for="checkbox-jf1" class="checkbox-custom-label">Manager</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-jf2" class="checkbox-custom" name="checkbox-jf2"
                                                type="checkbox">
                                            <label for="checkbox-jf2" class="checkbox-custom-label">Junior</label>
                                        </li>

                                        <li>
                                            <input id="checkbox-jf3" class="checkbox-custom" name="checkbox-jf3"
                                                type="checkbox">
                                            <label for="checkbox-jf3" class="checkbox-custom-label">Senior</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">

                    <div class="row">
                        <!-- layout Wrapper -->
                        <div class="col-md-12 mb-3">
                            <div class="layout-switcher-wrap">
                                <div class="layout-switcher-left">{{ $count_jobposts }} Result Found</div>
                                <div class="layout-switcher">
                                    <ul>
                                        <li><a href="{{ url('/joblist-sidebar') }}"><i class="ti-layout-grid3"></i></a>
                                        </li>
                                        <li class="active"><a href="{{ url('/joblist') }}"><i
                                                    class="ti-view-list"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            @foreach ($jobposts as $id => $jobpost)
                                <!-- Single Large Job List -->
                                <div class="job-new-list">
                                    <div class="vc-thumb">
                                        <img class="img-fluid rounded-circle" src="assets/img/adwords.png"
                                            alt="c2.jpg">
                                    </div>
                                    <div class="vc-content">
                                        <h5 class="title"><a
                                                href="{{ route('job-applications-details') }}">{{ $jobpost }}</a><span
                                                class="j-full-time">Full Time</span></h5>
                                        <p>Google Inc</p>
                                        <ul class="vc-info-list">
                                            <h5>Skills</h5>
                                            <div class="skills">
                                                <span>Css3</span><span>photoshop</span><span>java</span><span>+3
                                                    more</span>
                                            </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="btn btn-black bn-det" href="{{ route('job-application-form') }}">Apply
                                        Now<i class="ti-arrow-right ml-1"></i></a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
