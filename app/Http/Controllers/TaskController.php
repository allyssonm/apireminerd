<?php

namespace Reminerd\Http\Controllers;

use Reminerd\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = new Task();
        return $tasks->getTasks();
    }

    public function show($id) {
        $task = new Task();
        return $task->getTask($id);        
    }

    public function store(Request $request) {
        $task = new Task();        
        return $task->storeTask($request);
    }

    public function update(Request $request, $id) {
        $task = new Task();
        return $task->updateTask($request, $id);
    }

    public function destroy($id) {
        $task = new Task();
        return $task->deleteTask($id);
    }
}
