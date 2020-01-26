<ul>
  @foreach ($todos as $todo)
  <li>
    <a href="{{ route('todos.toggle', $todo->id) }}">
      @if($todo->completed_at) ✅ <del> @endif
        {{ $todo->text }}
        @if($todo->completed_at) </del> @endif
    </a>
  </li>
  @endforeach
</ul>
<form action="{{ route('todos.store') }}" method="post">
  @csrf
  <input type="text" name="todo" />
  <button type="submit">Ekle</button>
  @error('todo')
  <br>{{$message}}
  @enderror
</form>