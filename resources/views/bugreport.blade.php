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
    <h1>SEND ALERT TO WEB HOSTERS</h1>
    <form action="/bugreport" method="post" name="bugreport">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email">Your account</label>
            <input type="email" class="form-control" id="email" name="email" maxlength="80">
        </div>
        <fieldset>
            <div class="form-group">
                <label for="application">CMS</label>
                <select name="application" id="application">
                    @foreach ($applications as $application)
                        <option value="{{ $application->value }}">{{ $application->name }}</option>
                    @endforeach
                </select>
                <label for="version">Version</label>
                <input type="text" class="form-control" id="version" name="version" placeholder="1.0"  maxlength="100">
            </div>
            <div class="form-group">
                <label for="exploidtype">Type of</label>
                <select name="exploidtype" id="exploidtype">
                    @foreach ($exploidtypes as $type)
                        <option value="{{ $type->value }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="vulnerability">Vulnerability</label>
                <textarea class="form-control" id="vulnerability" name="vulnerability" rows="3" cols="20" ></textarea>
            </div>
            <div class="form-group">
                <label for="exploidpattern">Exploid pattern</label>
                <input type="text" class="form-control" id="exploidpattern" name="exploidpattern" maxlength="500">
            </div>
            <div class="form-group">
                <label for="textcase">Text case</label>
                <textarea class="form-control" id="textcase" name="textcase" rows="3" cols="20" ></textarea>
            </div>
            <div class="form-group">
                <label for="url">Further info (URL)</label>
                <input type="text" class="form-control" id="url" name="url" maxlength="200">
            </div>
        </fieldset>
            <div class="form-group">
                <button>PROCESS PREVIEW</button>
            </div>
        <fieldset>
            <div class="form-group">
                <label for="clipboard">Clipboard</label>
                <textarea class="form-control" id="clipboard" name="clipboard" ></textarea>
                <button>copy</button>
                <span>Please copy the processed output and sign with your PGP key</span>
            </div>
            <div class="form-group">
                <label for="pgpid">Your PGP ID</label>
                <input type="text" class="form-control" id="pgpid" name="pgpid">
            </div>
            <div class="form-group">
                <label for="clipboard">Paste</label>
                <textarea class="form-control" id="signed-email" name="signed-email" ></textarea>
                <span>Paste the signed e-mail body here</span>
            </div>
        </fieldset>
        <button type="submit" class="btn btn-default">SUBMIT</button>
    </form>
</form>
</body>
</html>