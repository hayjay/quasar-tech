<?php
namespace App\Services\TodoList;

use App\Models\TodoList;
use App\Events\{TodoCreated, TodoUpdated, TodoDeleted};

class TodoListService
{

    public function store($data) : object {
    	$todo = TodoList::create([
    		'name' => $data['name'],
    		'description' => $data['description'],
    		'status' => $data['status'],
    		'created_by' => auth()->user()->id,
    	]);
        event(new TodoCreated($todo));
    	return $todo;
    }

    public function update($data) : object {
    	$todo = TodoList::find($data['id']);
    	$todo->fill($data);
        event(new TodoUpdated($todo));
    	$todo->save();
    	return $todo;
    }

    public function delete($id) {
    	$todo = TodoList::find($id);
    	$todo->delete($id);
        event(new TodoDeleted($todo));
    	return;
    }
}


 ?>