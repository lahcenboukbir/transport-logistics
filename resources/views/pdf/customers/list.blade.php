@extends('pdf.app')

@section('title')
    <h1>Clients</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des clients</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Date de création</th>
                <th>Ajouté par</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->company }}</td>
                    <td>{{ $customer->phone_number ?? 'N/A' }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>{{ $customer->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
