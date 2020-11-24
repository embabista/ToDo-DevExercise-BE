<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{

    protected $table ="list";

    protected $fillable = ['title', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }
    public function list(){
        return $this->hasMany('App\Model\Task');
    }
}
