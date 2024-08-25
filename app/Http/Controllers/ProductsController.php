<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){

        //get all products
        $products = Product::get();

        return response()->json([
            'products'=> $products
        ],200);
    }

    public function store(){

        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'image' => 'required|image',
            'brand' => 'required',
            'rating' => 'required|numeric|min:1|max:5',

        ]);
        try {

            //get file name
            if(request()->hasFile('image')){
                $file = request()->file('image');
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);

                 // Store the file path in the database
                $filePath = 'uploads/' . $filename;
            }

            //store
           $product =  Product::create([
                'name' => request('name'),
                'description' => request('description'),
                'price' => request('price'),
                'image' => $filePath,
                'brand' => request('brand'),
                'rating' => request('rating'),
            ]);

            return response()->json([
                'message' => 'successfully created a product.',
                'product' => $product,
            ]);

        }catch (\Exception $e){
            return response()->json([
                'message' => 'someting went wrong!'
            ], 500);

        }
    }

}
