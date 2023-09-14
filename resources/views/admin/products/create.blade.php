@extends('admin_layouts.master')

@section('page_name','add product')

@section('content')
<form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="product name">
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
            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
            <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach

            @endif
        </select>
        @error('store_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>


      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" name="description" id="description" placeholder="description">
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
            <input class="form-check-input" type="radio" id="form-check-label1" name="status" value="active">
            <label for="form-check-label1" class="form-check-label1">active</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" id="form-check-label1" name="status" value="draft">
            <label for="form-check-label1" class="form-check-label1">draft</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio"  id="form-check-label2"  name="status" value="inactive" >
            <label for="form-check-label2" class="form-check-label2">inactive </label>
          </div>
          @error('status')
          <div class="text-danger">{{ $message }}</div>
          @enderror

        </div>

        <div class="form-group">
            <label for="name">price</label>
            <input type="text" name="price" class="form-control" id="price" placeholder="price">
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="name">compare price</label>
            <input type="text" name="compare_price" class="form-control" id="compare_price" placeholder="compare price">
            @error('compare_price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="tags">tags</label>
            <input type="text" name="tags" class="form-control" id="tags" placeholder="tags">
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
