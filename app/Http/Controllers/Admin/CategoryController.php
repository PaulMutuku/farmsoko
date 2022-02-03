<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\OrderItem;


class CategoryController extends Controller
{
    public function Index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function insert(Request $request)
    {
        $category = new Category();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }

        $category->name = $request->Input('name');
        $category->slug = $request->Input('slug');
        $category->description = $request->Input('description');
        $category->status = $request->Input('status') == TRUE?'1':'0';
        $category->popular = $request->Input('popular') == TRUE?'1':'0';
        $category->meta_title = $request->Input('meta_title');
        $category->meta_keyword = $request->Input('meta_keyword');
        $category->meta_descrip = $request->Input('meta_description');
        $category->save();
        return redirect('/dashboard')->with('status',"Category added successfully");
        
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($request->hasFile('image')) 
        {
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }

        $category->name = $request->Input('name');
        $category->slug = $request->Input('slug');
        $category->description = $request->Input('description');
        $category->status = $request->Input('status') == TRUE?'1':'0';
        $category->popular = $request->Input('popular') == TRUE?'1':'0';
        $category->meta_title = $request->Input('meta_title');
        $category->meta_keyword = $request->Input('meta_keyword');
        $category->meta_descrip = $request->Input('meta_description');
        $category->update();
        return redirect('dashboard')->with('status',"Category updated successfully");
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category->image)
        {
            $path = 'assets/uploads/category/'.$category->image;
            if (File::exists($path)) 
            {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('categories')->with('status',"Category Deleted Succesfully");
    }
}
