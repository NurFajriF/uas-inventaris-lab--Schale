@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Daftar Riwayat Peminjaman
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <button type="button" class="text-green-500" onclick="this.parentElement.parentElement.style.display='none';">
                &times;
            </button>
        </span>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Gagal!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <button type="button" class="text-red-500" onclick="this.parentElement.parentElement.style.display='none';">
                &times;
            </button>
        </span>
    </div>
    @endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Gagal!</strong>
    <span class="block sm:inline">{{ session('error') }}</span>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <button type="button" class="text-red-500" onclick="this.parentElement.parentElement.style.display='none';">
            &times;
        </button>
    </span>
</div>
@endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Nama Peminjam</th>
                        <th>NIM / NIP</th>
                        <th>Kontak</th>
                        <th>Nama Alat</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($loans as $row)
                    <tr>
                        <td>{{ $row->borrower_type }}</td>
                        <td>{{ $row->borrower_name }}</td>
                        <td>{{ $row->borrower_identity_number }}</td>
                        <td>{{ $row->borrower_contact }}</td>
                        {{-- <td>ini nama alat</td> --}}
                        <td>{{ $row->inventoryItem->name }}</td>
                        <td>{{ $row->quantity }}</td>

                        @if($row->status == 'pending')
                            <td>{{ 'pending' }}</td>
                        @elseif($row->status == 'approved')
                            <td>{{ 'disetujui' }}</td>
                        @elseif($row->status == 'rejected')
                            <td>{{ 'ditolak' }}</td>
                        @else
                            <td>{{ 'dikembalikan' }}</td>
                        @endif
                        {{-- <td>{{ $row->status }}</td> --}}
                        <td>{{ $row->borrow_date }}</td>
                        <td>{{ $row->return_date }}</td>
                        <td>
                            {{-- <a href="{{ route('approve.loan', $row->id) }}" class="btn btn-sm btn-info">Setujui</a> --}}
                            <a href="#" class="btn btn-sm btn-info">Setujui</a>
                            {{-- <a href="{{ route('reject.loan', $row->id) }}" class="btn btn-sm btn-info">Tolak</a> --}}
                            <a href="#" class="btn btn-sm btn-info">Tolak</a>
                            <a href="{{ route('edit.loan', $row->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('delete.loan', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        
<script>
   


   $('#dataTable').DataTable({
    columnDefs: [
    {bSortable: false, targets: [5]} 
  ],
                dom: 'lBfrtip',
           buttons: [
               {
                   extend: 'copyHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                       columns: [ 0, ':visible' ]
                       
                   }
               },
               {
                   extend: 'excelHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [ 0, ':visible' ]
                   }
               },
               {
                   extend: 'pdfHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                       columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                   }
               },
               'colvis'
           ]
           });
       </script>
@endsection