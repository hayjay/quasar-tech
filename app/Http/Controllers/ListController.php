<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use App\Http\Requests\TodoList\{StoreRequest};
use App\Helpers\APiHelpers;

class TodoListController extends Controller
{
    /**
     * @param ListService $list_service
     *
     * @return Application|ResponseFactory|Response
     */
    public function store(StoreRequest $request, ListService $list_service)
    {
        return APiHelpers::ApiResponseFormat(
            $list_service->create($request->all())
        );
    }

}
