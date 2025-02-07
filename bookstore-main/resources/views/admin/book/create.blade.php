@extends('theme.default')

@section('title')
    انشاء الكتاب
@endsection

@section('head')

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="card col-md-8 mb-4">
        <div class="card-header text-bg-danger">
            انشر كتابا جديدا
        </div>
        <div class="card-body">
            <form action="{{route("books.store")}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-4 col-form-label text-md-right">ادخل اسم الكتاب</label>
                <div class="col-md-8">
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" autocomplete="title">
                    <span class="invalid-feedback" role="alert">
                        @error('title')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="isbn" class="col-4 col-form-label text-md-right">ادخل isbn</label>
                <div class="col-md-8">
                    <input type="number" id="isbn" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{old('isbn')}}" autocomplete="isbn">
                    <span class="invalid-feedback" role="alert">
                        @error('isbn')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="cover_image" class="col-4 col-form-label text-md-right">صورة</label>
                <div class="col-md-8">
                    <input accept="image/*"type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{old('cover_image')}}" autocomplete="cover_image">
                    <span class="invalid-feedback" role="alert">
                        @error('cover_image')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="categor_id" class="col-4 col-form-label text-md-right">ادخل الصنف</label>
                <div class="col-md-8">
                    <select name="categor_id" class="form-control @error('categor_id') is-invalid @enderror" id="categor_id">
                        <option disabled selected> ادخل تصنيفا</option>
                        @foreach ($categor as $cat )
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert">
                        @error('categor_id')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="publisher_id" class="col-4 col-form-label text-md-right @error('publisher_id') is-invalid @enderror">ادخل الناشر</label>
                <div class="col-md-8">
                    <select name="publisher_id" class="form-control" id="publisher_id">
                        <option disabled selected>اختر الناشر</option>
                        @foreach ($publisher as $pub )
                            <option value="{{$pub->id}}">{{$pub->name}}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert">
                        @error('publisher_id')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="author" class="col-4 col-form-label text-md-right @error('author') is-invalid @enderror">ادخل اسم المؤلف</label>
                <div class="col-md-8">
                    <select name="author[]" multiple class="form-control" id="author">
                        <option disabled selected>اختر المؤلف</option>
                        @foreach ($author as $auth)
                            <option value="{{$auth->id}}">{{$auth->name}}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert">
                        @error('author')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            

            <div class="form-group row">
                <label for="description" class="col-4 col-form-label text-md-right">الوصف</label>
                <div class="col-md-8">
                    
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" autocomplete="description"></textarea>
                    <span class="invalid-feedback" role="alert">
                        @error('description')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="publish_year" class="col-4 col-form-label text-md-right">سنة النشر</label>
                <div class="col-md-8">
                    <input type="number" id="publish_year" name="publish_year" class="form-control @error('publish_year') is-invalid @enderror" value="{{old('publish_year')}}" autocomplete="publish_year">
                    <span class="invalid-feedback" role="alert">
                        @error('publish_year')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">

                <label for="number_of_page" class="col-4 col-form-label text-md-right">ادخل عدد الصفحات</label>
                <div class="col-md-8">
                    <input type="number" id="number_of_page" name="number_of_page" class="form-control @error('number_of_page') is-invalid @enderror" value="{{old('number_of_page')}}" autocomplete="number_of_page">
                    <span class="invalid-feedback" role="alert">
                        @error('number_of_page')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="number_of_copy" class="col-4 col-form-label text-md-right">ادخل عدد النسخ </label>
                <div class="col-md-8">
                    <input type="number" name="number_of_copy" id="number_of_copy" class="form-control @error('number_of_copy') is-invalid @enderror" value="{{old('number_of_copy')}}" autocomplete="number_of_copy">
                    <span class="invalid-feedback" role="alert">
                        @error('number_of_copy')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-4 col-form-label text-md-right">السعر </label>
                <div class="col-md-8">
                    <input type="number" name='price'id="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}" autocomplete="price">
                    <span class="invalid-feedback" role="alert">
                        @error('price')

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

@section('script')
    
@endsection