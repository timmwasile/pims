<div class="row">
<!-- number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', 'farm Number:') !!}
   <div class = 'form-control'> {{ $farm->number?$farm->number:'N/A' }}</div>
</div>

<!-- customer_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Client:') !!}
  <div class = 'form-control'>  {{ ucwords($farm->customerId->name )}}</div>
</div>
<!-- payment_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('', 'Mode of Payment:') !!}
  <div class = 'form-control'>  {{ ucwords($farm->paymentId->name) }}</div>
</div>
{{-- <!-- project_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Project_id', 'Project:') !!}
  <div class = 'form-control'>  {{ ucwords($farm->projectId->name) }}</div>
</div> --}}
<!-- marketing_officer_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marketing_officer_id', 'Marketing Officer:') !!}
  <div class = 'form-control'>  {{ ucwords($farm->marketingOfficerId->name )}}</div>
</div>

<!-- status_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'Plat Payment Status:') !!}
  <div class = 'form-control '>  {{ ucwords($farm->status_id==0 ? 'complited':'not completed' )}}</div>
</div>

<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'Started At:') !!}
 <div class = 'form-control'>   {{ $farm->started_at }}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'Ended At:') !!}
 <div class = 'form-control'>   {{ $farm->ended_at }}</div>
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'farm Description:') !!}
   <div class = 'form-control'> {{ $farm->description?$farm->description:'N/A' }}</div>
</div>

<!-- farm_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('farm_amount', 'farm total Amount:') !!}
   <div class = 'form-control'> {{ number_format($farm->to_be_paid_amount,2).'/=' }}</div>
</div>

<!-- farm_balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('farm_balance', 'Balance:') !!}
   <div class = 'form-control'> {{ number_format($farm->balance,2).'/=' }}</div>
</div>

<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'farm Size:') !!}
   <div class = 'form-control'> {{ $farm->size.' acres' }}</div>
</div>

<!-- duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
  <div class = 'form-control'>  {{ $farm->duration > 1 ? $farm->duration. ' Months and only '.  $farm->month_remaining .' month remains': $farm->duration.' Month' .' Remains '.  $farm->month_remaining}}</div>
</div>

</div>


<table class="table">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                        <tr>
                            <th colspan="4" >List of Transaction</th>
                            <th colspan="5" >
                                @if (count($transactions) > 0)

                                <p><strong>Customer FullNames : </strong>{{ isset($transactions[0]->customer) ? ucwords($transactions[0]->customer) : 'N/A' }}</p>

                                <p><strong>Project : </strong>{{ isset($transactions[0]->project) ? ucwords($transactions[0]->project) : 'N/A' }}</p>

                                <p><strong>Number : </strong>{{ isset($transactions[0]->farm) ? ucwords($transactions[0]->farm) : 'N/A' }}</p>

                            @else

                                <p>No transaction information available.</p>

                            @endif

                            </th>
                        </tr>
                        </tbody>
                            <tr>
                            <th scope="col" align="left">S/No</th>
                            <th scope="col">Transaction Number</th>
                             <th scope="col">Payment Date</th>
                            <th scope="col">Amount Paid</th>
                            <th scope="col">Description </th>
                            <th scope="col">Reference Number</th>
                            {{-- <th scope="col">Customer Full Name</th> --}}
                            {{-- <th scope="col">Project Name</th> --}}
                            {{-- <th scope="col">farm Number</th> --}}
                            <th scope="col">Download</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">

                        @php
                           $no=1;
                           $total = 0;
                        @endphp

                        @foreach($transactions as $transaction)
                           <tr>
                                <td scope="col" align="left">{{ $no}} </td>
                                <td scope="col" >{{ ucwords($transaction->transaction_number) }}</td>
                                <td scope="col" >{{ $transaction->payment_date }}</td>
                                <td scope="col" >{{ number_format($transaction->amount,2)."/=" }}</td>
                                <td scope="col" >{{ $transaction->description ? ucwords($transaction->description):'N/A' }}</td>
                                <td scope="col" >{{ ucwords($transaction->reference?$transaction->reference:"N/A") }}</td>
                                {{-- <td scope="col" >{{ ucwords($transaction->customer) }}</td>
                                <td scope="col" >{{ ucwords($transaction->project) }}</td>
                                <td scope="col" >{{ ucwords($transaction->farm) }}</td> --}}
                                <td scope="col">
                                @if ($transaction->receipt)
                                <a target="_blank" href="{{ $transaction ? asset('storage/' . $transaction->media_id . '/' . $transaction->receipt->file_name) : '#' }}">Download</a>
    @else

        No receipt available

    @endif</td>
                                {{-- <td scope="col"><a target="_blank" href="{{ $transaction ? asset('storage/' . $transaction->media_id . '/' . $transaction->receipt->file_name) : '#' }}">Download</a></td> --}}

                            </tr>
                            @php
                            $no++;
                            $total += $transaction->amount;
                            @endphp
                        @endforeach
                            <tr>
                                <td colspan="10"left align="" ><strong>Total Amount paid {{ number_format($total,2)}}/=<strong></td>
                            </tr>
                    </tbody>
                </table>
