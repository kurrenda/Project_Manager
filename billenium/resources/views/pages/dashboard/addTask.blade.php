@extends('layouts.index')

@section('title', 'Dodaj zadanie')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Dodaj zadanie</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('addTaskPost')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect21">Wybierz pracownika</label>
                                <select class="form-control" name="user" id="exampleFormControlSelect21">
                                    @foreach($users as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nazwa zadania</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Opis</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Dodaj</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
