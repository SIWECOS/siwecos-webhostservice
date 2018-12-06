@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>List of Incidents</h4></div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Application</th>
                            <th>Type</th>
                            <th class="text-right">Details</th>
                        </tr>
                        @foreach ($bugreports as $bugreport)
                            <tr>
                                <td>{{ $bugreport->id }}</td>
                                <td>{{ $bugreport->created_at }}</td>
                                <td>{{ config("app.siwecos.applications." . $bugreport->application) }}</td>
                                <td>{{ config("app.siwecos.exploittypes." . $bugreport->exploittype) }}</td>
                                <td class="text-right"><a href="{{ action('Bugreport\BugreportController@show', ['id' => $bugreport->id]) }}" class="btn btn-primary">Show Details</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        <ul class="pagination">
                            <?php echo $bugreports->render(); ?>
                        </ul>
                    </div>

                    <div class="text-right">
                        <a href="{{ action('Api\BugreportController@index') }}" class="small">Get JSON</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection