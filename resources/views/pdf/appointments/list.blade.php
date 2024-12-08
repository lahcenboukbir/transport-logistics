@extends('pdf.app')

@section('title')
    <h1>Rendez-vous</h1>
@endsection

@section('content')
    <table>
        <caption>Listes des rendez-vous</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Date du rendez-vous</th>
                <th>Rendez-vous avec</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->name }}</td>
                    <td>{{ $appointment->company }}</td>
                    <td>{{ $appointment->phone_number ?? 'N/A' }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

@endsection
