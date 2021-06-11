<?php

namespace App\Http\Resources\TodoList;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'id' => $this['id'] ?? null,
                'name' => $this['name'] ?? null,
                'description' => $this['description'] ?? null,
                'status' => $this['status'] ?? null,
        ];
    }
}
