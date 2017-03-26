<?php
/**
 * Bug Report-Form View
 *
 * @author   Florian Häusler
 */
?>
@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{  __('SEND ALERT TO WEB HOSTERS') }}</div>
                    <div class="panel-body">
                        <form>
                            <form action="/bugreport" method="post" name="bugreport">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="email">{{  __('Your account') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" maxlength="80">
                                </div>
                                <fieldset>
                                    <div class="form-group">
                                        <label for="application">{{  __('CMS') }}</label>
                                        <select name="application" id="application">
                                            @foreach ($applications as $application)
                                                <option value="{{ $application->value }}">{{ $application->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="version">{{  __('Version') }}</label>
                                        <input type="text" class="form-control" id="version" name="version"
                                               placeholder="1.0" maxlength="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="exploidtype">{{  __('Type of') }}</label>
                                        <select name="exploidtype" id="exploidtype">
                                            @foreach ($exploidtypes as $type)
                                                <option value="{{ $type->value }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vulnerability">{{  __('Vulnerability') }}</label>
                                        <textarea class="form-control" id="vulnerability" name="vulnerability" rows="3"
                                                  cols="20"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exploidpattern">{{  __('Exploid pattern') }}</label>
                                        <input type="text" class="form-control" id="exploidpattern"
                                               name="exploidpattern" maxlength="500">
                                    </div>
                                    <div class="form-group">
                                        <label for="textcase">{{  __('Text case') }}</label>
                                        <textarea class="form-control" id="textcase" name="textcase" rows="3"
                                                  cols="20"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="url">{{  __('Further info (URL)') }}</label>
                                        <input type="text" class="form-control" id="url" name="url" maxlength="200">
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <button class="btn btn-default">{{  __('PROCESS PREVIEW') }}</button>
                                </div>
                                <fieldset>
                                    <div class="form-group">
                                        <label for="clipboard">{{  __('Clipboard') }}</label>
                                        <textarea class="form-control" id="clipboard" name="clipboard"></textarea>
                                        <button class="btn btn-default">{{  __('copy') }}</button>
                                        <span>Please copy the processed output and sign with your PGP key</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pgpid">{{  __('Your PGP ID') }}</label>
                                        <input type="text" class="form-control" id="pgpid" name="pgpid">
                                    </div>
                                    <div class="form-group">
                                        <label for="clipboard">{{  __('Paste') }}</label>
                                        <textarea class="form-control" id="signed-email" name="signed-email"></textarea>
                                        <span>Paste the signed e-mail body here</span>
                                    </div>
                                </fieldset>
                                <button type="submit" class="btn btn-default">{{  __('SUBMIT') }}</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection