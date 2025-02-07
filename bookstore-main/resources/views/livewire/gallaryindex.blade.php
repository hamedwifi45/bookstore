
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
                        @if ($book->categor != null)
                                <a href="{{route('Gallary.category.show', $book->categor)}}" class="text-muted" data-abc="true">
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
