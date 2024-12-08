@extends('pdf.app')

@section('title')
    <h1>Utilisateurs</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des utilisateurs</caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Numéro de téléphone</th>
                <th>Statut</th>
                <th>Date de création</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number ?? 'N/A'}}</td>
                    <td>{{ $user->is_active }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
