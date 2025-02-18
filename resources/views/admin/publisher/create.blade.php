@extends('theme.default')

@section('title')
    انشاء الناشر
@endsection

@section('head')

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="card col-md-8 mb-4">
        <div class="card-header text-bg-danger">
            انشر ناشرا جديدا
        </div>
        <div class="card-body">
            <form action="{{route("publishers.store")}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-4 col-form-label text-md-right">ادخل اسم الكتاب</label>
                <div class="col-md-8">
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" autocomplete="name">
                    <span class="invalid-feedback" role="alert">
                        @error('name')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            

            <div class="form-group row">
                <label for="addreas" class="col-4 col-form-label text-md-right">العنوان</label>
                <div class="col-md-8">
                    
                    <textarea maxlength="255" id="addreas" name="addreas" class="form-control @error('addreas') is-invalid @enderror" value="{{old('addreas')}}" autocomplete="addreas"></textarea>
                    <span class="invalid-feedback" role="alert">
                        @error('addreas')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">اضف <i class="bi bi-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
@endsection
