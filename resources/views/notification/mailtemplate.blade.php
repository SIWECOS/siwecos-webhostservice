Hi,

you are receiving this e-mail because you subscribed to the SIWECOS webhost service.

The purpose of this mail is to inform you an upcoming {{ config('app.siwecos.applications.' . $request["application"]) }} security release.

It is scheduled for {{ $request['date'] }} at {{ $request['time'] }} UTC.

The issue is considered as critical and so we would like to encourage you to notify your customers about the upcoming release.

@if($request["filterable"])
Furthermore, we'll share a set of WAF rules with you, once the patch is available.

@endif
If you have any further questions, feel free to ask!

Kind regards
The SIWECOS CMS security team
