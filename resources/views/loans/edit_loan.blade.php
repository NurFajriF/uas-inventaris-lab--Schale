@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Masukkan Data Peminjaman</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/update-loan/' . $loan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="borrower_type">Pilih</label>
                                        <select id="status" name="borrower_type" class="form-control" id="type" required>
                                            <option value="student" {{ $loan->borrower_type == 'student' ? 'selected' : '' }}>Mahasiswa</option>
                                            <option value="staff" {{ $loan->borrowerr_type == 'staff' ? 'selected' : '' }}>Dosen atau staff akademik</option>
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
                                        <input class="form-control py-4" name="borrower_name" type="text" value="{{ $loan->borrower_name }}"  required/>
                                        @error('borrower_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">NIM / NIP</label>
                                        <input class="form-control py-4" name="borrower_identity_number" type="text" 
                                        value="{{ $loan->borrower_identity_number }}" required/>
                                        @error('borrower_identity_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Kontak</label>
                                        <input class="form-control py-4" name="borrower_contact" type="text" 
                                        value="{{ $loan->borrower_contact }}" required/>
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
                                            {{-- <option selected value="{{ $loan->inventory_item_id }}"></option> --}}
                                            <option value="{{ $loan->inventory_item_id }}" 
                                                {{ $loan->inventoryItem->id == old('inventory_item_id', $loan->inventory_item_id) ? 'selected' : '' }}> {{ $loan->inventoryItem->name }}</option>
                                            <option selected value="{{ $loan->inventory_item_id }}" 
                                                > {{ $loan->inventoryItem->name }}</option>
                                            @foreach($inventoryItems as $item)
                                                <option value="{{$loan->inventory_id}}">{{ $item->name }}</option>
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
                                        <input class="form-control py-4" name="quantity" type="number" 
                                        value="{{ $loan->quantity }}" required/>
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
                                        <input class="form-control py-4" name="borrow_date" type="date" required 
                                        value="{{ $loan->borrow_date }}" />
                                        @error('borrow_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputReturnDate">Tanggal Pengembalian</label>
                                        <input class="form-control py-4" name="return_date" type="date" required 
                                        value="{{ $loan->return_date }}"/>
                                        @error('return_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="status">Persetujuan</label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="pending" {{ $loan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ $loan->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                            <option value="rejected" {{ $loan->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                            <option value="returned" {{ $loan->status == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                                        </select>
                                        @error('borrower_type')
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