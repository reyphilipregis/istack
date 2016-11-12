<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'message'
    ];

    /**
     * The name of the table in the database.
     *
     * @var string
     */
    protected $table = 'templates';
}
