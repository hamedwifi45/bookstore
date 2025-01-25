@extends('layouts.main')

@section('style')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card .card-body .card-title {
        height: 40px;
        overflow: hidden;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .search-bar {
        margin-top: 20px;
    }
    .search-bar input {
        border-radius: 20px;
        padding: 10px 20px;
    }
    .search-bar button {
        border-radius: 20px;
        padding: 10px 20px;
    }
    .rating i {
        color: #ffc107;
    }
    .no-results {
        text-align: center;
        margin-top: 50px;
    }
    .no-results h1 {
        font-size: 2.5rem;
        color: #dc3545;
    }
    .no-results .alert {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row search-bar d-flex justify-content-center">
        <form action="{{route('search')}}" method="GET" class="d-flex">
            <input type="text" class="form-control me-2" name="term" placeholder="ابحث عن ما تبحث">
            <button class="btn btn-primary" type="submit">ابحث</button>
        </form>
    </div>
    <hr>
    <h3 class="my-3">{{$title}}</h3>
    <div class="mt-50 mb-50">
        <div class="row">
            @if ($books->count())
                @foreach ($books as $book)
                    @if ($book->number_of_copy > 0)
                        <div class="col-md-4 col-lg-3 col-sm-6 mt-2">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="card-img-actions">
                                        <a href="{{route("book.details", $book)}}">
                                            <img src="{{asset("storage/" . $book->cover_image)}}" class="card-img img-fluid" width="96" height="350" alt="Book cover image for {{$book->title}}">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body bg-light text-center">
                                    <div class="mb-2">
                                        <h6 class="font-weight-semibold card-title mb-2">
                                            <a href="{{route('book.details', $book)}}" class="text-default mb-2" data-abc="true"><h3>{{$book->title}}</h3></a>
                                        </h6>
                                        <a href="{{route('Gallary.category.show', $book->categor)}}" class="text-muted" data-abc="true">
                                            @if ($book->categor != null)
                                                {{$book->categor->name}}
                                            @endif
                                        </a>
                                    </div>
                                    <h3 class="mb-0 font-weight-semibold">{{$book->price}} ليرة سورية</h3>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="text-muted mb-3">{{$book->rating->count()}} رأي</div>
                                    <button type="button" class="btn btn-primary"> <i class="bi bi-cart2 p-1" style=" color: white;"></i>اضف للسلة</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="no-results">
                    <h1>لا نتائج</h1>
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">لا نتائج في صفحة خطأ في تحميل</h4>
                        ERORR 404 Not Found
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{$books->links()}}
</div>

@endsection