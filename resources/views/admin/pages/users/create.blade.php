@extends('admin.master')
@section('title', 'اضافة قاعة')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>القاعات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">اضافة قاعة</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title" style="float: right;">اضافة قاعة</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{route('users.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input type="text" data-validation="required" class="form-control" id="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">الجنس</label>
                        <div class="col-sm-10">
                            <select class="custom-select rounded-0" data-validation="required" id="gender">
                                <option value="male">ذكر</option>
                                <option value="female">انثى</option>
                                <option value="all">الجميع</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="countries" class="col-sm-2 col-form-label">الدولة</label>
                        <div class="col-sm-10">
                            <select class="custom-select rounded-0" data-validation="required" name="countries" id="countries">
                                <option>اختر الدولة</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="cities" class="col-sm-2 col-form-label">المدينة</label>
                        <div class="col-sm-10">
                            <select class="custom-select rounded-0" data-validation="required" name="cities" id="cities">
                                <option >اختر المدينة</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="cities" class="col-sm-2 col-form-label">المدينة</label>
                        <div class="col-sm-10">
                            <select class="custom-select rounded-0" data-validation="required" name="cities" id="cities">
                                <option >اختر المدينة</option>
                            </select>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">حفظ</button>
                    <button type="button" onclick="window.location.replace('{{route('users.index')}}')" class="btn btn-default float-right">الغاء</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection

@push('js')
    <script>
        $('#countries').on('change',function(e) {
            console.log(e);
            var country_id = e.target.value;
            // Ajax
            $.get('/admin/get-cities-by-country?country_id=' + country_id, function (data) {
                // success data
                $('#cities').empty();
                $.each(data, function (index, city) {
                    $('#cities').append('<option value="'+city.id+'">'+city.name+'</option>');
                });
            });
        });


    </script>
@endpush
