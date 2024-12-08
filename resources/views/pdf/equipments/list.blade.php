@extends('pdf.app')

@section('title')
    <h1>Equipements</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des equipements</caption>
        <thead>
            <tr>
                <th>Nom de l'Équipement</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($equipments as $equipment)
                <tr>
                    <td>{{ $equipment->equipment_name }}</td>
                    <td>{{ $equipment->type }}</td>
                    <td>{{ $equipment->description ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
