@extends('theme.default')

@section('title')
    انشاء التصنيف
@endsection

@section('head')

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="card col-md-8 mb-4">
        <div class="card-header text-bg-danger">
            عدل لبتصنيف 
        </div>
        <div class="card-body">
            
            <form action="{{ route("categories.update",['category'=>$category])}}"  method="post">
                @method('PATCH')
            @csrf
            <div class="form-group row">
                <label for="name" class="col-4 col-form-label text-md-right">ادخل اسم التصنيف</label>
                <div class="col-md-8">
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}" autocomplete="name">
                    <span class="invalid-feedback" role="alert">
                        @error('name')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            

            <div class="form-group row">
                <label for="description" class="col-4 col-form-label text-md-right">الوصف</label>
                <div class="col-md-8">
                    
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{$category->description}}</textarea>
                    <span class="invalid-feedback" role="alert">
                        @error('description')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">حدث <i class="bi bi-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
@endsection
