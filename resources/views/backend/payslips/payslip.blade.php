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
                <table id="example" class="table table-striped table-bordered" style="width:45%">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                            <tr>
        {{-- <img
            src="{{ public_path('/backend/img/logo.png') }}"
            height="100%"
            width="100%"
        > --}}
                                {{-- <img src={{ asset('/img/logo.png')}} width="50" height="50"/> --}}
                                {{-- img src="{{ asset('/storage/e-signatures/' . $user->docusign) }}" --}}

                            </tr>
                        <tr align="center"><th colspan="3">PLATINUM MEDICAL CARE</th></tr>
                        <tr><th colspan="3" align="center">PAYSLIP</th></tr>
                    
                        <tr>
                            <td colspan="1" >From: </td>
                            <td colspan="1" >{{$query->started_at}}</td>
                            <td colspan="1" >{{$query->ended_at}}</td>
                        </tr>
                        <tr>
                            <td  align="center" colspan="3" ><strong>{{strtoupper($query->name)}}</strong></td>
                            
                        </tr>
                        <tr>
                            <td colspan="1">EMPLOYEE NO:</td>
                            <td colspan="2" align="right" >{{$query->number}}</td>
                        </tr>
                        </tbody>
                    </thead>
                </table>

                <table id="example" class="table table-striped table-bordered" style="width:45%">
                    <thead>
                            <tr> <th  colspan="3">PAYMENTS</th></tr>
                    </thead>

                            <tbody class="text-uppercase">
                                 <tr>
                                        <td colspan="1">BASIC PAY</td>
                                        <td colspan="3"align="right">{{ number_format($basic->basic,2)}}</td>
                                    </tr>
                               @if ($payments->count()!=0)
                                @foreach($payments as $payment)

                                   <tr>
                                        <td colspan="1">{{ ucwords($payment->name) }}</td>
                                        <td colspan="3" align="right">{{ number_format($payment->amount,2)}}</td>
                                    </tr>
                                @endforeach 

                               @else
                               
                                   
                               @endif
                        @php
                               $payment_total= $total_payment+$basic->basic;
                               $deduction_total = $total_loan+$total_deduction+$paye->paye+$nhif->nhif+$nssf->nssf;
                               $net_pay = $payment_total-$deduction_total; 
                            //    dd($total_deduction);
                        @endphp
                               
                                
                                 <tr>
                                        <td colspan="1"></td>
                                        <td colspan="3" align="right" style="border-top: #100f0f 1px solid;"><strong>{{ number_format($payment_total,2)}}</strong></td>
                                    </tr>
                                
                            </tbody>

                </table>

                <table id="example" class="table table-striped table-bordered" style="width:45%">
                    <thead>
                            <tr> <th colspan="3">DEDUCTIONS</th></tr>
                    </thead>
                            <tbody class="text-uppercase">
                                
                                    <tr>
                                        <td colspan="1">Paye</td>
                                        <td colspan="3" align="right">{{ number_format($paye->paye,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">NHIF</td>
                                        <td colspan="3" align="right">{{ number_format($nhif->nhif,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">NSSF</td>
                                        <td colspan="3" align="right">{{ number_format($nssf->nssf,2)}}</td>
                                    </tr>
                               @if ($deductions->count()!=0)

                                @foreach($deductions as $deduction)
                                    <tr>
                                            <td colspan="1">{{ strtoupper($deduction->name) }}</td>
                                            <td colspan="3" align="right">{{ number_format($deduction->amount,2)}}</td>
                                    </tr>
                                @endforeach 
                             
                                   
                               @endif
                                 @foreach($loans as $loan)
                                    <tr>
                                            <td colspan="1">{{ ucwords($loan->name) }}</td>
                                            <td colspan="3" align="right">{{ number_format($loan->amount,2)}}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                        <td colspan="1"></td>
                                        <td colspan="3" align="right" style="border-top: #100f0f 1px solid;"><strong>{{ number_format($deduction_total)}}</strong></td>
                                    </tr>
                            </tbody>
                </table>
                
                 <table id="example" class="table table-striped table-bordered" style="width:45%">
                     <tbody>
                          <tr>
                                            <td colspan="1"></td>
                                            <td colspan="3" align="right"></td>
                                    </tr>
                                    <tr>
                                            <th colspan="1">NET PAY</th>
                                            <td colspan="3" align="right" style="border-top: #100f0f 2px solid;"><strong>{{ number_format($net_pay,2)}}</strong></td>
                                    </tr>
                    </tbody>
                    <thead>
                            <tr> <th colspan="3">SUMMARY</th></tr>
                    </thead>
                            <tbody class="text-uppercase">
                                @foreach($loans as $loan)
                                    <tr>
                                            <td colspan="1">{{ ucwords($loan->name) }}</td>
                                            <td colspan="3" align="right">{{ number_format($loan->balance,2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                         </table>     
           </body>

</html>
