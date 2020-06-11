@extends('layouts.index')

@section('title', 'Edytuj uprawnienia')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Edytuj pracownika</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('editAuthPost', $users->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect21">Rola</label>
                                <select class="form-control" name="role" id="exampleFormControlSelect21" value="{{$users->roles[0]->id}}">
                                    @foreach($roles as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Imię i Nazwisko</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$users->name}}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$users->email}}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Nowe hasło (wypełnij jeśli chcesz zmienić)</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Potwierdź nowe hasło (wypełnij jeśli chcesz zmienić)</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-primary">Akceptuj zmiany</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
