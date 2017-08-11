<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add task</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <div id="tasks"></div>
    <div id="app">

    </div>
    <form class="form" action="/save" method="post">
      <label for="name">Task name</label><br/>
      <input type="text" class="input" name="name"><br/><br/>
      <button type="submit" name="add">Add</button>
      {{ csrf_field() }}
    </form>
    <ul>
    @foreach($tasks as $task)
      <li "@if ($task->status == 1)
      style="text-decoration: line-through;"
      @endif">{{$task->name}}
        <form action="/update" method="post">
          <input class="submit" value="{{$task->id}}" name="task_id" type="checkbox"
          @if ($task->status == 1)
          checked onclick="return false"
          @endif
          onChange="this.form.submit()">
          {{ csrf_field() }}
        </form>
      </li>
    @endforeach
  </ul>
    <img class="thinking" src="http://et-38d7.kxcdn.com/twitter-svg/1f914.svg" alt="thinking">
    <script type="text/javascript" src="/js/app.js"></script>
  </body>
</html>
