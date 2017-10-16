Hi,

you are receiving this e-mail because you subscribed to the SIWECOS webhost service.

The purpose of this mail is to inform you about a security issue that requires your urgent attention:

---------------------------------------

Affected CMS: {{ config('app.siwecos.applications.' . $request["application"]) }}

Affected Versions: {!! $request["version"] !!}

Vulnerability Type: {{ config('app.siwecos.exploittypes.' . $request["exploittype"]) }}

Vulnerability Description:
{!! $request["vulnerability"] !!}

Serverside filtering possible?
@if($request["filterable"])
Yes
@else
No
@endif

@if($request["filterable"])
Filtering Description:
{!! $request["filterdescription"] !!}

mod_security Ruleset:
@if(count($request["modsecurityrules"]))
@foreach($request["modsecurityrules"] as $modsecurityrule)
{!! $modsecurityrule !!}

@endforeach
@endif

mod_security Ruleset:
@if(count($request["plaintextrules"]))
@foreach($request["plaintextrules"] as $plaintextrule)
{!! $plaintextrule !!}

@endforeach
@endif

@endif

Furter information:
{{ $request["infourl"] }}


---------------------------------------

Kind regards
The SIWECOS CMS security team