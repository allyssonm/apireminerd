<?php

namespace Reminerd;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

	public $timestamps = false;

	protected $fillable = array('title', 'description', 'date', 'time', 'category_id');

    public function getTasks() {
        $tasks = $this->all();
        $data = [];

        foreach ($tasks as $t) {
            $t->category->color;
            $task = [
                'task' => $t
            ];
            array_push($data, $task);
        }

        return $response = [
            'tasks' => $data
        ];
    }

    public function getTask($id) {
        $task = $this->find($id);

        if($task) {
            $task->category->color;
            return $response = [
                'task' => $task
            ];
        }

        return $this->message('task not found', 404);        
    }

    public function storeTask($request) {
        $task = new Task();
		$task->fill($request->all());
        $task->save();
        
        $task->category->color;
        return $response = [
            'task' => $task
        ];
    }

    public function updateTask($request, $id) {
        $task = $this->find($id);

        if(!$task) {
            return $this->message('task not found', 404);
        }

        $task->fill($request->all());
        $task->save();

        $task->category->color;
        return $response = [
            'task' => $task
        ];
    }

    public function deleteTask($id) {
        $task = $this->find($id);

		if(!$task) {
			return $this->message('task not found', 404);
		}

		$task->delete();

		return $this->message('task has been excluded', 200);
    }

    private function message($message, $code) {
        return response()->json([
				'message' => $message,
		], $code);
    }

    public function category() {
		return $this->belongsTo('Reminerd\Category');
	}
}
