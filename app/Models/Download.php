<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Download extends Model
{
    use Sortable;
    use \Conner\Tagging\Taggable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that are sortable.
     *
     * @var array<int, string>
     */    
    public $sortable = [
        'id', 
        'name', 
        'email'
    ];
}
