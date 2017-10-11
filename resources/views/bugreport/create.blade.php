@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{  __('Send Incident Mailing to Webhosts') }}</div>
                    <div class="panel-body">
                        <form>
                            <form action="{{ URL( '/bugreport' )  }}" method="post" name="bugreport">
                                {!! csrf_field() !!}
                                <fieldset>
                                    <legend>E-Mail Details</legend>
                                    <div class="form-group">
                                        <label for="application">{{  __('CMS') }}</label>
                                        <select name="application" id="application" class="form-control">
                                            <option value="">- Select -</option>
                                            @foreach ($applications as $applicationId => $applicationName)
                                                <option value="{{ $applicationId }}">{{ $applicationName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="version">{{  __('Version') }}</label>
                                        <input type="text" class="form-control" id="version" name="version" placeholder="1.0" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="exploittype">{{  __('Type of') }}</label>
                                        <select name="exploittype" id="exploidtype" class="form-control">
                                            <option value="">- Select -</option>
                                            @foreach ($exploittypes as $typeId => $typeName)
                                                <option value="{{ $typeId }}">{{ $typeName  }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="vulnerability">{{  __('Vulnerability Description') }}</label>
                                        <textarea class="form-control" id="vulnerability" name="vulnerability" rows="15" required="required" cols="20"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>{{  __('Can be filtered?') }}</label>
                                        <div class="checkbox">
                                            <label for="filterable">
                                                <input type="checkbox" id="filterable" name="filterable" value="1" />Yes
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group filterdetails">
                                        <label for="filterdescription">{{ __('Filter Description') }}</label>
                                        <textarea class="form-control" id="filterdescription" name="filterdescription" rows="8" required="required" cols="20"></textarea>
                                    </div>

                                    <div class="form-group filterdetails multiple-form-group">
                                        <label>{{ __('Plaintext Rules') }}</label>
                                        <div class="form-group input-group">
                                            <textarea name="plaintextrules[]" class="form-control"></textarea>
                                            <span class="input-group-btn"><button type="button" class="btn btn-danger btn-add">-</button></span>
                                        </div>
                                        <button class="btn btn-success">Add Rule</button>
                                    </div>

                                    <div class="form-group filterdetails">
                                        <label>{{ __('mod_security Rules') }}</label>
                                        <div class="form-group input-group">
                                            <textarea name="modsecurityrules[]" class="form-control"></textarea>
                                            <span class="input-group-btn"><button type="button" class="btn btn-danger btn-add">-</button></span>
                                        </div>
                                        <button class="btn btn-success">Add Rule</button>
                                    </div>

                                    <div class="form-group">
                                        <label for="infourl">{{  __('Further info (URL)') }}</label>
                                        <input type="text" class="form-control" id="infourl" name="infourl" maxlength="200">
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>E-Mail Signature</legend>
                                    <div class="form-group">
                                        <label for="clipboard">{{  __('Preview') }}</label>
                                        <textarea class="form-control" rows="25" id="clipboard" name="clipboard"></textarea>
                                        <span>Please copy the processed output and sign with our PGP key</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="clipboard">{{  __('Signed E-Mail') }}</label>
                                        <textarea class="form-control" rows="25" id="signed-email" name="signed-email"></textarea>
                                        <span>Paste the signed e-mail body here</span>
                                    </div>
                                </fieldset>
                                <button type="submit" class="btn btn-default disabled" disabled="disabled">{{  __('SUBMIT') }}</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection