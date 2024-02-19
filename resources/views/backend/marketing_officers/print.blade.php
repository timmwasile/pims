<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>
        {{ config('app.name', 'Laravel')  . ' Print Out' }}
    </title>
    <!-- Styles -->
    <link
        href="{{asset('backend/img/logo.png') }}"
        rel="stylesheet"
    />
    <style>
        body {
            background-color: white;
            color: black;
            font-family: 'Times New Roman', Times, serif,
        }

        #watermark {
            position: fixed;
            top: 25%;
            left: 20%;
            right: 25%;
            width: 400px;
            height: 400px;
            opacity: .1;
        }

        /* .container-fluid {
            border: 2px solid red;
        }

        #breakdown {
            border: 2px solid yellow;
        } */
        table.table td,
        table.table th {
            padding-top: .2rem;
            padding-bottom: .2rem;
        }

    </style>
</head>

<body>
      <div id="watermark">
        {{-- <img
            src="{{ asset('backend/img/logo.png')}}"
            height="100%"
            width="100%"
        > --}}
    </div>
    {{-- ./#watermark --}}

    <div
        class="container-fluid text-black"
        style="border-bottom: 2px solid black;"
    >
        <div class="row justify-content-center mb-3">
            <div class="col-12 text-center">
                <h2>{{ __('  CARE') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="col-12 text-center">
                    {{-- <img
                        src="{{ asset('backend/img/logo.png') }}"
                        alt="platinum Logo"
                        class="img-fluid"
                        style="border-radius: 0;"
                        width="100"
                        height="100"
                    > --}}
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <p class="text-uppercase text-md font-weight-bold">Payroll Summary for the Month: {{ date("F Y",strtotime($query->started_at))}} Salary</p>
                <p class="text-uppercase text-md font-weight-bold">Printed: {{ date('Y-m-d H:i:s')}}</p>
                <p class="text-uppercase text-md font-weight-bold">Prepared By: {{ ucwords($query->createdBy->name)}}</p>
            </div>
        </div>
    </div>
    {{-- ./header --}}
{{-- payment div --}}
    <div class="row">
            <div class="col-lg-12 col-md-12">

                
                <table class="table table-borderless">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                        <tr  ><th>Payment:</th></tr>
                        </tbody>
                        <tr>
                            <th scope="col" align="left">S/No</th>
                            <th scope="col">Payment Name</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                         <tr>
                                <td scope="col" align="left">1 </td>
                                <td scope="col">{{ ucwords('basic pay') }}</td>
                                <td scope="col"  align="right">{{ number_format($total_basic_pay,2)}}</td>
                            </tr>
                        @php
                           $no=2; 
                        @endphp
                       
                        @foreach($payments as $payment)
                           <tr>
                                <td scope="col" align="left">{{ $no}} </td>
                                <td scope="col">{{ ucwords($payment->name) }}</td>
                                <td scope="col" align="right">{{ number_format($payment->amount,2)}}</td>
                            </tr>
                            @php
                            $no++; 
                            @endphp
                        @endforeach
<tr>
                                <td colspan="2" align="right"><strong>Total payment:</strong></td>
                                <td>{{ number_format($total_payment + $total_basic_pay,2)}}</td>
                            </tr>
                    </tbody>
                </table>
                   
            </div>
        </div>

        {{-- deductions div --}}
<div class="row">
            <div class="col-lg-12 col-md-12">

                
                <table class="table table-borderless">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                        <tr  ><th>Deduction:</th></tr>
                        </tbody>
                        <tr>
                            <th scope="col" align="left">S/No</th>
                            <th scope="col">Deduction Name</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                         <tr>
                                <td scope="col" align="left">1 </td>
                                <td scope="col">{{ strtoUpper('paye') }}</td>
                                <td scope="col"  align="right">{{ number_format($total_paye,2)}}</td>
                            </tr>
                            <tr>
                                <td scope="col" align="left">2 </td>
                                <td scope="col">{{ strtoUpper('nhif') }}</td>
                                <td scope="col"  align="right">{{ number_format($total_nhif,2)}}</td>
                            </tr>
                            <tr>
                                <td scope="col" align="left">3</td>
                                <td scope="col">{{ strtoUpper('nssf') }}</td>
                                <td scope="col"  align="right">{{ number_format($total_nssf,2)}}</td>
                            </tr>
                        @php
                           $no=4; 
                        @endphp
                       
                        @foreach($deductions as $deduction)
                           <tr>
                                <td scope="col" align="left">{{ $no}} </td>
                                <td scope="col">{{ ucwords($deduction->name) }}</td>
                                <td scope="col" align="right">{{ number_format($deduction->amount,2)}}</td>
                            </tr>
                            @php
                            $no++; 
                            @endphp
                        @endforeach

                        @foreach($loans as $loan)
                           <tr>
                                <td scope="col" align="left">{{ $no}} </td>
                                <td scope="col">{{ ucwords($loan->description) }}</td>
                                <td scope="col" align="right">{{ number_format($loan->amount,2)}}</td>
                            </tr>
                            @php
                            $no++; 
                            @endphp
                        @endforeach

                            <tr>
                                <td colspan="2" align="right"><strong>Total deducted:</strong></td>
                                <td align="right">{{ number_format($total_deduction+$total_loan+$total_paye+$total_nhif+$total_nssf,2)}}</td>
                            </tr>

                           
                    </tbody>
                </table>
        <div class="col-lg-12 col-md-12 text-justify">
                <table class="table table-striped table-hover">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                         <tr scope="row">
                                <td colspan="2" align="right"><strong>Total to pay:</strong></td>
                                <td colspan="3" align="right">{{ number_format(($total_payment+$total_basic_pay)-($total_deduction+$total_loan+$total_paye+$total_nhif+$total_nssf),2)}}</td>
                            </tr>
                        </tbody>
                    </thead>
                </table>
        </div>
            </div>
        </div>
    
       
   

   

   

</body>

</html>
