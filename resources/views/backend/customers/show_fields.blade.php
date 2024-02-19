<div class="row">

<!-- name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Customer Fullname:') !!}
   <div class = 'form-control'> {{ ucwords($customer->name )}}</div>
</div>

<!-- address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Customer Address:') !!}
   <div class = 'form-control'> {{ucwords($customer->address) }}</div>
</div>

<!-- mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', ' Customer Mobile:') !!}
   <div class = 'form-control'> {{ $customer->mobile }}</div>
</div>

<!-- nida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nida', ' Customer NIDA Number:') !!}
   <div class = 'form-control'> {{ $customer->nida}}</div>
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Customer Description:') !!}
   <div class = 'form-control'> {{ ucwords($customer->description) }}</div>
</div>



</div>

            <table class="table table-borderless">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                        <tr><th colspan="9">List of Plots Owned By {{ ucwords($customer->name ) }}</th></tr>
                        </tbody>
                        
                        <tr>
                            <th scope="col" align="left">S/No</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Plot Number</th>
                            <th scope="col">Amount Cost</th>
                            <th scope="col">Balance Remaining</th>
                            <th scope="col">Marketing Officer</th>
                            <th scope="col">Status</th>
                            <th scope="col">Modes of Payment</th>
                            <th scope="col">Amount Payable Monthly</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                        
                        @php
                           $no=1; 
                        @endphp
                       
                        @foreach($plots as $plot)
                           <tr>
                                <td scope="col" align="left">{{ $no}} </td>
                                <td scope="col" >{{ ucwords($plot->project_name) }}</td>
                                <td scope="col" >{{ ucwords($plot->number) }}</td>
                                <td scope="col" >{{ number_format($plot->amount,2)."/=" }}</td>
                                <td scope="col" >{{ $plot->balance !=0? number_format($plot->balance,2)."/=":"NILL" }}</td>
                                <td scope="col" >{{ ucwords($plot->marketing_officer) }}</td>
                                <td scope="col" >{{ ucwords($plot->balance==0 && $plot->status_id==0 ? "Completed":"Not Completed" ) }}</td>
                                <td scope="col" >{{ ucwords($plot->payment_mode) }}</td>
                                <td scope="col" >{{ number_format($plot->monthly,2)."/=" }}</td>
                            </tr>
                            @php
                            $no++; 
                            @endphp
                        @endforeach
                            {{-- <tr>
                                <td colspan="4" align="right"><strong>Total Transaction:</strong></td>
                                <td>{{ number_format($total,2)}}</td>
                            </tr> --}}
                    </tbody>
                </table>

 