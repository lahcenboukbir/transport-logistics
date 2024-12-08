@extends('pdf.app')

@section('title')
    <h1>Rendez-vous</h1>
@endsection

@section('content')
    <table>
        <caption>Listes des rendez-vous réussis</caption>
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
            @forelse ($success_appointments as $success_appointment)
                <tr>
                    <td>{{ $success_appointment->name }}</td>
                    <td>{{ $success_appointment->company }}</td>
                    <td>{{ $success_appointment->phone_number ?? 'N/A' }}</td>
                    <td>{{ $success_appointment->appointment_date }}</td>
                    <td>{{ $success_appointment->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <table>
        <caption>Listes des rendez-vous échoués</caption>
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
            @forelse ($fail_appointments as $fail_appointment)
                <tr>
                    <td>{{ $fail_appointment->name }}</td>
                    <td>{{ $fail_appointment->company }}</td>
                    <td>{{ $fail_appointment->phone_number ?? 'N/A' }}</td>
                    <td>{{ $fail_appointment->appointment_date }}</td>
                    <td>{{ $fail_appointment->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

@endsection
