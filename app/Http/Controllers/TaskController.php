<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }

    //
    public function index(Request $request){

        return Task::where('user_id', $request->header('user-id'))->orderBy('created_at','desc')->get();
    }

    public function show($id){
        return Task::findOrFail($id);

    }
    public function store(Request $request){

       $task = Task::create([
           'task'       => $request->task,
           'user_id'    => $request->user_id,
           'done'       => $request->done,
           'list_id'    => $request->list,
           'note'       => $request->note,
           'reminder'   => $request->reminder,
           'due_date'   => $request->due_date
      ]);

       return response()->json(['successfully added', $task]);

    }

    public function update(Request $request, $id){
        Task::where('id',$id)->update($request->all());
        return response()->json('Successfully updated', 200);
    }
    public function destroy($id){
        Task::destroy($id);
        return response()->json('Successfully deleted', 204);
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'task' => ['required'],
            'user_id' => ['required', 'exists:users,id']
        ]);
    }
}
