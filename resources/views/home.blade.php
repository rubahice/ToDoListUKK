@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header h2 text-center bg-info">{{ __('TODOLIST') }}</div>

                    <div class="card-body">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambahkan Kegiatan
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambahkan Kegiatan</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('simpan') }}">
                                            @csrf
                                            <div class="form-group mt-2">
                                                <label>Nama Tugas</label>
                                                <textarea name="tugas" class="form-control" cols="30" rows="2"></textarea>
                                                @error('tugas')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-2">
                                                <label>Hari</label>
                                                <select name="hari" class="form-control">
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Minggu">Minggu</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label>Tanggal</label>
                                                <input name="tanggal" type="text" class="form-control" placeholder="Tanggal">
                                                @error('tanggal')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-2">
                                                <label>Jam</label>
                                                <input name="jam" type="text" class="form-control" placeholder="Jam">
                                                @error('jam')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-2">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="Belum Mulai">Belum Mulai</option>
                                                    <option value="Proses">Proses</option>
                                                    <option value="Selesai">Selesai</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label>Jenis</label>
                                                <select name="jenis" class="form-control">
                                                    <option value="Prioritas">Prioritas</option>
                                                    <option value="Opsional">Opsional</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="submit" class="btn btn-primary" value="SIMPAN">
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <table class="table table-bordered table-hover">
                            <tr class="table-secondary">
                                <td>Tugas</td>
                                <td>Hari</td>
                                <td>Tanggal</td>
                                <td>Jam</td>
                                <td>Status</td>
                                <td>Jenis</td>
                                <td>Aksi</td>
                            </tr>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->tugas }}</td>
                                    <td>{{ $data->hari }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->jam }}</td>
                                    <td>
                                        @if ($data->status == 'Belum Mulai')
                                            <label class="text-secondary">{{ $data->status }}</label>
                                        @elseif ($data->status == 'Proses')
                                            <label class="text-info">{{ $data->status }}</label>
                                        @elseif ($data->status == 'Selesai')
                                            <label class="text-success">{{ $data->status }}</label>
                                        @endif
                                        {{-- {{ $data->status }} --}}
                                    </td>
                                    <td>
                                        @if ($data->jenis == 'Prioritas')
                                            <label class="text-success">{{ $data->jenis }}</label>
                                        @elseif ($data->jenis == 'Opsional')
                                            <label class="text-secondary">{{ $data->jenis }}</label>
                                        @endif
                                        {{-- {{ $data->jenis }} --}}
                                    </td>
                                    <td>
                                        <!-- Button to Open the Modal -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal{{ $data->id }}">
                                            Edit
                                        </button>

                                        <!-- The Modal -->
                                        <div class="modal" id="myModal{{ $data->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Tugas</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('edit', ['idtugas' => $data->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group mt-2">
                                                                <label>Nama Tugas</label>
                                                                <textarea name="tugas" class="form-control" cols="30" rows="2">{{ $data->tugas }}</textarea>
                                                                @error('tugas')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label>Hari</label>
                                                                <select name="hari" class="form-control">
                                                                    @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                                                                        <option value="{{ $hari }}" {{ $data->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label>Tanggal</label>
                                                                <input name="tanggal" type="text" class="form-control" placeholder="Tanggal" value="{{ $data->tanggal }}">
                                                                @error('tanggal')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label>Jam</label>
                                                                <input name="jam" type="text" class="form-control" placeholder="Jam" value="{{ $data->jam }}">
                                                                @error('jam')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label>Status</label>
                                                                <select name="status" class="form-control">
                                                                    @foreach (['Belum Mulai','Proses','Selesai'] as $status)
                                                                        <option value="{{ $status }}" {{ $data->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label>Jenis</label>
                                                                <select name="jenis" class="form-control">
                                                                    @foreach (['Prioritas','Opsional'] as $jenis)
                                                                        <option value="{{ $jenis }}" {{ $data->jenis == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="submit" class="btn btn-primary" value="SIMPAN">
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <a onclick="return confirm('Yakin Ingin Menghapus Tugas Todolist Ini?')" href="{{ url('hapus/'.$data->id) }}" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
