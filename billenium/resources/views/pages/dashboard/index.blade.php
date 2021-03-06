@extends('layouts.index')

@section('title', 'Strona Główna')

@section('content')

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-vh-100  justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Zaraportuj czas pracy</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('addTime')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Wybierz zadanie</label>
                                <select class="form-control" name="task" id="exampleFormControlSelect1">
                                    @foreach($tasks as $t)
                                        @if($t->project->status == 0)
                                    <option value="{{$t->id}}">{{$t->project->name}}: {{$t->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Status</label>
                                <select class="form-control" name="status" id="exampleFormControlSelect2">
                                    <option value="0">W trakcie</option>
                                    <option value="1">Zakończone</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Przepracowane godziny</label>
                                <input type="number"  min="0" class="form-control" name="time" placeholder="Wpisz liczbę przepracowanych godzin">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Komentarz</label>
                                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Wyślij</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
