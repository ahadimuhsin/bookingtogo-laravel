@extends('layouts.main')

@section('content')
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Input Data</a></h4>
            <div class="card border-0 shadow-sm rounded-md mt-4">
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cst_name" class="control-label">Nama</label>
                            <input type="text" class="form-control" id="cst_name" name="cst_name"
                                placeholder="Masukkan Nama Customer">
                        </div>


                        <div class="form-group">
                            <label class="control-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="cst_dob" name="cst_dob"
                                placeholder="Pilih Tanggal Lahir">
                        </div>

                        <div class="form-group">
                            <label for="cst_phone" class="control-label">Nomor Telepon</label>
                            <input type="number" class="form-control" id="cst_phone" name="cst_phone"
                                placeholder="Nomor Telepon Customer">
                        </div>

                        <div class="form-group">
                            <label for="cst_email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="cst_email" name="cst_email"
                                placeholder="Masukkan Email Customer">
                        </div>

                        <div class="form-group">
                            <label for="nationality_id" class="control-label">Negara Asal</label>
                            <select name="nationality_id" id="nationality_id" class="form-control">
                                <option value="">Pilih Negara</option>
                                @foreach ($nationalities as $item)
                                <option value="{{ $item->nationality_id }}">{{ $item->nationality_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <h3>Keluarga</h3>

                        <div class="row add_field">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="family_name" class="control-label">Nama</label>
                                        <input type="text" class="form-control" id="family_name" name="family_name[]"
                                            placeholder="Nama Keluarga">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="family_relation" class="control-label">Hubungan</label>
                                        <input type="text" class="form-control" id="family_relation"
                                            name="family_relation[]" placeholder="Hubungan Keluarga">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="family_dob" class="control-label">Tanggal Lahir</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" id="family_dob" name="family_dob[]"
                                            placeholder="Tanggal Lahir Keluarga">
                                        <div class="input-group-append">
                                          <button class="btn btn-outline-secondary add_button" type="button">Tambah</button>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
    <script>

        $(function(){
            addField();
        })
        function addField()
        {
            let max_fields = 10;
            let wrapper = $(".add_field");
            let add_button = $(".add_button");

            let x = 1;
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append(
                        `
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="family_name" class="control-label">Nama</label>
                                        <input type="text" class="form-control" id="family_name" name="family_name[]"
                                            placeholder="Nama Keluarga">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="family_relation" class="control-label">Hubungan</label>
                                        <input type="text" class="form-control" id="family_relation"
                                            name="family_relation[]" placeholder="Hubungan Keluarga">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="family_dob" class="control-label">Tanggal Lahir</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" id="family_dob" name="family_dob[]"
                                            placeholder="Tanggal Lahir Keluarga">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger remove_field" type="button">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                    )
                }
                else{
                    window.alert("Keluarga Tidak Boleh Lebih dari 10");
                }
            });

            $(wrapper).on("click", ".remove_field", function(e){
                e.preventDefault();
                // console.log(this);
                $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                x--;
            });
        }
    </script>
@endpush
