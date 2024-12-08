@extends('pdf.app')

@section('title')
    <h1>Prospects</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des prospects</caption>
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
            @forelse ($prospects as $prospect)
                <tr>
                    <td>{{ $prospect->name }}</td>
                    <td>{{ $prospect->company }}</td>
                    <td>{{ $prospect->phone_number ?? 'N/A' }}</td>
                    <td>{{ $prospect->created_at }}</td>
                    <td>{{ $prospect->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
