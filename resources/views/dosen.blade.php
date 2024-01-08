@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Dosen</h1>
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
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosen as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nik'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['gender'] }}</td>
                        <td class="d-flex">
                            <a href="#" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#modal-edit" data-id="{{ $item['id'] }}" data-nik="{{ $item['nik'] }}" data-name="{{ $item['name'] }}" data-gender="{{ $item['gender'] }}" onClick="edit(this);">Edit</a>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('dosen.destroy', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Data Masih Kosong</td>
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
            <form method="POST" action="{{ URL('dosen') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" required>
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
                        <label>NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik_update" required>
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
        var link = "{{ URL('dosen') }}/";
        var id = oButton.getAttribute('data-id');

        document.getElementById('form_update').action = link+id;
        document.getElementById('nik_update').value = oButton.getAttribute('data-nik');
        document.getElementById('name_update').value = oButton.getAttribute('data-name');
        document.getElementById('gender_update').innerHTML = '<option value="'+oButton.getAttribute('data-gender')+'" selected>'+oButton.getAttribute('data-gender')+'</option>'+
                            '<option value="Laki-Laki">Laki-Laki</option>'+
                            '<option value="Perempuan">Perempuan</option>';
    }
</script>

@endsection