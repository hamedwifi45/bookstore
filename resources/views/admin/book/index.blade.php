@extends('theme.default')
@section('head')
<link href="{{asset("theme/vendor/datatables/dataTables.bootstrap4.min.css")}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
@section('heading')
 عرض الكتب
@endsection
@section('content')
<a href="{{route('books.create')}}" class="btn btn-primary m-1">انشاء كتاب <i class="bi bi-plus font-bold"></i> </a>
<hr>
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered " width="100%" collspacing='0'>
                <thead>
                    <tr>
                        <th>العنوان</th>
                        <th>الرقم التسلسلي</th>
                        <th>التصنيف</th>
                        <th>المؤلفون</th>
                        <th>الناشرون</th>
                        <th>سعر الكتاب</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td><a href="{{route("books.show", $book->title)}}">{{ $book->title }}</a></td>
                            <td>{{$book->isbn}}</td>
                            <td>{{$book->categor != null? $book->categor->name : ''}}</td>
                            <td>
                                @if ($book->auther->count() > 0)
                                    @foreach ($book->auther as $auther )
                                        {{$loop->first ? '' : ','}}
                                        {{$auther->name}}
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$book->publisher != null ? $book->publisher->name : ''}}</td>
                            <td>{{$book->price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{asset("theme/vendor/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("theme/vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>
    <script>
        $(document).ready(function(){
            $('#books-table').DataTable({
                language: {
        url: '//cdn.datatables.net/plug-ins/2.2.1/i18n/ar.json',
    },
            });
        });
    </script>
@endsection