@extends('pdf.app')

@section('title')
    <h1>Utilisateurs</h1>
@endsection

@section('content')
    <table>
        <caption>Statistiques des utilisateurs</caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prospects</th>
                <th>Clients</th>
                <th>Rendez-vous</th>
                <th>Taux de conversion</th>
                <th>Consultations</th>
                <th>Taux de conversion</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->total_prospects }}</td>
                    <td>{{ $user->total_customers }}</td>
                    <td>{{ $user->total_appointments }}</td>
                    <td>{{ $user->conversion_rate }}%</td>
                    <td>{{ $user->total_consultations }}</td>
                    <td>{{ $user->conversion_rate2 }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
