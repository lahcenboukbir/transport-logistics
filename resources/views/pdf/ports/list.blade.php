@extends('pdf.app')

@section('title')
    <h1>Ports</h1>
@endsection

@section('content')
    <table>
        <caption>Liste des ports</caption>
        <thead>
            <tr>
                <th>Nom du Port</th>
                <th>Lieu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ports as $port)
                <tr>
                    <td>{{ $port->port_name }}</td>
                    <td>{{ $port->location }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
