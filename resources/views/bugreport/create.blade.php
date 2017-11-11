@extends('layouts.base')

@section('content')
    <div class="container incidentform">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>{{  __('Send Incident Mailing to Webhosts') }}</h4></div>
                    <div class="panel-body">
                        <form action="{{ URL( '/bugreport/store' )  }}" method="post" name="bugreport">
                            <fieldset>
                                <legend>E-Mail Details</legend>
                                <div class="form-group">
                                    <label for="application">{{  __('CMS') }} *</label>
                                    <select name="application" id="application" class="form-control" required="required">
                                        <option value="">- Select -</option>
                                        @foreach ($applications as $applicationId => $applicationName)
                                            <option value="{{ $applicationId }}">{{ $applicationName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="version">{{  __('Affected Versions') }} *</label>
                                    <input type="text" class="form-control" id="version" name="version" maxlength="100" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="exploittype">{{  __('Type of') }} *</label>
                                    <select name="exploittype" id="exploittype" class="form-control" required="required">
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

                                <div class="form-group filterdetails rulegroup">
                                    <label>{{ __('Plaintext Rules') }}</label>


                                    <div>
                                        <button class="btn btn-success btn-add" data-group="plaintextrules">Add Rule</button>
                                    </div>
                                </div>

                                <div class="form-group filterdetails rulegroup">
                                    <label>{{ __('mod_security Rules') }}</label>

                                    <div>
                                        <button class="btn btn-success btn-add" data-group="modsecurityrules">Add Rule</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="infourl">{{  __('Further info (URL)') }}</label>
                                    <input type="url" class="form-control" id="infourl" name="infourl" maxlength="200" required="required">
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>E-Mail Signature</legend>
                                <div class="form-group">
                                    <label for="clipboard">{{  __('Preview') }}</label>
                                    <textarea class="form-control" rows="25" id="clipboard" name="clipboard" readonly></textarea>
                                    <span>Please copy the processed output and sign with our PGP key</span>
                                </div>
                                <div class="form-group">
                                    <label for="clipboard">{{  __('Signed E-Mail') }}</label>
                                    <textarea class="form-control" rows="25" id="signedemail" name="signedemail"></textarea>
                                    <span>Paste the signed e-mail body here (Hint: gpg -u hosterservice@siwecos.de --clearsign tmpfile.txt)</span>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-default disabled" disabled="disabled">{{  __('SUBMIT') }}</button>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection