BEGIN:VCALENDAR
VERSION:2.0
PRODID:{{ $calendarLink->getLink() }}
METHOD:PUBLISH
@foreach($data as $events) @foreach($events as $event)
BEGIN:VEVENT
@if (is_object($event))
UID:{{ $event->id }}{{ '@' }}{{ parse_url(env('APP_URL'), PHP_URL_HOST) }}
LOCATION:{{ $event->locationText() }}
SUMMARY:{{ $event->titleText().' P: '.$event->participantsText('P').' O: '.$event->participantsText('O').' M: '.$event->participantsText('M').($event->description ? ' ('.$event->description.')' : '') }}
DESCRIPTION: {{ str_replace("\r\n", "\\n", wordwrap ($event->descriptionText(), 62, "\\n  ")) }} @if(isset($event->internal_remarks)) \n\nInterne Anmerkungen:\n {{ str_replace("\r\n", "\\n", $event->internal_remarks) }} @endif

CLASS:PUBLIC
DTSTART:{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->day->date->format('Y-m-d').' '.$event->timeText(false).':00', 'Europe/Berlin')->setTimezone('UTC')->format('Ymd\THis\Z') }}
DTEND:{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->day->date->format('Y-m-d').' '.$event->timeText(false).':00', 'Europe/Berlin')->addHour(1)->setTimezone('UTC')->format('Ymd\THis\Z') }}
DTSTAMP:{{ $event->updated_at->setTimezone('UTC')->format('Ymd\THis\Z') }}
@else
    UID:{{ isset($event['id']) ? $event['id'] : uniqid() }}{{ '@' }}{{ parse_url(env('APP_URL'), PHP_URL_HOST) }}
    LOCATION:{!! ($event['place']) !!} @if(isset($event['locationstreet'])), {{ $event['locationstreet'] }}@endif @if(isset($event['locationcity'])), {{ $event['locationzip'] }} {{ $event['locationcity'] }}@endif

    SUMMARY:{!! $event['title'] !!}
    @if(isset($event['description']))
        DESCRIPTION: {!! strip_tags($event['description']) !!}
        @if(isset($event['teaser']))X-ALT-DESC;FMTTYPE=text/html:<!DOCTYPE HTML><HTML><BODY>\n{!! $event['teaser'] !!}\n<HR />\n{!! $event['description'] !!}\n</BODY></HTML>
        @endif
    @endif
    CLASS:PUBLIC
    @if($event['record_type'] == 'OP_Event')
        DTSTART:{{ $event['start']->setTimezone('UTC')->format('Ymd\THis\Z') }}
        @if(isset($event['end']))DTEND:{{ $event['end']->setTimezone('UTC')->format('Ymd\THis\Z') }}
        @else DTEND:{{ $event['start']->copy()->addHour(1)->setTimeZone('UTC')->format('Ymd\THis\Z') }}
        @endif
    @else
        DTSTART:{{ $event['start']->setTimeZone('UTC')->format('Ymd\THis\Z') }}
        @if(isset($event['end']))DTEND:{{ $event['end']->setTimeZone('UTC')->format('Ymd\THis\Z') }}
        @else DTEND:{{ $event['start']->copy()->addHour(1)->setTimeZone('UTC')->format('Ymd\THis\Z') }}
        @endif
    @endif
    DTSTAMP:{{ Carbon\Carbon::now()->setTimezone('UTC')->format('Ymd\THis\Z') }}
@endif
END:VEVENT
@endforeach @endforeach
END:VCALENDAR
