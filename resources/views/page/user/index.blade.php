@extends('layouts.app')

@section('title', 'User')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
        <p class="mb-4">Berikut merupakan data user</p>
        <a href="{{ route('user.create') }}" class="btn btn-primary mb-2">Tambah User</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%">No</th>
                                <th class="text-center" style="width: 35%">Nama</th>
                                <th class="text-center" style="width: 20%">Email</th>
                                <th class="text-center" style="width: 15%">role</th>
                                <th class="text-center" style="width: 25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user as $key => $data )
                                <tr>
                                    <td class="text-center">{{ $user->firstItem() + $key }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->role }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('user.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <a href="{{ route('user.show', $data->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                                            <a href="{{ route('user.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <input type="submit" class="btn btn-danger my-1 btn-sm show_confirm" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-danger">Data Kosong !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pull-left">
                        Showing
                        {{ $user->firstItem() }}
                        To
                        {{ $user->lastItem() }}
                        of
                        {{ $user->total() }}
                        {{-- TOTAL tidak bisa digunakan ketika pake simplePaginate--}}
                        entries
                    </div>
                    <div class="col float-right">
                        <div class="pagination-block float-right">
                            {{-- hapus class pagination-block, jika menggunakan simplePaginate --}}
                            {{-- hapus isi didalam kurung links, jika menggunakan simplePaginate --}}

                            {{ $user->links('layouts.paginate.paginationlinks') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

