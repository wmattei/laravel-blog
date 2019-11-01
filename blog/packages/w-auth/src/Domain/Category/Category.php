<?php

namespace WAuth\Domain\Category;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['name', 'description', 'file_path'];

}
