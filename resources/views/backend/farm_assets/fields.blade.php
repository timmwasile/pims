<!-- customer_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer Name:') !!}
    {{ Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'name' => 'customer_id']) }}
        @error('customer_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- project_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Farm Name:') !!}
    {{ Form::select('project_id', $farms, null, ['class' => 'form-control select2', 'name' => 'project_id']) }}
        @error('project_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
<!-- map_number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('map_number', 'Number from the Map:') !!}
    {!! Form::text('map_number', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120, 'id'=>'map_number']) !!}
 @error('map_number')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<div class="form-group col-sm-6">
    <label  for="myCheck">{{ trans('cruds.plot.fields.is_cash_payment') }}</label>
            <label class="switch">
                <input type="checkbox" class="bg-light" data-on="YES" name="is_cash_payment"
                        data-off="NO" data-size="medium"
                        data-onstyle="success"
                        data-offstyle="light"><span class="slider round hide-off"></a></span></label>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script>
$(document).ready(function(){
	$(".switch input").on("change", function(e) {
  	const isOn = e.currentTarget.checked;

    if (isOn) {
    	$(".hideme").show();
    } else {
    	$(".hideme").hide();
    }
  });
});
</script>
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

/*END OF TOGGLE SWITCH*/



.hideme {
  /* padding:20px; */
  /* background: blue; */
  /* color: white; */
  /* font-weight: 800; */
  /* text-align: center; */
}
</style>
    <!-- payment_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('payment_id', 'Mode of Payment:') !!}
    {{ Form::select('payment_id', $payments, null, ['class' => 'form-control select2', 'name' => 'payment_id']) }}
        @error('payment_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


    <!-- marketing_officer_id Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('marketing_officer_id', 'Officer Name:') !!}
    {{ Form::select('marketing_officer_id', $marketing_officers, null, ['class' => 'form-control select2', 'name' => 'marketing_officer_id']) }}
        @error('marketing_officer_id')
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

<!-- duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration in Months :') !!}
    {!! Form::number('duration', null, ['class' => 'form-control number-separator', 'min'=> 1, 'maxlength' => 120, 'maxlength' => 120]) !!}

 @error('duration')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'Farm Size in Acres :') !!}
    {!! Form::text('size', null, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120, 'id'=>'size']) !!}
 @error('size')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- description Field -->
<div class="form-group col-sm-6" >
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textArea('description', null, ['class' => 'form-control', 'maxlength' => 120, 'rows' => 10,  ]) !!}
 @error('description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<div class="form-group col-sm-6 hideme" id="reference" style="display: none;">
    {!! Form::label('reference', 'reference:') !!}
    {!! Form::text('reference', null, ['class' => 'form-control', 'maxlength' => 120 ]) !!}
 @error('reference')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<!-- location Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_name', 'Receipt :') !!}
    {!! Form::file('file_name', null, ['class' => 'form-control' ]) !!}
</div>
              {{-- <div class="form-group">
                    <label class="required" for="permits">Attachment</label>
                    <div class="needsclick dropzone {{ $errors->has('permits') ? 'is-invalid' : '' }}"
                        id="permits-dropzone">
                    </div>
                    @if ($errors->has('permits'))
                        <div class="invalid-feedback">
                            {{ $errors->first('permits') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>



@section('scripts')
<script src="{{ asset('backend/assets/js/bootstrap-toggle.min.js') }}"></script>

    <script>
        var uploadedPermitsMap = {}
        Dropzone.options.permitsDropzone = {
            url: '{{ route('admin.farm_assets.storeMedia') }}',
            maxFilesize: 1, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 1
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="permits" value="' + response.name + '">')
                uploadedPermitsMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedPermitsMap[file.name]
                }
                $('form').find('input[name="permits"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($plot) && $plot->permits)
                    var files =
                        {!! json_encode($plot->permits) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="permits" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>


@endsection --}}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.farm_assets.index') }}" class="btn btn-light">Cancel</a>
</div>
