@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Data Alat</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/update-item/' . $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="code">Kode Alat</label>
                                        <input class="form-control py-4" name="code" type="text" value="{{ $item->code }}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="name">Nama Alat</label>
                                        <input class="form-control py-4" name="name" type="text" value="{{ $item->name }}" required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="description">Deskripsi</label>
                                        <input class="form-control py-4" name="description" type="text" value="{{ $item->description }}" required/>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="quantity">Jumlah</label>
                                        <input class="form-control py-4" name="quantity" type="number" value="{{ $item->quantity }}" required/>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="status">Status</label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="available" {{ $item->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="unavailable" {{ $item->status == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                                        </select>
                                    </div>
                                </div> 

                            </div>

                            <div class="form-group mt-4 mb-0">
                                <button class="btn btn-primary btn-block">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
