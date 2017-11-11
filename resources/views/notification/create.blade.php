@extends('layouts.base')

@section('content')
    <div class="container notificationform">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>{{  __('Send Pre-Notification Mailing to Webhosts') }}</h4></div>
                    <div class="panel-body">
                        <form action="{{ URL( '/notification/send' )  }}" method="post" name="notificationreport">
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
                                    <label for="version">{{  __('Date UTC') }} *</label>
                                    <input type="date" class="form-control" id="date" name="date" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="version">{{  __('Time UTC') }} *</label>
                                    <input type="time" class="form-control" id="time" name="time" required="required">
                                </div>

                                <div class="form-group">
                                    <label>{{  __('Can be filtered?') }}</label>
                                    <div class="checkbox">
                                        <label for="filterable">
                                            <input type="checkbox" id="filterable" name="filterable" value="1" />Yes
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="announcement">{{  __('Announcement URL') }}</label>
                                    <input type="url" class="form-control" id="announcement" name="announcement">
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
                            <button type="submit" class="btn btn-success disabled" disabled="disabled">{{  __('Send Mail') }}</button>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection