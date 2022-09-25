@extends('layouts.master')

@section('head-scripts')
    <link rel="stylesheet" href="{{ asset('css/buy.css') }}">
@endsection

@section('content')
    <h2>Überprüfen der Bestellung</h2>

    <div class="grid-container">
        <section class="grid-column--12">
            <h4>Deine Produkte</h4>

            <table>
                <thead>
                    <tr>
                        <th>Bezeichnung</th>
                        <th>Einzelpreis</th>
                        <th>Stückzahl</th>
                        <th>Gesamtpreis</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($shoppingCart as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->getDiscountPriceEuro(), 2, ',', '.') }} €</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ number_format($product->getDiscountPriceEuro() * $product->quantity, 2, ',', '.') }} €</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($totalPrice, 2, ',', '.') }} €</td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="grid-column--6">
            <h4>Deine Daten</h4>

            <table>
                <tbody>

                    <tr>
                        <td>Name</td>
                        <td>{{ Auth::user()->forename . ' ' . Auth::user()->surname }}</td>
                    </tr>

                    <tr>
                        <td>E-Mail</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>

                    <tr>
                        <td>Adresse</td>
                        <td>{{ $userLocation->street . ' ' . $userLocation->street_number }}<br>
                            {{ $userLocation->postcode . ' ' . $userLocation->city }}</td>
                    </tr>

                </tbody>
            </table>
        </section>

        <section class="grid-column--6">
            <h4>Hinweise zum Ablauf der Bestellung</h4>

            <p>Aufgrund der begrenzten Kapazität, die durch die handgefertigte Produktion in unserer Schülerfirma entsteht,
            wird ein Mitarbeiter ihre Bestellung entgegennehmen und überprüfen, ob sie durch uns realisiert werden kann.</p>
            <p>Solle dies der Fall sein, werden Sie eine E-Mail von uns bekommen, in der wir Sie über das weitere Vorgehen
            sowie den voraussichtlichen Fertigstellungstermin informieren.</p>
            <b>Dieser Prozess kann bis zu einer Woche in Anspruch nehmen.</b>
        </section>
    </div>

    <a class="link-button" href="{{ route('checkout.success') }}">Bestellen</a>
@endsection
