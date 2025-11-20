<x-mail::message>
    # Quota Condominiale

    Ciao {{ $payment->resident->name }},
    Abbiamo registrato il pagamento del mese corrente della tua quota condominiale.
    **Importo:** € {{ number_format($payment->price, 2, ',', '.') }}
    **Data:** {{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}

 
   <x-mail::button :url="config('app.url')">Vai alla tua Dashboard</x-mail::button>

    La preghiamo di non rispondere a questa mail. 
    Grazie,

    Il Team {{ config('app.name') }}
</x-mail::message>