<?php
namespace App\Interfaces\TodoList;

interface TodoListRepositoryInterface
{
	public function all();

	public function create($data);

	public function update($data);

	public function delete($data);

}

 ?>