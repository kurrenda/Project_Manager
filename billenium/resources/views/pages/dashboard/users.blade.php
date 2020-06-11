@extends('layouts.index')

@section('title', 'Zarządzaj pracownikami')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Zarządzaj pracownikami: </h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Imię nazwisko</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Rola</th>
                                <th scope="col">Zarządzaj</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach($users as $key)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$key->name}}</td>
                                    <td>{{$key->email}}</td>
                                    <td class="pr-4">{{$key->roles[0]->name}}</td>
                                    <td class="" style="width:370px">
                                        <div class="row">
                                            <div class="col-6">
                                                <p><a href="{{route("editAuthUser", $key->id)}}" class="btn btn-sm btn-success btn-block m-0">Edytuj</a></p>
                                            </div>
                                            <div class="col-6">
                                                <form class="form" method="POST" action="{{route('editAuthDelete')}}">
                                                    @csrf
                                                    <input type="hidden" id="projectId" name="id" value="{{$key->id}}">
                                                    <p><button type="submit" onclick="return confirm('Jesteś pewny że chcesz usunąć?')"  class="btn btn-sm btn-danger btn-block">Usuń pracownika</button></p>
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
