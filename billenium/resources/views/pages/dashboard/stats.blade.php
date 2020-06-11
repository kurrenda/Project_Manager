@extends('layouts.index')

@section('title', 'Strona Główna')

@section('content')

        <div class="row mt-5 justify-content-center">
            <div class="col-6">
                <h1 class="text-light text-center mb-5">PROJEKTY - STATYSTYKI:</h1>
                @hasanyrole('Admin|Team Leader')
                @foreach($projects as $p)
                    <div class="card mb-5">
                        <div class="card-header text-center">
                            <h3>{{$p->name}}</h3>

                            <span class="badge badge-primary badge-pill">{{$p->hours}}</span>
                            @if($p->status == 0)
                                <br>
                                <span class="badge badge-success">Otwarty</span>

                            @else
                                <br>
                                <span class="badge badge-warning">Zamknięty</span>

                            @endif

                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ZADANIE</th>
                                    <th scope="col">PRZYPISANY DO</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">OPIS</th>

                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($p->tasks as $key)
                                    <tr class="pb-0 bg-info table-borderless">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$key->name}}</td>
                                        <td> {{$key->user->name}}</td>
                                        @if($key->status == 1)
                                            <td>Zakończony</td>
                                        @else
                                            <td>W trakcie</td>
                                        @endif
                                        <td>{{$key->description}}</td>
                                    </tr>
                                    <tr class="table-dark">
                                        <th scope="col">Zaraportował</th>
                                        <th scope="col">Godzin</th>
                                        <th scope="col">Data</th>
                                        <th colspan="2" scope="col">Komentarz</th>

                                    </tr>
                                    @foreach($key->taskLogs as $t)
                                        @if($t->accepted == 1)
                                    <tr class="table-dark table-borderless" >
                                        <td>
                                            {{$t->user->name}}
                                        </td>
                                        <td>
                                            {{$t->hours_worked}}
                                        </td>
                                        <td>
                                            {{$t->created_at}}
                                        </td>
                                        <td colspan="2">
                                            {{$t->comment}}
                                        </td>
                                    </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @role('Team Leader')
                        @if($p->status != "1")
                        <div class="card-footer">
                            <form class="form" method="POST" action="{{route('closeProject')}}">
                                @csrf
                                <input type="hidden" id="projectId" name="id" value="{{$p->id}}">
                                <p><button type="submit" onclick="return confirm('Jesteś pewny że chcesz zamknąć projekt?')"  class="btn btn-sm btn-danger btn-block">Zamknij projekt</button></p>
                            </form>
                        </div>
                        @endif
                        @endrole
                    </div>
                @endforeach
                @else
                    @foreach($projectsUser as $p)
                        <div class="card mb-5">
                            <div class="card-header text-center">
                                <h3>{{$p->name}}</h3>

                                <span class="badge badge-primary badge-pill">{{$p->hours}}</span>
                                @if($p->status == 0)
                                    <br>
                                    <span class="badge badge-success">Otwarty</span>

                                @else
                                    <br>
                                    <span class="badge badge-warning">Zamknięty</span>

                                @endif

                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="text-center">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ZADANIE</th>
                                        <th scope="col">PRZYPISANY DO</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">OPIS</th>

                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($p->tasks as $key)
                                        <tr class="pb-0">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$key->name}}</td>
                                            <td> {{$key->user->name}}</td>
                                            @if($key->status == 1)
                                                <td>Zakończony</td>
                                            @else
                                                <td>W trakcie</td>
                                            @endif
                                            <td>{{$key->description}}</td>
                                        </tr>
                                        <tr class="table-dark">
                                            <th scope="col">Zaraportował</th>
                                            <th scope="col">Godzin</th>
                                            <th scope="col">Data</th>
                                            <th colspan="2" scope="col">Komentarz</th>

                                        </tr>
                                        @foreach($key->taskLogs as $t)
                                            <tr class="table-dark table-borderless" >
                                                <td>
                                                    {{$t->user->name}}
                                                </td>
                                                <td>
                                                    {{$t->hours_worked}}
                                                </td>
                                                <td>
                                                    {{$t->created_at}}
                                                </td>
                                                <td colspan="2">
                                                    {{$t->comment}}
                                                </td>
                                            </tr>
                                        @endforeach
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
@endsection
