@extends('admin_layouts.master')

@section('page_name','stores')

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
              <th>Slug</th>
              <th>Status</th>
              <th>Description</th>
              <th>image</th>
              <th>processess</th>
            </tr>
            </thead>
            <tbody style="text-align: center">
                @forelse ($stores as $store )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->slug }}</td>
                    <td>{{ $store->status }}</td>
                    <td>{{ $store->description }}</td>
                    <td><img style="width:100px;height:50px;" src="{{ asset('storage/'.$store->image) }}" alt=""></td>
                    <td>
                        <a href="{{ route('edit_store',$store->id) }}" class="btn btn-primary">edit</a>
                        <a href="{{ route('delete_store',$store->id) }}" class="btn btn-danger">delete</a>

                    </td>

                  </tr>

                @empty
                 data not found
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
  {{ $stores->links() }}
@endsection

@push('script')

@endpush
