@extends('layouts.app')

@section('content')
    <div class="container text-right" dir="rtl">
        <div class="row">
            <div class="col-12 card p-4">
                <form action="/supplement" method="post" class="form-group" >

                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="اسم المكمل الغذائي" >
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="dose_size" class="form-control" placeholder="حجم الجرعة" >
                    </div>

                    <div class="input-group mb-3">
                        <input type="number" name="dose_for_each_package" class="form-control" placeholder="الجرعات بكل عبوة" >
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">
                            اضافة
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
