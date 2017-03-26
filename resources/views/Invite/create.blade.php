@extends('layouts.base')
@section('content')
    <form action="{{ url('/invite/store') }}" method="post">
        <label for="firstname">{{  __('Firstname') }}</label>
        <input type="text" name="firstname" id="firstname">

        <label for="lastname">{{  __('Lastname') }}</label>
        <input type="text" name="lastname" id="lastname">

        <label for="email">{{  __('E-Mail') }}</label>
        <input type="text" name="email" id="email">

        <label for="reason">{{  __('Reason') }}</label>
        <textarea id="reason" name="reason"></textarea>

        <input type="submit" value="{{ __('Submit') }}" />
        {{ csrf_field() }}
    </form>
@stop