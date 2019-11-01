<?php

namespace WAuth\Domain\Category\Http\Controller;


use Illuminate\Http\Request;
use WAuth\Domain\Category\Category;
use WAuth\Domain\Category\CategoryService;
use WAuth\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * @var CategoryService
     */
    protected $service;

    function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
    public function store(Request $request){
        return $this->service->store($request->all());
    }
}
