<div class="row">
<!-- number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', 'Plot Number:') !!}
   <div class = 'form-control'> {{ $plot->number }}</div>
</div>

<!-- customer_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Client:') !!}
  <div class = 'form-control'>  {{ ucwords($plot->customerId->name )}}</div>
</div>
<!-- payment_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_id', 'Mode of Payment:') !!}
  <div class = 'form-control'>  {{ ucwords($plot->paymentId->name) }}</div>
</div>
<!-- project_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project:') !!}
  <div class = 'form-control'>  {{ ucwords($plot->projectId->name) }}</div>
</div>
<!-- marketing_officer_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marketing_officer_id', 'Marketing Officer:') !!}
  <div class = 'form-control'>  {{ ucwords($plot->marketingOfficerId->name )}}</div>
</div>

<!-- status_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'Plat Payment Status:') !!}
  <div class = 'form-control '>  {{ ucwords($plot->status_id==0 ? 'complited':'not completed' )}}</div>
</div>

<!-- started_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('started_at', 'Started At:') !!}
 <div class = 'form-control'>   {{ $plot->started_at }}</div>
</div>

<!-- ended_at Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ended_at', 'Ended At:') !!}
 <div class = 'form-control'>   {{ $plot->ended_at }}</div>
</div>

<!-- description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Plot Description:') !!}
   <div class = 'form-control'> {{ $plot->description }}</div>
</div>

<!-- plot_amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plot_amount', 'Plot total Amount:') !!}
   <div class = 'form-control'> {{ number_format($plot->to_be_paid_amount,2).'/=' }}</div>
</div>

<!-- plot_balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plot_balance', 'Balance:') !!}
   <div class = 'form-control'> {{ number_format($plot->balance,2).'/=' }}</div>
</div>

<!-- size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'Plot Size:') !!}
   <div class = 'form-control'> {{ $plot->size.'sqm' }}</div>
</div>

<!-- duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
  <div class = 'form-control'>  {{ $plot->duration > 1 ? $plot->duration. ' Months and only '.  $plot->month_remaining .' month remains': $plot->duration.' Month' .' Remains '.  $plot->month_remaining}}</div>
</div>

</div>


<table class="table table-borderless">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                            <tr>
                                <th colspan="4" >List of Transaction</th>
                                <th colspan="5" >
                                    <p><strong>Customer FullNames : </strong>{{ ucwords($transactions[0]->customer) }}</p>
                                    <p><strong>Project : </strong>{{ ucwords($transactions[0]->project) }}</p>
                                    <p><strong>Plot Number : </strong>{{ ucwords($transactions[0]->plot) }}</p>
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
                            <th scope="col">Download</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">

                        @php
                           $no=1;
                           $total = 0;
                        @endphp

@foreach($transactions as $transaction)
{{-- Debugging: Print out transaction data --}}
{{-- {{ dd($transaction) }} --}}
{{-- Your existing code for table rows --}}
<tr>
    <td scope="col" align="left">{{ $no }} </td>
    <td scope="col">{{ ucwords($transaction->transaction_number) }}</td>
    <td scope="col">{{ $transaction->payment_date }}</td>
    <td scope="col">{{ number_format($transaction->amount, 2)."/=" }}</td>
    <td scope="col">{{ ucwords($transaction->description) }}</td>
    <td scope="col">{{ ucwords($transaction->reference ? $transaction->reference : "N/A") }}</td>
    <td scope="col">
        @if ($transaction->receipt)
            <a target="_blank" href="{{ $transaction ? asset('storage/' . $transaction->media_id . '/' . $transaction->receipt->file_name) : '#' }}">Download</a>
        @else
            No receipt available
        @endif
    </td>
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
