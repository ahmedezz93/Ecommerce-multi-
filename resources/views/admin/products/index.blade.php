@extends('admin_layouts.master')

@section('page_name','products')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
              <th>Name</th>
              <th>category</th>
              <th>Store</th>
              <th>Status</th>
              <th>created_at</th>
              <th>processess</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($products as $product )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('edit_product',$product->id) }}" class="btn btn-primary">edit</a>
                        <a href="{{ route('delete_product',$product->id) }}" class="btn btn-danger">delete</a>

                    </td>
                  </tr>
                @empty
                <tr>data not found</tr>
                @endforelse
            </tbody>

          </table>
        </div>
        <!-- /.card-body -->
      </div>

      <!-- /.card -->

      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
@endsection

@push('script')

@endpush
