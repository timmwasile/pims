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

                  @foreach($employees as $employee)
                <table class="table table-borderless" style="border: solid 1px black;"">
                    <thead class="font-weight-normal font-italic">
                        <tbody class="font-weight-bold">
                        <tr><th>PLATINUM MEDICAL CARE</th></tr>
                        <tr>
                            <td style="width: 5%">PAYSLIP</td>
                            <td>{{$query->started_at}}</td>
                            <td>{{$query->ended_at}}</td>
                        </tr>
                        <tr>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->ended_at}}</td>
                        </tr>
                        </tbody>
                        <tr>
                            <th>PAYMENT</th>
                        </tr>

                    </thead>
                    <tbody class="text-uppercase">
                        @foreach($payments as $payment)
                           <tr>
                                <td scope="col">{{ ucwords($payment->name) }}</td>
                                <td scope="col">{{ number_format($payment->amount,2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                        @endforeach
                   
           </body>

</html>
