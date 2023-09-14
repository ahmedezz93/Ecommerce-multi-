@extends('admin_layouts.master')

@section('page_name','edit product')

@section('content')
<form action="{{ route('update_product',$product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>


      <div class="form-group">
        <label for="exampleSelectRounded0">category</label>
        <select class="custom-select rounded-0" name="category_id" id="exampleSelectRounded0">
            @if ($categories)
            <option value="">choose category</option>
            @foreach ($categories as $category )
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach

            @endif
        </select>
        @error('category_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="exampleSelectRounded0">store</label>
        <select class="custom-select rounded-0" name="store_id" id="exampleSelectRounded0">
            @if ($stores)
            <option value="">choose store</option>
            @foreach ($stores as $store )
            <option value="{{ $store->id }}" {{ $product->store_id==$store->id ? 'selected' : '' }} >{{ $store->name }}</option>
            @endforeach

            @endif
        </select>
        @error('store_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>


      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" name="description" id="description" value="{{ $product->description ?? ''}}">
        @error('description')
        <div class="text-danger">{{ $message }}</div>
        @enderror

       </div>
      <div class="form-group">
        <label for="exampleInputFile">image</label>
        <div >
          <div >
            <input type="file" name="image"   id="image">
            <label  for="image">Choose file</label>
          </div>
        </div>
        @error('image')
        <div class="text-danger">{{ $message }}</div>
        @enderror

      </div>

      <div class="col-sm-6">
        <!-- radio -->
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="radio" id="form-check-label1" name="status" value="active" {{ $product->status== 'active' ?'checked' : ''  }}>
            <label for="form-check-label1" class="form-check-label1">active</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" id="form-check-label1" name="status" value="draft" {{ $product->status== 'draft' ?'checked' : ''  }}>
            <label for="form-check-label1" class="form-check-label1">draft</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio"  id="form-check-label2"  name="status" value="inactive" {{ $product->status== 'checked' ?'selected' : ''  }}>
            <label for="form-check-label2" class="form-check-label2">inactive </label>
          </div>
          @error('status')
          <div class="text-danger">{{ $message }}</div>
          @enderror

        </div>

        <div class="form-group">
            <label for="name">price</label>
            <input type="text" name="price" class="form-control" id="price" placeholder="price" value="{{ $product->price  }}">
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="name">compare price</label>
            <input type="text" name="compare_price" class="form-control" id="compare_price" value="{{ $product->compare_price ?? ''  }}">
            @error('compare_price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="tags">tags</label>
            <input type="text" name="tags" class="form-control" id="tags" value="{{ $tags   }}">
            @error('tags')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

      </div>
<div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

</form>

@endsection

@push('script')

@endpush
