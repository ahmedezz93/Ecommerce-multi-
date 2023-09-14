@extends('admin_layouts.master')

@section('page_name','edit category')

@section('content')

<form action="{{ route('update_category',$category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror


      </div>


      <div class="form-group">
        <label for="exampleSelectRounded0">Parent category</label>
        <select class="custom-select rounded-0" name="parent_id" id="exampleSelectRounded0">
            @if ($categories)
            <option value="">none</option>
            @foreach ($categories as $parent )
            <option value="{{ $parent->id }}" {{ $category->parent_id==$parent->id ? 'selected':''  }}>{{ $parent->name }}</option>
            @endforeach

            @endif
        </select>
        @error('parent_id')
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
        <label for="exampleInputFile">File input</label>
        <div >
          <div >
            <input type="file" name="image" id="image">
            <label for="image">image</label>
          </div>
          @error('image')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-sm-6">
        <!-- radio -->
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="radio" id="form-check-label1" name="status" value="active" {{ $category->status=='active' ? 'checked':''  }}>
            <label for="form-check-label1" class="form-check-label1">active</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio"  id="form-check-label2"  name="status" value="inactive" {{ $category->status=='inactive' ? 'checked':''  }}>
            <label for="form-check-label2" class="form-check-label2">inactive </label>
          </div>
          @error('status')
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
