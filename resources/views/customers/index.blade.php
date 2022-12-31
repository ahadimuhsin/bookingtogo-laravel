@extends('layouts.main')

@section('content')
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Data Customers</a></h4>
            <div class="card border-0 shadow-sm rounded-md mt-4">
                <div class="card-body">

                    <a href="{{ route('customers.create') }}" class="btn btn-success mb-2" id="btn-create-customers">TAMBAH</a>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kewarganegaraan</th>
                                <th>Tanggal Lahir</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-customerss">
                            @foreach($customers as $customer)
                            <tr id="index_{{ $customer->cst_id }}">
                                <td>{{ $customer->cst_name }}</td>
                                <td>{{ $customer->nationality->nationality_name }}</td>
                                <td>{{ $customer->cst_dob }}</td>
                                <td>{{ $customer->cst_phone }}</td>
                                <td>{{ $customer->cst_email }}</td>
                                <td>
                                    <a href="{{ route('customers.edit', $customer->cst_id) }}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('customers.destroy', $customer->cst_id) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger delete-user">Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
