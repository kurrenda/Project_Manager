@extends('layouts.index')

@section('title', 'Strona Główna')

@section('content')

    <div class="row mt-5 justify-content-center">
        <div class="col-6">
            <h1 class="text-light text-center mb-5">PROJEKTY - STATYSTYKI:</h1>
            @foreach($projects as $p)
                <div class="card ">
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
                                <th scope="col">Pracownik</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach($userAdmin as $key)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$key->name}}</td>
                                    <td>{{$key->sum}}</td>
                                    @if($key->status == 1)
                                        <td>Zakończony</td>
                                    @else
                                        <td>W trakcie</td>
                                    @endif
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
                                        @if($key->status == 1)
                                            <td>Zakończony</td>
                                        @else
                                            <td>W trakcie</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endrole
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
    </div>
@endsection
