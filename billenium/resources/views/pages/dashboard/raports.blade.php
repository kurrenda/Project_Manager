@extends('layouts.index')

@section('title', 'Zarządzaj pracownikami')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-6">
                @hasanyrole('Admin|Team Leader')
                    @foreach($raportsAll as $key=>$value)
                        <div class="card mb-5">
                            <div class="card-header text-center">
                                <h3>Raport miesięczny: {{$key}} </h3>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="text-center">
                                    <tr>
                                        <th scope="col">Rok</th>
                                        <th scope="col">Miesiąc</th>
                                        <th scope="col">Ilość przepracowanych godzin</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($value as $k)
                                        <tr>
                                            <td>{{$k->year}}</td>
                                            <td>{{$k->month}}</td>
                                            <td>{{$k->sum}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($raports as $key)
                        <div class="card">
                            <div class="card-header text-center">
                                <h3>Twoje raporty miesięczne: </h3>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="text-center">
                                    <tr>
                                        <th scope="col">Rok</th>
                                        <th scope="col">Miesiąc</th>
                                        <th scope="col">Ilość przepracowanych godzin</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($key as $k)
                                        <tr>
                                            <td>{{$k->year}}</td>
                                            <td>{{$k->month}}</td>
                                            <td>{{$k->sum}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endhasanyrole
            </div>
        </div>
    </div>

    {{$raports}}
@endsection
