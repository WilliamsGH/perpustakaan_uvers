@extends('layouts.main')

@section('css')
<link href="{{ asset('css/ri_pe.css') }}" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<main class="content">
  <div class="container-fluid">
    <div class="row">
      <h1 class="ri-pe fw-bold mb-3 px-0">Riwayat Peminjaman</h1>

      <div class="col min-vh-70 bg-white mb-3 p-0">
        <div class="py-2 py-md-4 px-4 d-md-flex shadow-lg">
          <form action="" class="d-flex ri-pe-form-search">
            <div class="ri-pe-search-icon-box bg-white h-100 d-flex justify-content-center align-items-center">
              <img src="{{ Storage::url('img/icons/search.svg')}}" alt="" class="" />
            </div>
            <input type="text" class="ri-pe-form-pencarian" placeholder="Pencarian data" />
          </form>

          <form action="" class="ri-pe-form-date ms-md-auto mt-2 mt-md-0">
            <input type="date" placeholder="Start Date" class="ri-pe-date text-center h-100" />
            <span>-</span>
            <input type="date" placeholder="End Date" class="ri-pe-date text-center h-100" />
          </form>
        </div>

        <div class="table-responsive px-3 px-sm-4">
          <table class="table ri-pe-table text-black table-border-bottom">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Peminjaman</th>
                <th scope="col tanggal-pinjam">Tanggal Pinjam</th>
                <th scope="col jatuh-tempo">Jatuh Tempo</th>
                <th scope="col jumlah-buku">Jumlah Buku</th>
                {{-- <th scope="col"></th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($move_ids as $move_id)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $move_id->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($move_id->borrow_date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($move_id->expires_date)->format('d M Y') }}</td>
                <td>1</td>
                {{-- <td>
                  <div class="d-md-flex gap-1">
                    <a href="" class="d-inline-block pb-1 pb-md-0">
                      <img src="{{ Storage::url('img/icons/edit.svg')}}" alt="" class="ri-pe-btn-aksi" />
                    </a>
                  </div>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('js')
<script>
  flatpickr('input[type=date]', {})
</script>
<script>
  $(document).ready(function() {
            $(".ri-pe-form-pencarian").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".ri-pe-table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
</script>
@endsection