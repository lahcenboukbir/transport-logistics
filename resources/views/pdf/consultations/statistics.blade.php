@extends('pdf.app')

@section('title')
    <h1>Consultations</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des consultations terminées</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Date de consultation</th>
                <th>Ajouté par</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($completed_consultations as $completed_consultation)
                <tr>
                    <td>{{ $completed_consultation->customer_name }}</td>
                    <td>{{ $completed_consultation->company }}</td>
                    <td>{{ $completed_consultation->phone_number ?? 'N/A' }}</td>
                    <td>{{ $completed_consultation->consultation_date  }}</td>
                    <td>{{ $completed_consultation->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <table>
        <caption>Liste des consultations annulées</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Date de consultation</th>
                <th>Ajouté par</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($canceled_consultations as $canceled_consultations)
                <tr>
                    <td>{{ $canceled_consultations->customer_name }}</td>
                    <td>{{ $canceled_consultations->company }}</td>
                    <td>{{ $canceled_consultations->phone_number ?? 'N/A' }}</td>
                    <td>{{ $canceled_consultations->consultation_date  }}</td>
                    <td>{{ $canceled_consultations->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
