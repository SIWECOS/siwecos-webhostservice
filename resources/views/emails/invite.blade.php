Hello {{ $invite->name }},

{{ $invitee->name }} invited you to the SIWECOS Webhost service mailinglist.

To learn more about the project, please read the description on our homepage: https://siwecos.de/service-fuer-webhoster/

In order to accept the invite and complete your registration, please follow this personal link:
{{ url('register') }}?token={{ $invite->token }}

Regards,
Siwecos Webhostserice Team