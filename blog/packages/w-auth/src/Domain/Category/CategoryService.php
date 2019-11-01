<?php

namespace WAuth\Domain\Category;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use WAuth\Mail\NewCategory;

class CategoryService
{
    public function store($model)
    {
        Validator::make($model, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'file' => ['mimes:jpeg,pdf,png,jpg']
        ])->validate();


        if (isset($model['file'])){
            $file = $model['file'];
            $path = $file-> store('categories');
            $model['file_path'] = Storage::url($path);
            $model['file'] = null;
        }

        $category_saved = Category::query()->create($model);

        Mail::to('wagner.mattei@gmail.com')->queue(new NewCategory($model)); // TODO Change to current use
        return \WResponse::item($category_saved, [], "Salvo com sucesso!");
    }
}
