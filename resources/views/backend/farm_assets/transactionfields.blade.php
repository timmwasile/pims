
{{-- {{ $plot->id }} --}}
<!-- plot_id Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('id', 'id:') !!}
    {!! Form::text('id', $plot->id, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60]) !!}
</div>


<!-- balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('balance', 'Plot balance:') !!}
    {!! Form::text('balance', $plot->balance, ['class' => 'form-control number-separator', 'maxlength' => 60, 'maxlength' => 60, 'readonly']) !!}
</div>

<!-- mpa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mpa', 'Monthly Amount to be paid:') !!}
    {!! Form::text('mpa', $plot->mpa, ['class' => 'form-control number-separator', 'maxlength' => 60, 'maxlength' => 60, 'readonly']) !!}
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Plot Description:') !!}
    {!! Form::text('description', $plot->description, ['class' => 'form-control', 'maxlength' => 60, 'maxlength' => 60, 'readonly']) !!}
</div>
<!-- loan_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_transaction', 'Last Transaction Date:') !!}
    {!! Form::text('last_transaction', null, ['class' => 'form-control', 'maxlength' => 120, 'maxlength' => 120, 'readonly']) !!}
</div>


<!-- clear_loan_balance Field -->
<div class="form-group col-sm-6" >
    {!! Form::label('amount_paid', ' Amount to be Paid :') !!}
    {!! Form::text('mpa', $plot->mpa, ['class' => 'form-control number-separator', 'maxlength' => 120, 'maxlength' => 120, 'placeholder' =>0, 'autofocus']) !!}
</div>

<!-- employee_id Field -->


{{-- <div class="form-row"> --}}
    <div class="form-group col-md-6">
        <label class="required" for="customer_id">{{ trans('cruds.plot.fields.customer') }}</label>
        <select class="form-control select2  {{ $errors->has('customers') ? 'is-invalid' : '' }}" name="customer_id"
            id="customers" required disabled>
            @foreach ($customers as $customer)
                <option value="{{ $plot->customer_id }}" >
                    {{ ucwords($plot->customerId->name) }}</option>
            @endforeach
        </select>
        @if ($errors->has('customer'))
            <div class="invalid-feedback">
                {{ $errors->first('customer') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.plot.fields.customer_helper') }}</span>
    </div>

<!-- reference Field -->
<div class="form-group col-md-6" >
    {!! Form::label('reference', ' Reference Number :') !!}
    {!! Form::text('reference', null, ['class' => 'form-control ', 'maxlength' => 120, 'maxlength' => 120]) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('payment_date', 'Payment Date:') !!}
    {!! Form::text('payment_date', null, ['class' => 'form-control', 'id' => 'started_at', 'autocomplete'=>'off']) !!}
     @error('payment_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>
<!-- description Field -->
<div class="form-group col-sm-12 col-md-12 col-lg-12" >
    {!! Form::label('description', ' Transaction Description :') !!}
    {!! Form::textArea('description', null, ['class' => 'form-control ', 'maxlength' => 120, 'maxlength' => 120, 'placeholder' =>'Please enter all the detail of this transaction include, payment media if is Bank ot mobile and state the name of each']) !!}
</div>
{{-- </div> --}}
<!-- location Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file_name', 'Office Attachement :') !!}
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
    {!! Form::submit('Submit and Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.farm_assets.index') }}" class="btn btn-light">Cancel</a>
</div>
