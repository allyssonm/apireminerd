<?php

namespace Reminerd;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = array('id', 'title', 'description', 'date', 'time', 'category_id');

    public function getTasks()
    {
        $tasks = Task::with('category.color')->get();

        return $response = [
            'tasks' => $tasks
        ];
    }

    public function getTask($id)
    {
        $task = Task::with('category.color')->find($id);

        if ($task) {
            return $response = [
                'task' => $task
            ];
        }

        return $this->message('task not found', 404);
    }

    public function storeTask($request)
    {
        $task = new Task();
        $task->fill($request->all())->save();

        return $response = [
            'task' => Task::with('category.color')->find($task->id)
        ];
    }

    public function updateTask($request, $id)
    {
        $task = Task::with('category.color')->find($id);

        if (!$task) {
            return $this->message('task not found', 404);
        }

        $task->fill($request->all())->save();

        return $response = [
            'task' => $task
        ];
    }

    public function deleteTask($id)
    {
        $task = $this->find($id);

        if (!$task) {
            return $this->message('task not found', 404);
        }

        $task->delete();

        return $this->message('task has been excluded', 200);
    }

    private function message($message, $code)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    public function category()
    {
        return $this->belongsTo('Reminerd\Category');
    }
}
