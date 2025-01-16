@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
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
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Masukkan Data Peminjaman</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/insert-loan') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="borrower_type">Pilih</label>
                                        <select id="status" name="borrower_type" class="form-control" id="type" required>
                                            <option selected>Pilih...</option>
                                            <option value="student">Mahasiswa</option>
                                            <option value="staff">Dosen atau staff akademik</option>
                                        </select>
                                        @error('borrower_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Nama</label>
                                        <input class="form-control py-4" name="borrower_name" type="text" placeholder="" required/>
                                        @error('borrower_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- @if()
                                        <label class="small mb-1" for="inputFirstName">NIM</label>
                                        @else
                                        <label class="small mb-1" for="inputFirstName">NIP</label>
                                        @endif --}}
                                        <label class="small mb-1" for="inputFirstName">NIM / NIP</label>
                                        <input class="form-control py-4" name="borrower_identity_number" type="text" placeholder="" required/>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Kontak</label>
                                        <input class="form-control py-4" name="borrower_contact" type="text" placeholder="" required/>
                                        @error('borrower_contact')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Alat</label>
                                        <select id="name" name="inventory_item_id" class="form-control">
                                            <option selected>Pilih...</option>
                                            @foreach($inventoryItems as $item)
                                                <option value="{{$item->id}}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('inventory_item_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Jumlah</label>
                                        <input class="form-control py-4" name="quantity" type="number" placeholder="" required/>
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLoanDate">Tanggal Peminjaman</label>
                                        <input class="form-control py-4" name="borrow_date" type="date" required />
                                        @error('loan_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputReturnDate">Tanggal Pengembalian</label>
                                        <input class="form-control py-4" name="return_date" type="date" required />
                                        @error('return_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection