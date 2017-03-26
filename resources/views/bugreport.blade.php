<?php
/**
 * Bug Report-Form View
 *
 * @author   Florian Häusler>
 */
?>
<html>
<body>
<form>
    <h1>Submit a bug</h1>
    <form action="/bugreport" method="post" name="bugreport">
        {!! csrf_field() !!}
        <fieldset>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="1.0">
            </div>
            <div class="form-group">
                <label for="application">Application</label>
                <select name="application" id="application">
                    @foreach ($applications as $application)
                        <option value="{{ $application->value }}">{{ $application->name }}</option>
                    @endforeach
                </select>
                <label for="version">Version</label>
                <input type="text" class="form-control" id="version" name="version" placeholder="1.0">
            </div>
            <div class="form-group">
                <label for="typeof">Type of</label>
                <input type="text" class="form-control" id="typeof" name="typeof" placeholder="1.0">
            </div>
            <div class="form-group">
                <label for="typeof">Type of</label>
                <input type="text" class="form-control" id="typeof" name="typeof" placeholder="1.0">
            </div>
            <div class="form-group">
                <label for="typeof">Exploid</label>
                <input type="text" class="form-control" id="typeof" name="typeof" placeholder="1.0">
            </div>
            <div class="form-group">
                <label for="report">Report</label>
                <textarea class="form-control" id="report" name="report" ></textarea>
            </div>
            <button>Generate preview</button>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <label for="clipboard">Clipboard</label>
                <textarea class="form-control" id="clipboard" name="clipboard" ></textarea>
            </div>
            <div class="form-group">
                <label for="clipboard">signed-email</label>
                <textarea class="form-control" id="signed-email" name="signed-email" ></textarea>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</form>
</body>
</html>