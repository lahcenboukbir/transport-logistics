@extends('pdf.app')

@section('title')
    <h1>Prospects</h1>
@endsection

@section('content')
    <table>
        <caption>Statistiques des prospects</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
                <th>Total des rendez-vous</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($prospects as $prospect)
                <tr>
                    <td>{{ $prospect->name }}</td>
                    <td>{{ $prospect->company }}</td>
                    <td>{{ $prospect->phone_number ?? 'N/A' }}</td>
                    <td>{{ $prospect->total_appointments }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <table>
        <caption>Nouveaux prospects</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($new_prospects as $new_prospect)
                <tr>
                    <td>{{ $new_prospect->name }}</td>
                    <td>{{ $new_prospect->company }}</td>
                    <td>{{ $new_prospect->phone_number ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <table>
        <caption>Prospects intéressés</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($interested_prospects as $interested_prospect)
                <tr>
                    <td>{{ $interested_prospect->name }}</td>
                    <td>{{ $interested_prospect->company }}</td>
                    <td>{{ $interested_prospect->phone_number ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <table>
        <caption>Prospects non intéressés</caption>
        <thead>
            <tr>
                <th>Contact</th>
                <th>Entreprise</th>
                <th>Numéro de téléphone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($not_interested_prospects as $not_interested_prospect)
                <tr>
                    <td>{{ $not_interested_prospect->name }}</td>
                    <td>{{ $not_interested_prospect->company }}</td>
                    <td>{{ $not_interested_prospect->phone_number ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucune donnée disponible dans le tableau</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
