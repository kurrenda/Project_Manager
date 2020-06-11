@extends('layouts.index')

@section('title', 'Dodaj projekt')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-6">
                @if(count($errors))
                    <div class="alert alert-danger">
                        <strong>Błąd!</strong> Wypełnij wszystkie pola
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Dodaj projekt</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('addProjectPost')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nazwa projektu</label>
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
