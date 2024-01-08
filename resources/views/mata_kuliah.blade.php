@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Mata Kuliah</h1>
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
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mata_kuliah as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['code'] }}</td>
                        <td>{{ $item['mata_kuliah'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td class="d-flex">
                            <a href="#" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#modal-edit" data-id="{{ $item['id_mata_kuliah'] }}" data-code="{{ $item['code'] }}" data-matkul="{{ $item['mata_kuliah'] }}" data-iddosen="{{ $item['id_dosen'] }}" data-dosen="{{ $item['name'] }}" onClick="edit(this);">Edit</a>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('mata_kuliah.destroy', $item['id_mata_kuliah']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Data Masih Kosong</td>
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
            <form method="POST" action="{{ URL('mata_kuliah') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="form-group">
                        <label>Mata Kuliah</label>
                        <input type="text" class="form-control" name="mata_kuliah" required>
                    </div>
                    <div class="form-group">
                        <label>Dosen</label>
                        <select class="form-control" name="dosen">
                            @forelse($dosen as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @empty
                            @endforelse
                        </select>
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
            <form id="form_update" method="POST" action="{{ URL('mata_kuliah') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="code" id="code_update" required>
                    </div>
                    <div class="form-group">
                        <label>Mata Kuliah</label>
                        <input type="text" class="form-control" name="mata_kuliah" id="mata_kuliah_update" required>
                    </div>
                    <div class="form-group">
                        <label>Dosen</label>
                        <select class="form-control" name="dosen" id="dosen_update">
                        </select>
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
        var link = "{{ URL('mata_kuliah') }}/";
        var id = oButton.getAttribute('data-id');

        document.getElementById('form_update').action = link+id;
        document.getElementById('code_update').value = oButton.getAttribute('data-code');
        document.getElementById('mata_kuliah_update').value = oButton.getAttribute('data-matkul');

        document.getElementById('dosen_update').innerHTML = '<option value="'+oButton.getAttribute('data-iddosen')+'" selected>'+oButton.getAttribute('data-dosen')+'</option>'+
                            '@forelse($dosen as $item)'+
                                '<option value="{{ $item->id }}">{{ $item->name }}</option>'+
                            '@empty'+
                            '@endforelse';
        
    }
</script>

@endsection