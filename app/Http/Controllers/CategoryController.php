<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        //All Category Data
       return $category = Category::withCount('jobs')->get();
        return response([
            'data' => $category,
        ], 200);
    }
    
    public function store(Request $request)
    {

        $fields = $request->validate([
            'title' => 'required|string|unique:categories,title'
        ]);
        $data = Category::create([
            'title' => $fields['title'],
        ]);
        $response = [
            'message' => 'Category Created Successfully',
            'data' => $data,
        ];

        return response($response, 201);
    }
}
