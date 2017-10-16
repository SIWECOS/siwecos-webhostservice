@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>{{  __('Incident Details') }}</h4></div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>{{  __('CMS') }} </dt>
                            <dd>{{ config("app.siwecos.applications." . $report->application) }}</dd>
                            <dt>{{  __('Affected Versions') }} </dt>
                            <dd>{{ $report->version }}</dd>
                            <dt>{{  __('Exploittype') }} </dt>
                            <dd>{{ config("app.siwecos.exploittypes." . $report->exploittype) }}</dd>
                            <dt>{{  __('Vulnerability Description') }}</dt>
                            <dd>{!! nl2br(e($report->vulnerability)) !!} </dd>
                            <dt>{{  __('Can be filtered?') }}</dt>
                            <dd>@if($report->filterable)Yes @else No @endif</dd>
                            @if($report->filterable)
                            <dt>{{ __('Filter Description') }}</dt>
                            <dd>{!! nl2br(e($report->filterdescription)) !!} </dd>
                            <dt>{{ __('Plaintext Rules') }}</dt>
                            <dd>
                                @if(count($report->plaintextrules))
                                    @foreach($report->plaintextrules as $rule)
                                        <pre>{{ $rule }}</pre>
                                    @endforeach
                                @else
                                No rules provided
                                @endif
                            </dd>
                            <dt>{{ __('mod_security Rules') }}</dt>
                            <dd>
                                @if(count($report->modsecurityrules))
                                    @foreach($report->modsecurityrules as $rule)
                                        <pre>{{ $rule }}</pre>
                                    @endforeach
                                @else
                                    No rules provided
                                @endif
                            </dd>
                            @endif
                            <dt>{{ __('Further info (URL)') }}</dt>
                            <dd>{{ $report->infourl }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection