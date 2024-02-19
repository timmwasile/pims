<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
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
                <table id="example" class="table table-striped table-bordered" style="width:60%">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                            <tr><img src={{storage_path()."/img/logo.png"}} width="50" height="50"/></tr>
                        <tr align="center"><th colspan="3">PLATINUM MEDICAL CARE</th></tr>
                        <tr><th colspan="3" align="center">PAYSLIP</th></tr>
                    
                        <tr>
                            <td>From: </td>
                            <td >{{$query->started_at}}</td>
                            <td >{{$query->ended_at}}</td>
                        </tr>
                        <tr>
                            <td><strong>{{strtoupper($query->name)}}</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td scope="col">EMPLOYEE NO:</td>
                            <td scope="col" align="right" >{{$query->number}}</td>
                        </tr>
                        </tbody>
                    </thead>
                </table>

                <table id="example" class="table table-striped table-bordered" style="width:60%">
                    <thead>
                            <tr> <th>PAYMENTS</th></tr>
                    </thead>

                            <tbody class="text-uppercase">
                                 @foreach($standards_basic as $standards_basics)
                                 <tr>
                                        <td scope="col">{{ ucwords($standards_basics->name) }}</td>
                                        <td scope="col" align="right">{{ number_format($standards_basics->amount,2)}}</td>
                                    </tr>
                                     @endforeach 
                               @if ($payments->count()!=0)
                                @foreach($payments as $payment)

                                   <tr>
                                        <td scope="col">{{ ucwords($payment->name) }}</td>
                                        <td scope="col" align="right">{{ number_format($payment->amount,2)}}</td>
                                    </tr>
                                @endforeach 

                               @else
                               <tr>
                                        <td scope="col">No Payments </td>
                                        <td scope="col" align="right">{{ number_format(0,2)}}</td>
                                    </tr>
                                   
                               @endif
                               @php
                               $payment_total= $total_payment+$total_standards_basic;
                               $deduction_total = $total_loan+$total_deduction+$total_standards_all;
                               $net_pay = $payment_total-$deduction_total; 
                               @endphp
                               
                                
                                 <tr>
                                        <td scope="col"></td>
                                        <td scope="col" align="right" style="border-top: #100f0f 1px solid;"><strong>{{ number_format($payment_total,2)}}</strong></td>
                                    </tr>
                                
                            </tbody>

                </table>

                <table id="example" class="table table-striped table-bordered" style="width:60%">
                    <thead>
                            <tr> <th>DEDUCTIONS</th></tr>
                    </thead>
                            <tbody class="text-uppercase">
                                 @foreach($standards_all as $standards_alls)
                                 <tr>
                                        <td scope="col">{{ strtoUpper($standards_alls->name) }}</td>
                                        <td scope="col" align="right">{{ number_format($standards_alls->amount,2)}}</td>
                                    </tr>
                                     @endforeach

                               @if ($deductions->count()!=0)

                                @foreach($deductions as $deduction)
                                    <tr>
                                            <td scope="col">{{ ucwords($deduction->name) }}</td>
                                            <td scope="col" align="right">{{ number_format($deduction->amount,2)}}</td>
                                    </tr>
                                @endforeach 
                                @else
                               <tr>
                                        <td scope="col">No Deductions </td>
                                        <td scope="col" align="right">{{ number_format(0,2)}}</td>
                                    </tr>
                                   
                               @endif
                                 @foreach($loans as $loan)
                                    <tr>
                                            <td scope="col">{{ ucwords($loan->name) }}</td>
                                            <td scope="col" align="right">{{ number_format($loan->amount,2)}}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                        <td scope="col"></td>
                                        <td scope="col" align="right" style="border-top: #100f0f 1px solid;"><strong>{{ number_format($deduction_total,2)}}</strong></td>
                                    </tr>
                            </tbody>
                </table>
                
                 <table id="example" class="table table-striped table-bordered" style="width:60%">
                     <tbody>
                          <tr>
                                            <td scope="col"></td>
                                            <td scope="col" align="right"></td>
                                    </tr>
                                    <tr>
                                            <th scope="col">NET PAY</th>
                                            <td scope="col" align="right" style="border-top: #100f0f 2px solid;"><strong>{{ number_format($net_pay,2)}}</strong></td>
                                    </tr>
                    </tbody>
                    <thead>
                        <td scope="col"></td>
                                            <td scope="col" align="right"></td>
                            <tr> <th>SUMMARY</th></tr>
                    </thead>
                            <tbody class="text-uppercase">
                                @foreach($loans as $loan)
                                    <tr>
                                            <td scope="col">{{ ucwords($loan->name) }}</td>
                                            <td scope="col" align="right">{{ number_format($loan->balance,2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                         </table>     
           </body>

</html>
