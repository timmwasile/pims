@extends(Auth::user() ? 'layouts.app' : 'layouts.auth')

@section('content')
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
    <section class="tr-single-detail gray-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="back-brow">
                        <a href="{{ URL::previous() }}" class="back-btn"><i class="ti-back-left"></i>Back</a>
                    </div>
                    <!-- Default Style -->
                    <div class="single-job-head head-light">
                        <div class="single-job-thumb">
                            <img src="assets/img/logo.png" alt="">
                        </div>
                        <div class="single-job-info">
                            <h4 class="single-job-title">Region Business Application Officer (RBAO)<span
                                    class="job-type full-time">Full Time</span></h4>
                            <span class="sj-location"><i class="ti-location-pin"></i>Kibaha, Pwani</span>
                            <ul class="tags-jobs">
                                <li><i class="ti-file"></i> Applications 1</li>
                                <li><i class="ti-calendar"></i> Post Date: May 17, 2022</li>
                                <li><i class="fa fa-eye"></i> Views 09</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Job Overview -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-info"></i>Job Overview</h4>
                        </div>
                        <div class="tr-single-body">
                            <p>We are seeking an experienced Wordpress developer with minimum 2+ years of
                                experiencea WordPress Developer responsible for both back-end and front-end
                                development, including creating WordPress themes and plugins. This position requires
                                a combination of programming skills (namely PHP, HTML5, CSS3, and JavaScript) and
                                aesthetics (understanding element arrangements on the screen, the color and font
                                choices, and so on). The candidate should have a strong understanding of industry
                                trends and content management systems.</p>
                            <p> Experience with the responsive and adaptive design is strongly preferred. Also, an
                                understanding of the entire web development process, including design, development,
                                and deployment is preferred.</p>
                        </div>
                    </div>

                    <!-- Job Qualifications -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-book"></i>Skills and Qualifications</h4>
                        </div>
                        <div class="tr-single-body">
                            <ul class="jb-detail-list">
                                <li>Hand On experience with Wordpress</li>
                                <li>Good understanding of front-end technologies, including HTML5, CSS3, JavaScript,
                                    jQuery
                                </li>
                                <li>Experience building user interfaces for websites and/or web applications</li>
                                <li>Experience designing and developing responsive design websites</li>
                                <li>Comfortable working with debugging tools like Firebug, Chrome inspector, etc.
                                </li>
                                <li>Ability to understand CSS changes and their ramifications to ensure consistent
                                    style across platforms and browsers
                                </li>
                                <li>Ability to convert comprehensive layout and wireframes into working HTML pages
                                </li>
                                <li>Knowledge of how to interact with RESTful APIs and formats (JSON, XML)</li>
                                <li>Proficient understanding of code versioning tool GIT</li>
                                <li>Strong understanding of PHP back-end development</li>
                            </ul>
                        </div>
                    </div>


                    <!-- Job Education -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-cup"></i>Education</h4>
                        </div>
                        <div class="tr-single-body">
                            <ul class="jb-detail-list">
                                <li>Higher(10th Pass) (Preferred)</li>
                                <li>Higher Secondary(12th Pass) (Preferred)</li>
                                <li>Any Graduattion Degree(13th Pass) (Preferred)</li>
                            </ul>
                        </div>
                    </div>


                    <a href="{{ url('/application-form') }}" {{-- data-toggle="modal" --}} {{-- data-target="#application_form" --}}
                        class="btn btn-info full-width mb-2">Apply This Job </a>

                </div>

                <!-- Sidebar Start -->
                <div class="col-lg-4 col-md-12 col-sm-12">

                    <!-- Apply Button Wrap -->
                    <div class="apply-wrap-buttons">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="input-group">

                                    {{-- data-toggle="modal" --}} {{-- data-target="#application_form" --}}
                                    {{-- <a href="{{ url('/application-form') }}" 
                                        class="btn btn-primary">
                                        <i class="ti-check-box"></i>Apply Job now</a> --}}
                                    <a href="{{ url('/jobapplications') }}" {{-- data-toggle="modal" --}} {{-- data-target="#application_form" --}}
                                        class="btn btn-primary">
                                        <i class="ti-check-box"></i>Apply Job now</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Overview -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-direction"></i> Job Overview</h4>
                        </div>

                        <div class="tr-single-body">
                            <ul class="extra-service">
                                <li>
                                    <div class="icon-box-icon-block">
                                        <div class="icon-box-round">
                                            <i class="ti-money"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            <strong class="d-block">Offerd Salary</strong>
                                            $80k - $270k
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="icon-box-icon-block">
                                        <div class="icon-box-round">
                                            <i class="lni-users"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            <strong class="d-block">Gender</strong>
                                            Male
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="icon-box-icon-block">
                                        <div class="icon-box-round">
                                            <i class="ti-home"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            <strong class="d-block">Industry</strong>
                                            Management
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="icon-box-icon-block">
                                        <div class="icon-box-round">
                                            <i class="lni-certificate"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            <strong class="d-block">Experience</strong>
                                            5 Years
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="icon-box-icon-block">
                                        <div class="icon-box-round">
                                            <i class="lni-graduation"></i>
                                        </div>
                                        <div class="icon-box-text">
                                            <strong class="d-block">Qualification</strong>
                                            Master Degree
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>


                </div>
            </div>
    </section>
    <!-- ============== Job Detail ====================== -->


    <!-- Application-Form Modal -->
    <div class="modal fade modal-lg" id="application_form" tabindex="-1" role="dialog" aria-labelledby="registermodal"
        aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document" style="max-width: 1350px!important;">
            <div class="modal-content" id="registermodal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-header-title">Job Application Form</h4>
                    <div class="login-form">
                        <div class="container mt-n10">
                            <!-- Wizard card example with navigation-->
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <!-- Wizard navigation-->
                                    <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard"
                                        id="cardTab" role="tablist">
                                        <!-- Wizard navigation item 1-->
                                        <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1"
                                            data-toggle="tab" role="tab" aria-controls="wizard1"
                                            aria-selected="true">
                                            <div class="wizard-step-icon">1</div>
                                            <div class="wizard-step-text">
                                                <div class="wizard-step-text-name">Applicant</div>
                                                <div class="wizard-step-text-details">Basic details and information
                                                </div>
                                            </div>
                                        </a>
                                        <!-- Wizard navigation item 2-->
                                        <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-toggle="tab"
                                            role="tab" aria-controls="wizard2" aria-selected="true">
                                            <div class="wizard-step-icon">2</div>
                                            <div class="wizard-step-text">
                                                <div class="wizard-step-text-name">Education</div>
                                                <div class="wizard-step-text-details">Details</div>
                                            </div>
                                        </a>
                                        <!-- Wizard navigation item 3-->
                                        <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-toggle="tab"
                                            role="tab" aria-controls="wizard3" aria-selected="true">
                                            <div class="wizard-step-icon">3</div>
                                            <div class="wizard-step-text">
                                                <div class="wizard-step-text-name">Employment</div>
                                                <div class="wizard-step-text-details">Details</div>
                                            </div>
                                        </a>

                                        <!-- Wizard navigation item 4-->
                                        <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-toggle="tab"
                                            role="tab" aria-controls="wizard4" aria-selected="true">
                                            <div class="wizard-step-icon">4</div>
                                            <div class="wizard-step-text">
                                                <div class="wizard-step-text-name">Referees</div>
                                                <div class="wizard-step-text-details">Details</div>
                                            </div>
                                        </a>

                                        <!-- Wizard navigation item 5-->
                                        <a class="nav-item nav-link" id="wizard5-tab" href="#wizard5" data-toggle="tab"
                                            role="tab" aria-controls="wizard5" aria-selected="true">
                                            <div class="wizard-step-icon">5</div>
                                            <div class="wizard-step-text">
                                                <div class="wizard-step-text-name">Application Letter</div>
                                                <div class="wizard-step-text-details">Attachment</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="cardTabContent">
                                        <!-- Wizard tab pane item 1-->
                                        <div class="tab-pane py-5 py-xl-10 fade show active" id="wizard1"
                                            role="tabpanel" aria-labelledby="wizard1-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-xxl-6 col-xl-12">
                                                    <h3 class="text-primary">Step 1 of 5</h3>
                                                    <h5 class="card-title">Personal information</h5>

                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'firstname',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'FirstName',
                                                                    ])
                                                                @endcomponent
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'middlename',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Middle Name',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                            <div class="form-group col-md-4">

                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'lastname',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Last Name',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">

                                                                @component('components.form.select',
                                                                    [
                                                                        'name' => 'merital_status',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'MaritalStatus',
                                                                    ])
                                                                @endcomponent
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'class' => 'form-control date',
                                                                        'name' => 'DOB',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Date of Birth',
                                                                    ])
                                                                @endcomponent
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'POB',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Place of Birth',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'Sex',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Gender',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                            <div class="form-group col-md-4">

                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'Physical_address',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Post Address',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'phone',
                                                                        'type' => 'number',
                                                                        'maxlenght' => '10',
                                                                        'placeholder' => 'Mobile Phone',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'email',
                                                                        'type' => 'email',
                                                                        'placeholder' => 'Email',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'nida',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'National ID',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                @component('components.form.textarea',
                                                                    [
                                                                        'name' => 'skills',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Skills',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                @component('components.form.textarea',
                                                                    [
                                                                        'name' => 'ability',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Abilities',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>

                                                        <hr class="my-4" />
                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-secondary disabled" type="button"
                                                                disabled>Previous</button>
                                                            <a class="nav-item nav-link " id="wizard2-tab"
                                                                href="#wizard2" data-toggle="tab" role="tab"
                                                                aria-controls="wizard2" aria-selected="true"> <button
                                                                    class="btn btn-primary"
                                                                    type="button">Next</button></a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Wizard tab pane item 2-->
                                        <div class="tab-pane py-5 py-xl-10 fade" id="wizard2" role="tabpanel"
                                            aria-labelledby="wizard2-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-xxl-6 col-xl-12">
                                                    <h3 class="text-primary">Step 2 of 5</h3>
                                                    <h5 class="card-title">Enter Other Academic details</h5>
                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'School',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Name of the school',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'place',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'place',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">

                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'started_at',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Started At',
                                                                    ])
                                                                @endcomponent

                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'ended_at',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Ended At',
                                                                    ])
                                                                @endcomponent

                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'awards',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Awards',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>


                                                        <hr class="my-4" />
                                                        <div class="d-flex justify-content-between">
                                                            <a class="nav-item nav-link" id="wizard1-tab" href="#wizard1"
                                                                data-toggle="tab" role="tab" aria-controls="wizard1"
                                                                aria-selected="true"><button class="btn btn-secondary"
                                                                    type="button">Previous</button></a>
                                                            <button class="btn btn-primary" type="button">Next</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Wizard tab pane item 3-->
                                        <div class="tab-pane py-5 py-xl-10 fade" id="wizard3" role="tabpanel"
                                            aria-labelledby="wizard3-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-xxl-6 col-xl-12">
                                                    <h3 class="text-primary">Step 3 of 5</h3>
                                                    <h5 class="card-title">Employer(s) Informations</h5>
                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'employer',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Name of the Employer',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'contact',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Contact(Postal Address & Phone)',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'School',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Name of the school',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'place',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'place',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">

                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'place',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Place(Office Location)',
                                                                    ])
                                                                @endcomponent

                                                            </div>
                                                            <div class="form-group col-md-4">

                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'department',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Department',
                                                                    ])
                                                                @endcomponent

                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'job_title',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Worked As',
                                                                    ])
                                                                @endcomponent

                                                            </div>
                                                        </div>


                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">

                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'started_at',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Start date of Employment',
                                                                    ])
                                                                @endcomponent

                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'ended_at',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Date of Departure',
                                                                    ])
                                                                @endcomponent

                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'reasons',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Reason for Departure',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>
                                                        <hr class="my-4" />
                                                        <div class="d-flex justify-content-between">
                                                            <<<<<<< HEAD <a class="nav-item nav-link" id="wizard2-tab"
                                                                href="#wizard2" data-toggle="tab" role="tab"
                                                                aria-controls="wizard2" aria-selected="true">
                                                                <button class="btn btn-secondary" type="button">Previous
                                                                </button>
                                                                </a>
                                                                =======
                                                                <a class="nav-item nav-link" id="wizard2-tab"
                                                                    href="#wizard2" data-toggle="tab" role="tab"
                                                                    aria-controls="wizard2" aria-selected="true"><button
                                                                        class="btn btn-secondary"
                                                                        type="button">Previous</button></a>
                                                                >>>>>>> aa807ec67cb85638ff5d91e8f27915153a42253a
                                                                <button class="btn btn-primary"
                                                                    type="button">Next</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Wizard tab pane item 4-->
                                        <div class="tab-pane py-5 py-xl-10 fade" id="wizard4" role="tabpanel"
                                            aria-labelledby="wizard4-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-xxl-6 col-xl-12">
                                                    <h3 class="text-primary">Step 4 of 5</h3>
                                                    <h5 class="card-title">Referees</h5>
                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'firstname',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Firstname',
                                                                    ])
                                                                @endcomponent
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'middlename',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Middlename',
                                                                    ])
                                                                @endcomponent
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'lastname',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Lastname',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'relationship',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'relationship',
                                                                    ])
                                                                @endcomponent
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'contact',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'contact',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'address',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'address',
                                                                    ])
                                                                @endcomponent
                                                            </div>


                                                            <div class="form-group col-md-6">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'email',
                                                                        'type' => 'email',
                                                                        'placeholder' => 'email',
                                                                    ])
                                                                @endcomponent
                                                            </div>

                                                        </div>

                                                    </form>
                                                    <hr class="my-4" />
                                                    <div class="d-flex justify-content-between">
                                                        <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3"
                                                            <<<<<<< HEAD data-toggle="tab" role="tab"
                                                            aria-controls="wizard3" aria-selected="true">
                                                            <button class="btn btn-secondary" type="button">Previous
                                                            </button>
                                                        </a>
                                                        =======
                                                        data-toggle="tab" role="tab" aria-controls="wizard3"
                                                        aria-selected="true"> <button class="btn btn-secondary"
                                                            type="button">Previous</button></a>
                                                        >>>>>>> aa807ec67cb85638ff5d91e8f27915153a42253a
                                                        <button class="btn btn-primary" type="button">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Wizard tab pane item 6-->
                                        <div class="tab-pane py-5 py-xl-10 fade" id="wizard5" role="tabpanel"
                                            aria-labelledby="wizard5-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-xxl-6 col-xl-12">
                                                    <h3 class="text-primary">Step 5 of 5</h3>
                                                    <h5 class="card-title">Application Letter</h5>
                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                @component('components.form.input',
                                                                    [
                                                                        'name' => 'letter',
                                                                        'type' => 'file',
                                                                        'placeholder' => 'letter',
                                                                    ])
                                                                @endcomponent
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <hr class="my-4" />
                                                    <div class="d-flex justify-content-between">
                                                        <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4"
                                                            data-toggle="tab" role="tab" aria-controls="wizard4"
                                                            aria-selected="true"> <button class="btn btn-secondary"
                                                                type="button">Previous</button></a>
                                                        <button class="btn btn-primary" type="button">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mf-link"><i class="ti-user"></i>{{ config('app.name', 'TANESCO') }}<a href="#">
                            Job Portal</a></div>
                    <div class="mf-forget"><a href="#">Fill all required </a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection

@section('scripts')
    <script>
        $('#application_form').on('shown.bs.modal', function() {
            $('.input-group.date').datepicker({
                format: "dd/mm/yyyy",
                startDate: "01-01-2015",
                endDate: "01-01-2020",
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true,
                container: '#application_form modal-body'
            });
        });

        function refreshPage(e) {
            e.preventDefault();
            window.location.reload(false);
        }
    </script>
@endsection
