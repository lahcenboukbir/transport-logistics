@extends('pdf.app')

@section('title')
    <h1>Expéditions</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des expéditions</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Moyen</th>
                <th>Port de départ</th>
                <th>Port d'arrivée</th>
                <th>Date de départ</th>
                <th>Date d'arrivée</th>
                <th>Ajouté par</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($shipments as $shipment)
                <tr>
                    <td>{{ $shipment->customer_name }}</td>
                    <td>{{ $shipment->company }}</td>
                    <td>{{ $shipment->phone_number ?? 'N/A' }}</td>
                    <td>{{ $shipment->medium_name  }}</td>
                    <td>{{ $shipment->departure_port ?? 'N/A' }}</td>
                    <td>{{ $shipment->arrival_port ?? 'N/A' }}</td>
                    <td>{{ $shipment->departure_date ?? 'N/A' }}</td>
                    <td>{{ $shipment->arrival_date ?? 'N/A' }}</td>
                    <td>{{ $shipment->user_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
