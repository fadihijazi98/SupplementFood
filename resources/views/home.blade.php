@extends('layouts.app')

@section('content')
    <div class="container text-right" dir="rtl">
        <div class="row">
            <div class="col-12 m-2">
                <a href="/supplement/create">
                    <button class="btn btn-primary">
                        +
                        مكمل غذائي جديد
                    </button>
                </a>
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach($supplements as $supplement)
                        <div class="col-md-4">
                            <div class="card m-2 position-relative">
                                <div class="card-header text-center">
                                    <h5>
                                        <a href="/supplement/{{$supplement->id}}">
                                            {{ $supplement->name }}
                                        </a>
                                    </h5>
                                    <div class="position-absolute" style="top:15px;left: 15px">
                                        <form action="/supplement/{{$supplement->id}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="card-body">
                                    <p>
                                        حجم الجرعة :
                                        {{ $supplement->dose_size }}
                                    </p>
                                    <p>
                                        الجرعات لكل عبوة :
                                        {{ $supplement->dose_for_each_package }}
                                    </p>
                                </div>

                                <div class="card-footer bg-primary">
                                   <span hidden>
                                       {{ $img = \App\Models\Image::where("supplement_id", $supplement->id)->get()->first() }}
                                   </span>
                                        <a href="{{ $img ? $img->path : '#'}}" {{ $img ? 'download' : '' }}>
                                            <button class="btn btn-light">
                                                تحميل الصورة
                                                الخاصة بالمكمل
                                            </button>
                                        </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
