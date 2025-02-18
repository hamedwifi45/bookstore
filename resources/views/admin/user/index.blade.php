@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
@endsection

@section('heading')
    عرض الناشر
@endsection

@section('content')
    <a href="{{ route('publishers.create') }}" class="btn btn-primary m-1">
        انشاء الناشر <i class="bi bi-plus font-bold"></i>
    </a>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>الأسم</th>
                        <th>البريد الاكتروني</th>
                        <th>نوع المستخدم</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->level_admin > 1)
                                    <p class="badge bg-success p-2">مدير عام</p>
                                @elseif($user->level_admin > 0)
                                    <p class="badge bg-warning p-2">مدير</p>
                                @else
                                    <p class="badge bg-info p-2">مشتري</p>
                                @endif
                            </td>
                            <td class="d-flex justify-content-start align-items-center">
                                <form style="display: inline-block" action="{{ route('users.destroy', $user->id) }}" method="post" class="me-2">
                                    @csrf
                                    @method('delete')
                                    @if (auth()->user() != $user)
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('هل انت متأكد')" type="submit">حذف</button>

                                    @else
                                        <div class="btn btn-danger btn-sm  disabled"><i class="fa fa-trash"> حذف</i></div>
                                    @endif
                                </form>
                                <form style="display: inline-block" action="{{route('users.update' , $user)}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <select class="form-control form-control-sm" name="admin_level" id="">
                                        <option selected disabled>اختر نوعا</option>
                                        <option value="0" >مستخدم</option>
                                        <option value="1" >مدير</option>
                                        <option value="1" >مدير عام</option>

                                            
                                    </select>
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                </form>
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