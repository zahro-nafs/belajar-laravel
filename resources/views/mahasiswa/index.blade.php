@extends('layout.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1>{{ $editData ? 'Edit Data Mahasiswa' : 'Input Data Mahasiswa' }}</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Input --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $editData ? 'Form Edit Mahasiswa' : 'Form Input Mahasiswa' }}
                    </h3>
                </div>

                <form action="{{ $editData ? url('/mahasiswa/' . $editData->id) : url('/mahasiswa') }}" method="POST">
                    @csrf

                    @if($editData)
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input 
                                type="text" 
                                name="nama" 
                                class="form-control" 
                                placeholder="Masukkan nama mahasiswa"
                                value="{{ old('nama', $editData->nama ?? '') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label>NIM</label>
                            <input 
                                type="text" 
                                name="nim" 
                                class="form-control" 
                                placeholder="Masukkan NIM"
                                value="{{ old('nim', $editData->nim ?? '') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea 
                                name="alamat" 
                                class="form-control" 
                                rows="3" 
                                placeholder="Masukkan alamat"
                            >{{ old('alamat', $editData->alamat ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>HP</label>
                            <input 
                                type="text" 
                                name="hp" 
                                class="form-control" 
                                placeholder="Masukkan nomor HP"
                                value="{{ old('hp', $editData->hp ?? '') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label>IPK</label>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="ipk" 
                                class="form-control" 
                                placeholder="Contoh: 3.75"
                                value="{{ old('ipk', $editData->ipk ?? '') }}"
                            >
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            {{ $editData ? 'Update' : 'Simpan' }}
                        </button>

                        @if($editData)
                            <a href="{{ url('/mahasiswa') }}" class="btn btn-secondary">
                                Batal
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tabel Data --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Alamat</th>
                                <th>HP</th>
                                <th>IPK</th>
                                <th width="160">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>{{ $mahasiswa->nim }}</td>
                                    <td>{{ $mahasiswa->alamat }}</td>
                                    <td>{{ $mahasiswa->hp }}</td>
                                    <td>{{ $mahasiswa->ipk }}</td>
                                    <td>
                                        <a href="{{ url('/mahasiswa/' . $mahasiswa->id . '/edit') }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form 
                                            action="{{ url('/mahasiswa/' . $mahasiswa->id) }}" 
                                            method="POST" 
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Belum ada data mahasiswa
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection