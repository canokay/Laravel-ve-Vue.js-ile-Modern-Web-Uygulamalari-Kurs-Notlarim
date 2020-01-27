@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1>Yapılacaklar</h1>
        </div>

        <div class="card-body">
          <div class="list-group">
            @foreach($todos as $todo)
            <a href="{{ route('todos.toggle', $todo->id) }}" class="list-group-item list-group-item-action">
              @if($todo->completed_at) ✅ <del> @endif
                {{ $todo->text }}
                @if($todo->completed_at) </del> @endif
            </a>
            @endforeach
          </div>
        </div>
      </div>
      <br>
      <div class="card">
        <div class="card-header">
          <h1>Yeni Bir Görev Ekle</h1>
        </div>

        <div class="card-body">
          <form action="{{ route('todos.store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="todoLabel">Görev</label>
              <input type="text" class="form-control" id="todoLabel" aria-describedby="emailHelp" name="todo">
            </div>
            <button tpye="submit" class="btn btn-primary">Ekle</button>
            @error('todo')
            <br>{{$message}}
            @enderror
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection