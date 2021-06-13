<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    //アップロードする際に必要なカラムを記載しておく
    protected $fillable = ["name", "price", "user_id", "file_name", "file_path"];
}
