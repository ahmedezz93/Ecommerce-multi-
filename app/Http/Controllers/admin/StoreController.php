<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::paginate(Store::number);
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
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

                $path = $file->storeAs('stores', $file_name, 'upload_files');
                $data['image'] = $path;
            }

            Store::create($data);
            DB::commit();
            return back()->with('created', 'created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('wrong', $e->getmessage());
        }
    }

    public function edit(Store $store)
    {
        return view('admin.stores.edit',compact('store'));
    }

    public function update(StoreRequest $request, $id)
    {
        $request->validated();

        try {
            DB::begintransaction();
            $category = Store::findOrFail($id);

            //request merge
            $request->merge([
                'slug' =>   Str::slug($request->name),
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

                $path = $new_file->storeAs('stores', $file_name, 'upload_files');

                $data['image'] = $path;
            }

            $category->update($data);
            DB::commit();
            return redirect()
                ->route('stores')
                ->with('updated', 'updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('wrong', $e->getmessage());
        }
    }

    public function destroy(Store $store)
    {
        $store->delete();
        //check if this category has image
        if (!$store->image) {
            return redirect()
                ->route('stores')
                ->with('deleted', 'deleted successfully');
        }

        //check if this category has image on server
        $exists = Storage::disk('upload_files')->exists($store->image);

        if ($exists) {
            //delete this image from sever
            $exists = Storage::disk('upload_files')->delete($store->image);
        }
        return redirect()
            ->route('stores')
            ->with('deleted', 'deleted successfully');
    }
}
