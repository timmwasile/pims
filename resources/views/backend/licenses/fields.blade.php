   <!-- company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_id', 'company :') !!}
    {{ Form::select('company_id', $company, null, ['class' => 'form-control select2', 'name' => 'company_id']) }}
 @error('company_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
 <!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'Start_date:') !!}
    {!! Form::text('started_at', null, ['class' => 'form-control', 'id' => 'started_at', 'autocomplete'=>'off']) !!}
     @error('started_at')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'Start_date:') !!}
    {!! Form::text('ended_at', null, ['class' => 'form-control', 'id' => 'ended_at', 'autocomplete'=>'off']) !!}
     @error('ended_at')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
  <div class="form-group col-sm-6">
                <div class="checkbox">
                    <label class="required"  for="status_id" >Is_active</label>
                    <input class="bg-light" id="status_id" name="status_id" type="checkbox" data-toggle="toggle" data-on="YES" data-off="NO" data-size="medium" data-onstyle="success" data-offstyle="light" checked>
                </div>                
            </div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.licenses.index') }}" class="btn btn-light">Cancel</a>
</div>
