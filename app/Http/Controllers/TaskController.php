<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
  public function index() {
    $task = Task::all();
    return view('tasks.index', ['tasks'=>$task]);
  }
  public function save(Request $request) {
    $this->validate($request, [
      'name' => 'required|max:255',
    ]);
    $task = new Task();
    $task->name = $request->input('name');
    $task->status = 0;
    $task->category_id = $request->input('category_id');
    $task->save();
    return redirect('/tasksPage');
  }
  public function update(Request $request) {
    $id = $request->input('task_id');
    if ($id == true) {
      $task = Task::find($id);
      $task->status = 1;
      $task->save();
      return redirect('/tasksPage');
    }
    else if ($id == null) {
      $task->status = 0;
      $task->save();
      return redirect('/tasksPage');
    }

  }
}
