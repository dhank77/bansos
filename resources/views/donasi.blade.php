@extends('layouts.app')

@section('content')
<div class="testimonials section py-4">
    <div class="container">
        <h5 class="section-title text-center m-5">Data Pemberi Bantuan Sosial</h5>
        <div class="row">
            <div class="contact-form col-sm-8 col-md-8 col-lg-8 p-3 mb-4 mt-2 card">
                <div class="container">
                    <table id="datatable-slide" class="hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center">ID</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kab / Kota</th>
                                <th class="text-center">Alamat</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4>TOTAL BANTUAN</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    var table2 = $('#datatable-slide').DataTable({
        "pageLength": 10
        , "processing": true
        , "language": {
            "processing": 'Memuat...'
        }
        , "destroy": true
        , "serverSide": true
        , "scrollX": true
        , "ajax": "/panel/data/bansos/index/json/00/00/00"
        , "columns": [{
                "data": "DT_RowIndex"
                , "orderable": false
                , "searchable": false
            }
            , {
                "data": "IDBDT"
            }
            , {
                "data": "NIK"
            }
            , {
                "data": "NAMA"
            }
            , {
                "data": "KABUPATEN"
            }
            , {
                "data": "ALAMAT"
            }
        , ]
        , "columnDefs": [{
            "className": "text-center"
            , "targets": [0, 4]
        }]
    , });

</script>
@endpush
