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
            عدل الكتاب 
        </div>
        <div class="card-body">
            <form action="{{route("books.update")}}" enctype="multipart/form-data" method="post">
            @method('PATCH')
            @csrf
            <div class="form-group row">
                <label for="title" class="col-4 col-form-label text-md-right">ادخل اسم الكتاب</label>
                <div class="col-md-8">
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$book->title}}" autocomplete="title">
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
                    <input type="number" id="isbn" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{$book->isbn}}" autocomplete="isbn">
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
                    <input accept="image/*" type="file" id="cover_image" onchange="ReadCover(this);" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" autocomplete="cover_image">                        @error('cover_image')

                        <strong>{{$message}}</strong>
                        @enderror
                    </span>
                    <img id="cover-image-thumb" class="img-fluid img-thumbnail" src="{{asset('storage/'. $book->cover_image)}}" alt="">
                </div>
            </div>
            <div class="form-group row">
                <label for="categor_id" class="col-4 col-form-label text-md-right">ادخل الصنف</label>
                <div class="col-md-8">
                    <select name="categor_id" class="form-control @error('categor_id') is-invalid @enderror" id="categor_id">
                        <option disabled {{$book->categor == null ? "selected" : ''}}> ادخل تصنيفا</option>
                        @foreach ($categor as $cat )
                            <option value="{{$cat->id}}" {{$book->categor == $cat ? 'selected' : ""}}>{{$cat->name}}</option>
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
                        <option disabled {{$book->publisher == null ? "selected" : ''}}>اختر الناشر</option>
                        @foreach ($publisher as $pub )
                            <option value="{{$pub->id}}"{{$book->publisher == $pub ? 'selected' : ""}}>{{$pub->name}}</option>
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
                        <option disabled {{$book->auther->count() == 0 ? "selected" : ''}}>اختر المؤلف</option>
                        @foreach ($author as $auth)
                            <option value="{{$auth->id}}"  {{$book->auther->contains($auth)? 'selected' : ''}}>{{$auth->name}}</option>
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
                    
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{$book->description}}</textarea>
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
                    <input type="number" id="publish_year" name="publish_year" class="form-control @error('publish_year') is-invalid @enderror" value="{{$book->publish_year}}" autocomplete="publish_year">
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
                    <input type="number" id="number_of_page" name="number_of_page" class="form-control @error('number_of_page') is-invalid @enderror" value="{{$book->number_of_page}}" autocomplete="number_of_page">
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
                    <input type="number" name="number_of_copy" id="number_of_copy" class="form-control @error('number_of_copy') is-invalid @enderror" value="{{$book->number_of_copy}}" autocomplete="number_of_copy">
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
                    <input type="number" name='price'id="price" class="form-control @error('price') is-invalid @enderror" value="{{$book->price}}" autocomplete="price">
                    <span class="invalid-feedback" role="alert">
                        @error('price')

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

@section('script')
    <script>
         document.addEventListener("DOMContentLoaded", function() {
        var coverImageInput = document.getElementById('cover_image');
        var imageUrl = 'url-to-your-image.jpg'; // استبدل هذا بالرابط الفعلي للصورة
        fetch(imageUrl)
            .then(response => response.blob())
            .then(blob => {
                var file = new File([blob], "cover.jpg", {type: blob.type});
                var dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                coverImageInput.files = dataTransfer.files;
            });
    });
        // تعريف دالة لقراءة صورة الغلاف
        function ReadCover(input){
            // التحقق من وجود ملفات في الإدخال
            if(input.files && input.files[0]){
                // إنشاء كائن FileReader لقراءة الملف
                var reader =  new FileReader();
                // تعريف دالة لتنفيذها عند تحميل الملف
                reader.onload = function (e) {
                    // تعيين مصدر الصورة بالنتيجة المحملة
                    $('#cover-image-thumb').attr('src', e.target.result);
                };
                // قراءة الملف كبيانات URL
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection