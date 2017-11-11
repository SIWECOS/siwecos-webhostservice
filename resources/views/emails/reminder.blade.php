Hello {{ $user->name }},

this is a period reminder from the SIWECOS Webhost service mailinglist.

We want to make sure that you are still receiving our security notifications, in order to do so we would like to ask you to confirm your account by clicking on this link:
{{ url('confirmreminder') }}?token={{ $user->last_reminder_token }}&user={{ (int) $user->id }}

Thanks!

Regards,
Siwecos Webhostserice Team