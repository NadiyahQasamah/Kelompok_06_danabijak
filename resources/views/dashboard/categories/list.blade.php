@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">
  <div class="row">
    <div class="table-responsive shadow-sm p-3">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

        <a href="{{ route('categories.addPage') }}" class="btn btn-sm btn-primary mb-3">
          <i class="fas fa-plus"></i>
          Tambah Kategori
        </a>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama Kategori</th>
            <th scope="col">Type</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category->id_category }}</td>
            <td>{{ $category->name_category }}</td>
            <td>
              <!-- Displaying type as 'Expense' or 'Income' -->
              @if($category->type == 'expense')
                <span class="badge badge-danger">Expense</span>
              @elseif($category->type == 'income')
                <span class="badge badge-success">Income</span>
              @else
                <span class="badge badge-secondary">Unknown</span>
              @endif
            </td>
            <td>
              <!-- Edit Button -->
              <a href="{{ route('categories.editPage', $category->id_category) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
                Edit
              </a>
              <!-- Delete Button -->
              <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteCategory{{ $category->id_category }}">
                <i class="fas fa-trash-alt"></i> Hapus
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Delete Category Modal -->
@foreach($categories as $category)
<div class="modal fade" id="deleteCategory{{ $category->id_category }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategory{{ $category->id_category }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCategory{{ $category->id_category }}">Konfirmasi Hapus Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus kategori <strong>{{ $category->name_category }}</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('categories.delete', $category->id_category) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection
