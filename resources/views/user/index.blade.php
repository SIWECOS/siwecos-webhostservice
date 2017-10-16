@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>List of Users</h4></div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Company</th>
                            <th>Country</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->company }}</td>
                                <td>{{ $countries[$user->country] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        <ul class="pagination">
                            <?php echo $users->render(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection