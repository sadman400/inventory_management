<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create_category (Request $request) {
        try {
            $field = $request->validate([
            'name' => 'required'
            ]);
            Category::create($field);
            return response()->json([
                'status' => 'success',
                'message' => 'category created successfully',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'category creation failed',
            ], 401);
        }
    }


    public function category_list (Request $request) {
        return Category::get();
    }


    public function category_by_id (Request $request) {
        try {
            $category_id = $request->input('id');
            $category = Category::where('id', $category_id)->get();
            return response()->json([
                'status' => 'success',
                'category' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found',
            ], 401);
        }
    }


    public function update_category (Request $request) {
        try {
            $category_id = $request->input('id');
            $request->validate([
                'name' => 'required'
            ]);
            return Category::where('id', $category_id)->update([
                'name' => $request->name
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unable to update',
            ], 401);
        }
    }


    public function delete_category (Request $request) {
        $category_id = $request->input('id');
        Category::where('id', $category_id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'category deleted successfully',
        ], 200);
    }
}
