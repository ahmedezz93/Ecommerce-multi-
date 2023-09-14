<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index()
    {
        $products=Product::with(['category','store'])->get();
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories=Category::all();
        $stores=Store::all();

        return view('admin.products.create',compact('categories','stores'));

    }

    public function store(ProductRequest $request)
    {
        $request->validated();

        $request->merge(['slug'=>Str::slug($request->name)]);

      $product=Product::create($request->except('tags'));
      $tags=explode(',',$request->tags);

      foreach($tags as $value){
       $tag  =Tag::create([
            'name'=>$value,
            'slug'=>Str::slug($value),
         ]);
         $product->tags()->attach($tag);

      }
      return back()->with('created', 'created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $stores=Store::all();
        $tags=implode(',',$product->tags()->pluck('name')->toArray());
        return view('admin.products.edit', compact('categories', 'stores','product','tags'));

    }

    public function update(ProductRequest $request, Product $product)
    {
        $request->validated();

        $request->merge(['slug' => Str::slug($request->name)]);

        $product->update($request->except('tags'));

        $tags_value = explode(',', $request->tags);

        $tag_ids = [];
        foreach ($tags_value as $value) {
            $tag = Tag::where('name', $value)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $value,
                    'slug' => Str::slug($value),
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()
            ->route('products')
            ->with('updated', 'updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
