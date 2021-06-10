<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoList\{StoreRequest, UpdateRequest};
use App\Interfaces\TodoList\TodoListRepositoryInterface;
use App\Http\Resources\TodoList\TodoListResource;

class TodoListController extends Controller
{
    private $todolistRepository;

    /**
     * @param TodoListRepositoryInterface $todolistRepository
     *
     */
    public function __construct(TodoListRepositoryInterface $todolistRepository)
    {
        $this->todolistRepository = $todolistRepository;
    }

    /**
     * @param StoreRequest $request
     *
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $todolist = $this->todolistRepository->create($data);
            return response()->json([
                [
                    'status' => true,
                    'message' => 'Todo List Created Successfully!',
                    'data' => (new TodoListResource($todolist)),
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage(),
            ], 403);
        }
    }

    /** Gets all todo lists
     *
     */
    public function fetch()
    {
        try {
            $data = $this->todolistRepository->all();
            return response()->json([
                [
                    'status' => true,
                    'message' => 'Todo Lists Fetched Successfully!',
                    'data' => TodoListResource::collection($data),
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ], 403);
        }
    }

     /**Updates an existing todo list
     *
     * @param UpdateRequest $request
     *
     */
    public function update(UpdateRequest $request)
    {
        try {
            $data = $request->validated();
            $todolist = $this->todolistRepository->update($data);
            return response()->json([
                [
                    'status' => true,
                    'message' => 'Todo List Updated Successfully!',
                    'data' => (new TodoListResource($todolist)),
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ], 403);
        }
    }

    /** Deletes a todo
     *
     */
    public function delete($id)
    {
        try {
            $todolist = $this->todolistRepository->delete($id);
            return response()->json([
                [
                    'status' => true,
                    'message' => 'Todo Deleted Successfully!',
                    'data' => null,
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ], 403);
        }
    }

}
