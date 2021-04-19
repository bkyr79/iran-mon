<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";

    //アップロードする際に必要なカラムを記載しておく
    protected $fillable = ["user_id", "file_name", "file_path", "file_size"];
}
