@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Mahasiswa</h1>
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
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Prodi</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nim'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['gender'] }}</td>
                        <td>{{ $item['prodi'] }}</td>
                        <td class="d-flex">
                            <a href="#" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#modal-edit" data-id="{{ $item['id_mahasiswa'] }}" data-nim="{{ $item['nim'] }}" data-name="{{ $item['name'] }}" data-gender="{{ $item['gender'] }}" data-idprodi="{{ $item['id_prodi'] }}" data-prodi="{{ $item['prodi'] }}" onClick="edit(this);">Edit</a>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('mahasiswa.destroy', $item['id_mahasiswa']) }}" method="POST">
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
            <form method="POST" action="{{ URL('mahasiswa') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <select class="form-control" name="prodi">
                            @forelse($prodi as $item)
                                <option value="{{ $item->id }}">{{ $item->prodi }}</option>
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
            <form id="form_update" method="POST" action="{{ URL('prodi') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" id="nim_update" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" id="name_update" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender" id="gender_update">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <select class="form-control" name="prodi" id="prodi_update">
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
        var link = "{{ URL('mahasiswa') }}/";
        var id = oButton.getAttribute('data-id');

        document.getElementById('form_update').action = link+id;
        document.getElementById('nim_update').value = oButton.getAttribute('data-nim');
        document.getElementById('name_update').value = oButton.getAttribute('data-name');

        document.getElementById('gender_update').innerHTML = '<option value="'+oButton.getAttribute('data-gender')+'" selected>'+oButton.getAttribute('data-gender')+'</option>'+
                            '<option value="Laki-Laki">Laki-Laki</option>'+
                            '<option value="Perempuan">Perempuan</option>';

        document.getElementById('prodi_update').innerHTML = '<option value="'+oButton.getAttribute('data-idprodi')+'" selected>'+oButton.getAttribute('data-prodi')+'</option>'+
                            '@forelse($prodi as $item)'+
                                '<option value="{{ $item->id }}">{{ $item->prodi }}</option>'+
                            '@empty'+
                            '@endforelse';
        
    }
</script>

@endsection