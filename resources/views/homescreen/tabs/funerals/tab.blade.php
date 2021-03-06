@tab(['id' => $tab->getKey(), 'active' => ($index == 0)])
    <h2>{{ $tab->getTitle() }}</h2>
    <p>Angezeigt werden alle bereits bekannten Beerdigungen, sowie die Beerdigungen der letzten 2 Wochen.</p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Datum</th>
                <th>Zeit</th>
                <th>Ort</th>
                <th>Details</th>
                <th>Person</th>
                <th>Bestattungsart</th>
                <th>Trauergespräch</th>
                <th>Abkündigung</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($funerals as $service)
                @foreach($service->funerals as $funeral)
                    <tr class="@if($service->day->date < \Carbon\Carbon::now())past @else future @endif">
                        @if ($loop->first)
                            <td rowspan="{{ $service->funerals->count() }}">{{ $service->day->date->format('d.m.Y') }}</td>
                            <td rowspan="{{ $service->funerals->count() }}">{{ $service->timeText() }}</td>
                            <td rowspan="{{ $service->funerals->count() }}">{{ $service->locationText() }}</td>
                            <td rowspan="{{ $service->funerals->count() }}">
                                @include('partials.service.details', ['service' => $service])
                            </td>
                        @endif
                        @include('partials.funeral.details', ['funeral' => $funeral])
                        <td>
                            <a class="btn btn-sm btn-secondary"
                               href="{{ route('funeral.form', $funeral->id) }}"
                               title="Formular für Kirchenregisteramt"><span
                                    class="fa fa-file-pdf"></span></a>
                        </td>
                        @if ($loop->first)
                            <td rowspan="{{ $service->funerals->count() }}">
                                <a class="btn btn-sm btn-secondary"
                                   href="{{ route('calendar', $service->day->date->format('Y-m')) }}"
                                   title="Im Kalender ansehen"><span class="fa fa-calendar"></span></a>
                                <a class="btn btn-sm btn-primary"
                                   href="{{route('services.edit', $service->id).'#rites'}}"
                                   title="Bearbeiten"><span class="fa fa-edit"></span></a>
                                @can('gd-kasualien-bearbeiten')
                                    <a class="btn btn-sm btn-primary"
                                       href="{{route('funerals.edit', $funeral)}}?back=/home"
                                       title="Beerdigung bearbeiten"><span class="fa fa-edit"></span>
                                        <span
                                            class="fa fa-cross"></span></a>
                                @endcan
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endtab
