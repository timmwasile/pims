<div class="row">
  <div class="column" style="background-color:#aaa;">
   
<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'FullName:') !!}
    {!! Form::text('name', ucwords(auth()->user()->name), ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>


<!-- email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', auth()->user()->email, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>



<!-- Mobile Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_no', 'Mobile Number:') !!}
    {!! Form::number('phone_no', auth()->user()->phone_no, [
        'class' => 'form-control',
        'maxlength' => 10,
        'placeholder' => '(0)712-123-456',
    ]) !!}
</div>


  </div>
  <div class="form-group column" style="background-color:#bbb;">
  

              @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

               

                <div class="form-group">
                    <div class="d-block">
                        <label for="new_password" class="control-label">
                           New new_password
                        </label>
                      
                    </div>
                    <input aria-describedby="new_passwordHelpBlock" id="new_password" type="password"
                        value="{{ Cookie::get('new_password') !== null ? Cookie::get('new_password') : null }}"
                        placeholder="Enter Password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}"
                        name="new_password" tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('new_password') }}
                    </div>

                    <div class="form-group">
                    <div class="d-block">
                        <label for="confirm_password" class="control-label">
                            confirm_Password
                        </label>
                      
                    </div>
                    <input aria-describedby="confirm_passwordHelpBlock" id="confirm_password" type="password"
                        value="{{ Cookie::get('confirm_password') !== null ? Cookie::get('confirm_password') : null }}"
                        placeholder="Confirm Password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                        name="confirm_password" tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('confirm_password') }}
                    </div>
                </div>
  </div>


</div>




<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.admins.index') }}" class="btn btn-light">Cancel</a>
</div>

<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 400px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
  }
}
</style>