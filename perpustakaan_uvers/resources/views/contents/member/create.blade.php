@extends('layouts.main')

@section('css')
    <link href="{{ asset('css/anggota.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="row">
                <h1 class="anggota fw-bold mb-3 px-0">Anggota</h1>

                <div class="col min-vh-70 bg-white mb-3 p-0">
                    <h3 class="anggota fw-bold px-3 px-md-4 py-2 shadow-lg">
                        Tambah Anggota
                    </h3>

                    <form action="{{ url('/member/store') }}" method="POST" class="anggota-tambah px-4">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6 mb-md-2">
                                <label for="">ID Anggota</label>
                                <input type="text" class="form-control" name="email" required/>
                                <label for="">No.Telepon</label>
                                <input type="text" class="form-control" name="phone" required/>
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" required/>
                                <label for="">Jenis Kelamin</label>
                                <div class="form-control">
                                    <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault1" required/>
                                    <label class="form-check-label mx-2" for="flexRadioDefault1">
                                        Perempuan
                                    </label>
                                </div>
                                <div class="form-control mt-2">
                                    <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault2" required/>
                                    <label class="form-check-label mx-2" for="flexRadioDefault2">
                                        Laki-laki
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Nama Anggota</label>
                                <input type="text" class="form-control" name="name" required/>
                                <label for="">Tanggal Bergabung</label>
                                <input type="date" class="form-control" name="join_date" required/>
                                <label for="">Asal Sekolah / Universitas</label>
                                <select name="institution_id" class="form-select" required>
                                    @foreach ($institution_ids as $institution_id)
                                        <option value="{{$institution_id->id}}">{{ $institution_id->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" name="active" id="flexCheckChecked" />
                                <label class="form-check-label text-dark" for="flexCheckChecked">
                                    Nonaktifkan anggota tersebut
                                </label>
                            </div>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{$errors }}
                            </div>
                        @endif

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <a href="" class="d-flex">
                                    <button class="btn anggota-btn-batal w-50 mx-auto me-md-0">
                                        Batal
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0 text-center text-md-start">
                                <button type="submit" class="btn anggota-btn-simpan w-50">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
@endsection
