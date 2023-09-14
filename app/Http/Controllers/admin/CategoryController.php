<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index()
    {
        //get all categories with number of products and products must be active
        $categories = Category::with('parent')->withCount(['products'=>function($query){

            $query->where('status','active');
        }])->paginate(Category::number);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();
            //request of slug merge
            $request->merge([
                'slug' => Str::slug($request->name),
            ]);

            //all data except image file
            $data = $request->except(['image']);

            // if image exist insert into server and db
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $file_name = $file->getClientOriginalName();

                $path = $file->storeAs('categories', $file_name, 'upload_files');
                $data['image'] = $path;
            }

            Category::create($data);
            DB::commit();
            return back()->with('created', 'created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('wrong', $e->getmessage());
        }
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $request->validated();
        try {
            DB::begintransaction();
            $category = Category::findOrFail($id);

            //parent category must be not the same category
            if ($category->id == $request->parent_id) {
                return redirect()
                    ->back()
                    ->with('deleted', 'cant add this parent category');
            }
            //request merge
            $request->merge([
                'slug' => Str::slug($request->name),
            ]);

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $new_file = $request->file('image');

                $file_name = $new_file->getClientOriginalName();
                 //delete old image
                if ($category->image) {
                    //check if this category has image on server
                    $exists = Storage::disk('upload_files')->exists($category->image);

                    if ($exists) {
                        //delete this image from sever
                        $exists = Storage::disk('upload_files')->delete($category->image);
                    }
                }

                $path = $new_file->storeAs('categories', $file_name, 'upload_files');

                $data['image'] = $path;
            }

            $category->update($data);
            DB::commit();
            return redirect()
                ->route('categories')
                ->with('updated', 'updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('wrong', $e->getmessage());
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        //check if this category has image
        if (!$category->image) {
            return redirect()
                ->route('categories')
                ->with('deleted', 'deleted successfully');
        }

        //check if this category has image on server
        $exists = Storage::disk('upload_files')->exists($category->image);

        if ($exists) {
            //delete this imagr from sever
            $exists = Storage::disk('upload_files')->delete($category->image);
        }
        return redirect()
            ->route('categories')
            ->with('deleted', 'deleted successfully');
    }
}
