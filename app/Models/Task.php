<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table ="tasks";

    protected $fillable = ['task', 'user_id', 'list_id', 'note', 'reminder', 'due_date'];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }
    public function list(){
        return $this->belongsTo('App\Model\TaskList');
    }
}
