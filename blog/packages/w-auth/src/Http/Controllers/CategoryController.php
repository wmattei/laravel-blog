<?php

namespace WAuth\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use WAuth\Category;
use WAuth\Mail\NewCategory;
use \WResponse;

class CategoryController extends Controller
{
    public function store(Request $request){

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'file' => ['mimes:jpeg,pdf,png,jpg']
        ])->validate();

        $category = $request->all();
        $file = $request->file('file');

        if (isset($file) && $file->isFile()){
            $path = $file->store('categories');
            $category['file_path'] = Storage::url($path);
        }
//        dd($category);

        Mail::to('wagner.mattei@gmail.com')->queue(new NewCategory());

        $category_saved = Category::query()->create($category);

        return WResponse::item($category_saved, [], "Salvo com sucesso!");

    }
}
