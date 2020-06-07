@extends('layouts.index')

@section('title', 'Strona Główna')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Postęp zadań: </h3>
                    </div>
                    <div class="card-body">
                        @role('Team Leader')
                        <table class="table">
                            <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Zadanie</th>
                                <th scope="col">Godziny poświęcone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pracownik ID</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach($userAdmin as $key)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$key->name}}</td>
                                <td>{{$key->sum}}</td>
                                <td>{{$key->status}}</td>
                                <td>{{$key->user}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <table class="table">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Zadanie</th>
                                    <th scope="col">Godziny poświęcone</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($userTask as $key)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$key->name}}</td>
                                        <td>{{$key->sum}}</td>
                                        <td>{{$key->status}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
{{$userTask}}
    </div>
@endsection
