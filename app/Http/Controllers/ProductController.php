<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create_product (Request $request) {
        try {
            $category_id = $request->input('category_id');
            Product::create([
                'name' => $request->input('name'),
                'sku' => $request->input('sku'),
                'category_id' => $category_id,
                'description' => $request->input('description'),
                'cost_price' => $request->input('cost_price'),
                'selling_price' => $request->input('selling_price'),
                'stock_quantity' => $request->input('stock_quantity'),
                'reorder_level' => $request->input('reorder_level')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'product created successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'product creation failed',
            ], 500);
        }
    }


    public function product_list (Request $request) {
        try {
            $products = Product::get();
            return response()->json([
                'status' => 'success',
                'products' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unable to fetch products'
            ], 401);
        }
    }


    public function product_by_id (Request $request) {
        try {
            $product_id = $request->input('id');
            $product = Product::where('id', $product_id)->get();
            return response()->json([
                'status' => 'success',
                'product' => $product,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'product not found',
            ], 401);
        }
    }


    public function update_product (Request $request) {
        try {

            $product_id = $request->input('id');
            Product::where('id', $product_id)->update([
                'name' => $request->input('name'),
                'sku' => $request->input('sku'),
                'description' => $request->input('description'),
                'cost_price' => $request->input('cost_price'),
                'selling_price' => $request->input('selling_price'),
                'stock_quantity' => $request->input('stock_quantity'),
                'reorder_level' => $request->input('reorder_level'),
            ]);
            return response()->json([
                'status' => 'success',
                'product' => Product::where('id', $product_id)->get(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to update product',
            ], 401);
        }
    }


    public function delete_product (Request $request) {
        try {
            $product_id = $request->input('id');
            Product::where('id', $product_id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'product deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unable to delete product',
            ], 401);
        }
    }
}
