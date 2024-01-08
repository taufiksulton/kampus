@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Program Pendidikan (Prodi)</h1>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="container">
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-create">Create</a>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Prodi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prodi as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['prodi'] }}</td>
                        <td class="d-flex">
                            <a href="#" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#modal-edit" data-id="{{ $item['id'] }}" data-prodi="{{ $item['prodi'] }}" onClick="edit(this);">Edit</a>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('prodi.destroy', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Data Masih Kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-create">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ URL('prodi') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Prodi</label>
                        <input type="text" class="form-control" name="prodi" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-edit">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update" method="POST" action="{{ URL('prodi') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="prodi_update" name="prodi" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function edit(oButton){
        var link = "{{ URL('prodi') }}/";
        var id = oButton.getAttribute('data-id');

        document.getElementById('form_update').action = link+id;
        document.getElementById('prodi_update').value = oButton.getAttribute('data-prodi');
    }
</script>

@endsection