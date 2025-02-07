@extends('layouts.main')
@section('style')
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 1s ease-in-out;
    }
    .card-header {
        background-color: #007bff;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .list-group-item {
        transition: transform 0.2s;
    }
    .list-group-item:hover {
        transform: scale(1.05);
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>تصنيفات الكتب</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <form action="{{route('search.categor')}}" method="GET" class="w-100">
                            <div class="row d-flex justify-content-center">
                                <input type="text" class="form-control col-8 mx-sm-3 mb-2" name="term" placeholder="ابحث عن ما تبحث">
                                <button class="btn btn-primary col-2 mb-2" type="submit">ابحث</button>
                            </div>
                        </form>
                        <hr>
                        <br>
                        <h3 class="mb-3 text-center">{{$title}}</h3>
                        @if ($category->count() > 0)
                            <ul class="list-group">
                                @foreach ($category as $cat )
                                    <li class="list-group-item">
                                        <a href="{{route('Gallary.category.show',$cat->name)}}" class="text-decoration-none">
                                            {{$cat->name . " (" . $cat->books->count() . ')'}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                        <div class="alert alert-danger text-center" role="alert">
                            لانتائج
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection