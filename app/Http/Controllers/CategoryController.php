<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withTrashed()->get();
        return view('admin.dashboard.category' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', 
            ]);
    
            $imagePath = $request->file('image')->store('category_images', 'public');
    
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imagePath,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully!',
                'redirect' => route('category.index'),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $category = Category::findOrFail($id); // Find the category or return 404

    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', 
    ], [
        'image.max' => 'The image size must not exceed 5MB.',
    ]);

    // Check if a new image file is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image file if it exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Save the new image file
        $imagePath = $request->file('image')->store('category_images', 'public');
        $category->image = $imagePath; // Update the image path
    }

    // Update the category details
    $category->name = $request->name;
    $category->description = $request->description;
    $category->save();

    // Return JSON response
    return response()->json([
        'success' => true,
        'message' => 'Category updated successfully!',
        'redirect' => route('category.index'), // Redirect URL after successful update
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
{
    
    if ($category->image && Storage::exists('public/category_images/' . $category->image)) {
        Storage::delete('public/category_images/' . $category->image);
    }

    
    $category->delete();

    
    return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
}
public function restore($id)
{
    // Retrieve the soft-deleted user
    $category = Category::onlyTrashed()->findOrFail($id);

    // Restore the user
    $category->restore();

    // Redirect back with a success message
    return redirect()->route('category.index')->with('success', 'User restored successfully!');
}
}
