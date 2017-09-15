Hello {{ $invite->firstname }},

we have an invitation to the Siwecos Webhostserice for you.

Your token: {{ $invite->token }}


The Link {{ url('register') }}?token={{ $invite->token }}


Regards,
Siwecos Webhostserice Team