@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section(section: 'heading')
    عرض المؤلفون
@endsection

@section('content')
    <a href="{{ route('authers.create') }}" class="btn btn-primary m-1">
        انشاء المؤلف <i class="bi bi-plus font-bold"></i>
    </a>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>العنوان</th>
                        <th>الوصف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auther as $authers)
                        <tr>
                            <td>
                                <a href="{{ route('authers.show', $authers) }}">{{ $authers->name }}</a>
                            </td>
                            <td>{{ $authers->description }}</td>
                            <td class="d-flex justify-content-start align-items-center">
                                <form action="{{ route('authers.destroy', $authers->id) }}" method="post" class="me-2">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" type="submit">حذف</button>
                                </form>
                                <a class="btn btn-info btn-sm" href="{{ route('authers.edit', $authers) }}">
                                    <i class="bi bi-pencil-square"></i> تعديل
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#books-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.2.1/i18n/ar.json'
                },
            });
        });
    </script>
@endsection