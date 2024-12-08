@extends('pdf.app')

@section('title')
    <h1>Consultations</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des consultations</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Date de consultation</th>
                <th>Date de confirmation</th>
                <th>Ajouté par</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->customer_name }}</td>
                    <td>{{ $consultation->company }}</td>
                    <td>{{ $consultation->phone_number ?? 'N/A' }}</td>
                    <td>{{ $consultation->consultation_date  }}</td>
                    <td>{{ $consultation->confirmation_date ?? 'N/A' }}</td>
                    <td>{{ $consultation->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
