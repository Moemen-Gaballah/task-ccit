@extends('admin.master')
@section('title', 'عرض القاعات')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>المستخدمين</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">المستخدمين</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">المستخدمين</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="usersTable" class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            الاسم
                        </th>
                        <th style="width: 30%">
                            الايميل
                        </th>
                        <th style="width: 30%">
                            الحالة
                        </th>
                        <th>
                            الحدث
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

@push('js')
    <script type="text/javascript">
        var datatable;
        $(document).ready(function () {
            datatable = dt();
        })
        function dt() {
            var p_table = $('#usersTable').DataTable({
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "processing": true,
                "serverSide": true,
                "bInfo": false,
                "ajax": {
                    "url": "{{ url('/admin/users-datatable') }}",
                    "type": "GET"
                },
                "columns": [
                    {"data": 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'operation', name: 'delete', orderable: false, searchable: false}
                ],
            });
            return p_table;
        }
        function toggleStatus(id) {
            $.ajax({
                type: "get",
                url: "{{url('admin/toggle-users-status')}}/" + id,
                success: function (response) {
                    // cuteToast({
                    //     type: "success", // or 'info', 'error', 'warning'
                    //     message: "Toast Message",
                    //     showConfirmButton: false,
                    //     timer: 5000
                    // })
                    notifyMsg('Done Update Status Successfully', 'success');

                }
            });
        }
        function deleteUser(id) {
            cuteAlert({
                type: "question",
                title: "Delete user",
                message: "Sure ? do you want delete",
                confirmText: "okay",
                cancelText: "cancel"
            }).then((e) => {
                if (e == "confirm") {
                    $.ajax({
                        type: "post",
                        url: "{{url('admin/users')}}/" + id,
                        data: {
                            "_method": "delete",
                            "_token": "{{csrf_token()}}"
                        },
                        success: function (response) {

                            notifyMsg(response.message, response.status);
                            datatable.ajax.reload();
                        }
                    });
                }
            })
        }
    </script>

@endpush
