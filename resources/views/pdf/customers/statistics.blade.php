@extends('pdf.app')

@section('title')
    <h1>Clients</h1>
@endsection

@section('content')
    <table>
        <caption>Statistiques des clients</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Total des rendez-vous</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->company }}</td>
                    <td>{{ $customer->phone_number ?? 'N/A' }}</td>
                    <td>{{ $customer->total_appointments }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

@endsection
