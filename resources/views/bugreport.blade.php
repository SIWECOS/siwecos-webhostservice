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
    <form action="/bugreport" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</form>
</body>
</html>