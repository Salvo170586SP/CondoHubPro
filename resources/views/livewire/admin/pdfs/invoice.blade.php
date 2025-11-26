<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pagamenti {{ $condominium->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 30px;
            font-size: 12px;
        }

        h1 {
            color: #333;
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .header-info {
            text-align: center;
            margin-bottom: 30px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-unpaid {
            color: red;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>

<body>
    <h1>Elenco Pagamenti</h1>
    <div class="header-info">
        <strong>{{ $condominium->name }}</strong><br>
        {{ $condominium->address }}, {{ $condominium->cap }}<br>
        {{ $condominium->city->name ?? '' }}<br>
        Generato il: {{ now()->format('d/m/Y H:i') }}
    </div>

    @foreach($residents as $resident)
    <h3 style="margin-top: 25px; color: #333;">
        {{ $resident->getFullName() }}
        @if($resident->apartments->first())
        - Appartamento {{ $resident->apartments->first()->unit_number }}
        @endif
    </h3>

    @if($resident->payments->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th class="text-right">Importo</th>
                <th class="text-center">Stato</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resident->payments as $payment)
            <tr>
                <td>{{ $payment->getDate($payment->date) }}</td>
                <td class="text-right">€ {{ number_format($payment->price, 2, ',', '.') }}</td>
                <td class="text-center">
                    <span class="{{ $payment->is_pay ? 'status-paid' : 'status-unpaid' }}">
                        {{ $payment->is_pay ? 'Pagato' : 'Non Pagato' }}
                    </span>
                </td>
            </tr>
            @endforeach
            <tr style="background-color: #f0f0f0; font-weight: bold;">
                <td colspan="2" class="text-right">Totale:</td>
                <td class="text-right">
                    € {{ number_format($resident->payments->sum('price'), 2, ',', '.') }}
                </td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    @else
    <p style="color: #999; font-style: italic;">Nessun pagamento registrato</p>
    @endif
    @endforeach

    <div class="footer">
        Documento generato automaticamente da CondoHubPro
    </div>
</body>

</html>