<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request)
    {
        $request->validate(
            [
                'category_name_en' => 'required',
                'category_name_id' => 'required',
                'category_icon' => 'required',
            ],
            [
                'category_name_en.required' => 'Input Category English Name',
                'category_name_id.required' => 'Input Category Indonesia Name',
                'category_icon.required' => 'Input Category Icon',
            ]
        );

        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_id' => $request->category_name_id,
            'category_slug_en' => strtolower(str_replace(' ', '-', 'category_name_en')),
            'category_slug_id' => str_replace(' ', '-', 'category_name_id'),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request)
    {
        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_id' => $request->category_name_id,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_id' => str_replace(' ', '-', $request->category_name_id),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function CategoryDelete($id)
    {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
