<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function area()
    {
        return $this->belongsTo(Area::class); //belongsTo属する
    }

    public function routes()
    {
      return $this->belongsToMany(Route::class);//相手のクラス名。Rputeモデルに紐づく
    }
}
