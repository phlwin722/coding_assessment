<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function create(ProductRequest $productRequest)
    {
        try {
            $data = $productRequest->validated();

            $product = Product::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'category' => $data['category'],
                'date_time' => $data['date_time'],
            ]);

            if ($productRequest->hasFile('image')) {
                $file = $productRequest->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                $folderPath = public_path('assets/product/' . $product->id);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }

                $file->move($folderPath, $filename);

                $filePath = "assets/product/{$product->id}/{$filename}";

                $product->update([
                    'image' => $filePath
                ]);
            }

            return response()->json([
                'message' => 'Product created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $product = Product::orderBy('created_at', 'desc')->get();
            return response()->json([
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(ProductRequest $productRequest, $id)
    {
        try {
            $data = $productRequest->validated();

            $product = Product::findOrFail($id);
            $product->update([
                'name' => $data['name'],
                'category' => $data['category'],
                'description' => $data['description'],
                'date_time' => $data['date_time']
            ]);

            if ($productRequest->hasFile('image')) {

                $oldImagePath = public_path($product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $file = $productRequest->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                $folderPath = public_path('assets/product/' . $product->id);

                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }

                $file->move($folderPath, $filename);

                $filePath = "assets/product/{$product->id}/{$filename}";

                $product->update([
                    'image' => $filePath
                ]);
            }


            return response()->json([
                'message' => "Updated successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->image) {
                $oldImagePath = public_path($product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $product->delete();

            return response()->json([
                'messasge' => 'Deleted Sucessfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function findData($id)
    {
        try {
            $product = Product::findOrFail($id);

            $imageUrl = $product->image ? asset($product->image) : null;

            return response()->json([
                'data' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'image' => $imageUrl,
                    'category' => $product->category,
                    'date_time' => $product->date_time,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
