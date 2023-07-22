<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table='task';
    protected $primaryKey='id';

    public function user(){

        return $this->hasOne('App\Models\User', 'task_id', 'id');
    }
}