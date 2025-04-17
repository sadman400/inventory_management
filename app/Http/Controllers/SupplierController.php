<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function create_supplier (Request $request) {
        try {
            Supplier::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'supplier created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'supplier creation failed',
            ], 401);
        }
    }


    public function supplier_list (Request $request) {
        try {
            $suppliers = Supplier::all();
            return response()->json([
                'status' => 'success',
                'suppliers' => $suppliers,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unable to fetch suppliers',
            ], 401);
        }
    }


    public function supplier_by_id (Request $request) {
        try {
            $supplier_id = $request->input('id');
            $supplier = Supplier::where('id', $supplier_id)->get();
            return response()->json([
                'status' => 'success',
                'supplier' => $supplier,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unable to fetch supplier',
            ]);
        }
    }


    public function update_supplier (Request $request) {
        try {
            $supplier_id = $request->input('id');
            Supplier::where('id', $supplier_id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);
            return response()->json([
                'status' => 'success',
                'supplier' => Supplier::where('id', $supplier_id)->get(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unable to update supplier',
            ], 401);
        }
    }


    public function delete_supplier (Request $request) {
        try {
            $supplier_id = $request->input('id');
            Supplier::where('id', $supplier_id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'supplier deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'unable to delete supplier',
            ], 401);
        }
    }
}

