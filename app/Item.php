<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";
    protected $fillable = ["file_name", "file_path", "file_size"];
}
