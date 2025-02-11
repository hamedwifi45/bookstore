@extends('theme.default')
@section('heading')
    لوحة تحكم
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning  shadow  h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                عدد الكتب</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$number_of_book}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           عدد الؤلفين</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$number_of_auther}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-pen-fancy fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           عدد الناشرين</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$number_of_publisher}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-table fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            عدد التصنيفات</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$number_of_category}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning  shadow  h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            الكتب التي ستنفذ</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <div class="dropdown open">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            عرض الكتب
                                        </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    @foreach ($bookv as $book )
                                        <a class="dropdown-item" href="{{route('books.show', $book)}}">{{$book->title}} </a>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning  shadow  h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            الكتب الأكثر مشاهدة
</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <div class="dropdown open">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            الكتب
                                        </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    @foreach ($bookm as $book )
                                        <a class="dropdown-item" href="{{route('books.show', $book)}}">{{$book->title}} </a>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
    

@endsection