@extends('layouts.app')

@section('content')
    <div class="container text-right" dir="rtl">

        <div class="row">

            <input value="{{$supplement->id}}" hidden id="supplement_id">

            <div class="col-12 card m-2 p-4">
                @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-header bg-primary text-white">
                    حقائق حول المكمل الغذائي
                </div>

                <div class="card-body">
                    <form action="/supplement/{{$supplement->id}}" method="post" class="form-group">

                        @csrf
                        @method("PATCH")

                        <div class="input-group mb-3">
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="اسم المكمل الغذائي"
                                   value="{{$supplement->name}}">
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" id="dose_size" name="dose_size" class="form-control"
                                   placeholder="حجم الجرعة"
                                   value="{{$supplement->dose_size}}">
                        </div>

                        <div class="input-group mb-3">
                            <input type="number" id="dose_for_each_package" name="dose_for_each_package"
                                   class="form-control"
                                   placeholder="الجرعات بكل عبوة" value="{{$supplement->dose_for_each_package}}">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">
                                تحديث
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 card m-2 p-4">

                <div class="card-header bg-secondary text-white">
                    النسب والمقادير
                </div>

                <div class="card-body">
                    <form action="/" method="" class="form-group">

                        @csrf

                        <div class="row">


                            <input hidden value="{{$supplement->id}}" v-model="supplement_id">

                            <div class="col-5 col-4 input-group mb-3">
                                <input type="number" v-model="daily_amount" class="form-control"
                                       placeholder="مقدار اليومي %">
                            </div>

                            <div class="col-sm-5 col-4 input-group mb-3">
                                <!-- in migrations dont forget! -->
                                <input type="text" v-model="dose_daily_amount" class="form-control"
                                       placeholder="مقدار الجرعة اليومية">
                            </div>

                            <div class="col-sm-1 col-2">
                                <button class="btn btn-primary" type="button" @click="addAmount()">
                                    اضافة
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="">
                        <table class="table">

                            <thead class="">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">النسبة المئوية للقيمة اليومية ( % )</th>
                                <th scope="col">مقدار كل جرعة ( مل جرام )</th>
                                <th scope="col">حذف</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(item, i) in amounts_list" class="text-center">
                                <td>
                                    @{{ i + 1 }}
                                </td>
                                <td>
                                    @{{ item.daily_ratio }} %
                                </td>
                                <td>
                                    @{{ item.amount_for_each_dose }}
                                    ميلي جرام
                                </td>
                                <td>
                                    <button class="btn btn-secondary" @click="deleteIngredient(item.id)">
                                        حذف
                                    </button>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

            <div class="col-12 card m-2 p-4">

                <div class="card-header bg-warning">
                    تحذيرات
                </div>

                <div class="card-body">
                    <form action="/" method="" class="form-group">

                        @csrf

                        <div class="row">
                            <form>
                                <div class="col-5 col-4 input-group mb-3">
                                    <input type="text" v-model="content" class="form-control"
                                           placeholder="مضمون التحذير">
                                </div>

                                <div class="col-sm-1 col-2">
                                    <button class="btn btn-primary" type="button" @click="addWarning()">
                                        اضافة
                                    </button>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>

                <div class="">
                    <table class="table">

                        <thead class="">
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">المضمون</th>
                            <th scope="col">حذف</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(item, i) in warnings_list" class="text-center">
                            <td>
                                @{{ i + 1 }}
                            </td>
                            <td>
                                @{{ item.content }}
                            </td>
                            <td>
                                <button class="btn btn-warning" @click="deleteWarning(item.id)">
                                    حذف
                                </button>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>


            </div>

        </div>
        <div>
            <h2 class="text-primary text-center p-4">
                <span style="border-bottom: 3px solid; padding: 2px">
                    معاينة
                </span>
            </h2>
        </div>
        <div id="parent-table-render">
            <div id="table-render" class="p-4" style="background-color: white;max-width: 400px;font-size:17px;font-family: 'Changa', sans-serif!important;">
                <div>
                    <h5 class="text-center">
                        حقائق حول المكمل الغذائي
                    </h5>
                    <table class="table-export">
                        <tr class="border" style="border: 3px solid black;text-align: right;padding: 8px;">
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">اسم المكمل الغذائي</td>
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">حجم الجرعة</td>
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">الجرعات لكل عبوة</td>
                        </tr>
                        <tr style="border: 3px solid black;text-align: right;padding: 8px;">
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">
                                <b>
                                    {{ $supplement->name }}
                                </b>
                            </td>
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">
                                <b>
                                    {{ $supplement->dose_size }}
                                </b>
                            </td>
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">
                                <b>
                                    {{ $supplement->dose_for_each_package }}
                                </b>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div>
                    <h5>
                        النسب والمقادير
                    </h5>
                    <table class="table-export">
                        <tr class="border" style="border: 3px solid black;text-align: right;padding: 8px;">
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">النسبة المئوية للقيمة اليومية 	</td>
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">مقدار كل جرعة 	</td>
                        </tr>
                        <tr v-for="item in amounts_list" style="border: 3px solid black;text-align: right;padding: 8px;">
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">
                                <b>
                                    @{{ item.daily_ratio }} %
                                </b>
                            </td>
                            <td style="border: 3px solid black;text-align: right;padding: 8px;">
                                <b>
                                    @{{ item.amount_for_each_dose }}
                                    ميلي جرام
                                </b>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div>
                    <h5>
                        تحذيرات
                    </h5>
                    <p v-for="item in warnings_list">
                       <b>
                           @{{ item.content }}
                       </b>
                    </p>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 text-center">
                <button class="btn btn-primary" @click="exportToImage()">
                    تصدير هذه المعلومات ك صورة
                </button>
            </div>
        </div>
    </div>
@endsection
