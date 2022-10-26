<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Response;
use App\Traits\HttpResponses;

class TaskController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(["task" => Task::all()], "", 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated();
        $task = Task::create([
            'task_name' => $request->task_name,
            'task_details' => $request->task_details,
            'created_date' => $request->created_date,
            'category' => $request->category,
            'owner' => $request->owner
        ]);
        return $this->success(["task" => $task], "", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        if ($task) {
            return $this->success(["task" => $task], "", 200);
        }

        return $this->error('', 'Record not found', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreTaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, $id)
    {
        $request->validated();
        $task = Task::find($id);
        if ($task) {
            $task->update($request->all());
            return $this->success(["task" => $task], "", 200);
        }

        return $this->error('', 'Record not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task) {
            if ($task->delete()) {
                return $this->success([], "Delete Successfully", 200);
            }
        }

        return $this->error('', 'Record not found', 404);
    }
}
