<?php
namespace App\Repositories\TodoList;

use App\Interfaces\TodoList\TodoListRepositoryInterface;
use App\Models\TodoList;
use App\Services\TodoList\TodoListService;
use App\Events\TodoFetched;


class TodoListRepository implements TodoListRepositoryInterface
{
	public function create($data)
    {
        return (new TodoListService())->store($data);
    }

    public function all()
    {
    	$todo_lists = TodoList::all();
        event(new TodoFetched($todo_lists));
        return $todo_lists;
    }

    public function update($data)
    {
        return (new TodoListService())->update($data);
    }

    public function delete($id)
    {
        return (new TodoListService())->delete($id);
    }
}
