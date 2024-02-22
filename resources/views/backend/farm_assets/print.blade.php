<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>
        @php
         $company = DB::table('companies')->where('id', auth()->user()->company_id)->first()->name;
        @endphp
        @yield('title') | {{ ucwords($company) }}
    </title>
    <link href="{{ public_path('/css/theme.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    <style>
        body {
            background-color: white;
            color: black;
            font-family: 'Times New Roman', Times, serif,
        }
   #logo_top {
            position: fixed;
            top: 0%;
            left: 2%;
            right: 25%;
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
        table.table td,
        table.table th {
            padding-top: .2rem;
            padding-bottom: .2rem;
        }

    </style>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  /* border: 1px solid rgb(109, 24, 24); */
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  /* height: 300px; Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
  }
}
</style>
</head>

<body>
      <div id="watermark">
        <img
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path().'/storage'.$imagePath)) }}"
            height="100%"
            width="100%"
        >

    </div>
    {{-- ./#watermark --}}
    <div
        class="container-fluid text-black"
        style="border-bottom: 2px solid black;"
    >
        <div class="row justify-content-center mb-3">
            <div class="col-12 text-center">
                <h2 style="text-align: center">{{ ucwords($company)}}</h2>
                <h3 style="text-align: center">{{ __('  Farm Payment Summary') }}</h3>
            </div>
        </div>
        <div class="row justify-content-center" >
            <div class="col-12 text-center">
                <div class="col-12 text-center" id="logo_top">
                    <img
            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path().'/storage'.$imagePath)) }}"

                        alt=" Logo"
                        class="img-fluid"
                        style="border-radius: 0;"
                        width="100"
                        height="100"

                    >
                </div>
            </div>
        </div>
        <div class="row">
                <div class="column" >
                    <div class="w3-container  w3-cell">
                        <p>Full Name :  {{ ucwords($customer->name) }}</p>
                        <p>Mobile Phone :  {{ ucwords($customer->mobile) }}</p>
                        <p>Address :  {{ ucwords($customer->address) }}</p>
                    </div>
                </div>

                <div class="column" >
                    <div class="w3-container  w3-cell">
                        <p>Plot Size :  {{ $query->size }}sqm</p>
                        <p>Plot Number :  {{ $query->map_number }}</p>
                        <p>Printed At :  {{ date('y-m-d h:m:sa') }}</p>
                    </div>
                </div>
                <div class="column">
                   <div class="w3-container  w3-cell">
                        <p>Project Name :  {{ ucwords($project->name) }}</p>
                        <p>Project Location :  {{ ucwords($project->location) }}</p>
                    </div>
                </div>
        </div>



        {{--  --}}
    </div>
    <div class="row">
            <div class="col-lg-12 col-md-12">


                <table class="table table-borderless">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold w3-container">
                        <tr  ><th colspan="5" style="text-align: center">Transaction Payment List</th></tr>
                        </tbody>
                        <tr>
                            <th scope="col" align="left">S/No</th>
                            <th scope="col">Transaction Number</th>
                            <th scope="col">Date</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase">
                        @php
                           $no=1;
                        @endphp

                        @foreach($transactions as $transaction)
                           <tr>
                                <td scope="col" align="left">{{ $no}} </td>
                                <td scope="col"  align="center">{{ ucwords($transaction->number) }}</td>
                                <td scope="col"  align="center">{{ ucwords($transaction->date) }}</td>
                                <td scope="col" align="center">{{ ucwords($transaction->reference ? $transaction->reference:"N/A" ) }}</td>
                                <td scope="col" align="right" style="text-align: right">{{ number_format($transaction->amount,2)}}</td>
                            </tr>
                            @php
                            $no++;
                            @endphp
                        @endforeach
<tr>
                                <td colspan="4" style="text-align: right">Total Payed:</td>
                                <td style="text-align: right">{{ number_format($total,2)}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right">Total Amount:</td>
                                <td style="text-align: right">{{ number_format($query->to_be_paid_amount,2)}}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right"><strong>Total Balance:</strong></td>
                                <td style="text-align: right">{{ number_format(($query->to_be_paid_amount-$total),2)}}</td>
                            </tr>
                    </tbody>
                </table>

            </div>
        </div>



                    </tbody>
                </table>

            </div>
        </div>








</body>

</html>
