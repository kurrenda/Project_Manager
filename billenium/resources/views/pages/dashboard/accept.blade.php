@extends('layouts.index')

@section('title', 'Akceptuj raporty')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Akceptuj raporty: </h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="text-center">
                            <tr>
                                <th scope="col">Liczba godzin</th>
                                <th scope="col">Pracownik</th>
                                <th scope="col">Projekt</th>
                                <th scope="col">Nazwa zadania</th>
                                <th scope="col">Komentarz zadania</th>
                                <th scope="col">Status</th>
                                <th scope="col">Data wysłania</th>
                                <th scope="col">Zarządzaj</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach($tasks as $key)
                                <tr>
                                    <td>{{$key->hours_worked}}</td>
                                    <td>{{$key->user->name}}</td>
                                    <td>{{$key->task->project->name}}</td>
                                    <td> {{$key->task->name}}</td>
                                    <td>{{$key->comment}}</td>
                                    @if($key->status == 1)
                                        <td>Zakończone</td>
                                    @else
                                        <td>W trakcie</td>
                                    @endif
                                    <td>{{$key->created_at}}</td>
                                    <td class="" style="width:270px">
                                        <div class="row">
                                            <div class="col-6">
                                                <form class="form" method="POST" action="{{route("acceptPost")}}">
                                                    @csrf
                                                    <input type="hidden" id="projectId" name="task_id" value="{{$key->task_id}}">
                                                    <input type="hidden" id="projectId" name="time" value="{{$key->hours_worked}}">
                                                    <input type="hidden" id="projectId" name="id" value="{{$key->id}}">
                                                    <p><button type="submit" class="btn btn-sm btn-success btn-block">Akceptuj</button></p>
                                                </form>

                                            </div>
                                            <div class="col-6 pl-0">
                                                <form class="form" method="POST" action="{{route("acceptDelete")}}">
                                                    @csrf
                                                    <input type="hidden" id="projectId" name="id" value="{{$key->id}}">
                                                    <p><button type="submit" onclick="return confirm('Jesteś pewny że chcesz odrzucić raport?')"  class="btn btn-sm btn-danger btn-block">Odrzuć</button></p>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
