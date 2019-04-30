@extends('layouts.app')

@section('title', 'Herzlich willkommen')

@section('content')
    @component('components.container')
        <h1>Willkommen, {{ $user->name }}!</h1>
        <a class="btn btn-primary btn-lg" href="{{ route('calendar') }}"><span class="fa fa-calendar"></span> Zum Kalender</a>
        <hr />

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" href="#services" role="tab" data-toggle="tab">Meine Gottesdienste @if($services->count())<span class="badge badge-primary">{{ $services->count() }}</span> @endif </a>
            </li>
            @canany(['gd-kasualien-lesen', 'gd-kasualien-bearbeiten'])
            <li class="nav-item">
                <a class="nav-link" href="#baptisms" role="tab" data-toggle="tab">Meine Taufen @if($baptisms->count())<span class="badge badge-primary">{{ $baptisms->count() }}</span> @endif </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#funerals" role="tab" data-toggle="tab">Meine Beerdigungen @if($funerals->count())<span class="badge badge-primary">{{ $funerals->count() }}</span> @endif </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#weddings" role="tab" data-toggle="tab">Meine Trauungen @if($weddings->count())<span class="badge badge-primary">{{ $weddings->count() }}</span> @endif </a>
            </li>
            @endcanany
        </ul>

        <div class="tab-content">
            <br />
            <div role="tabpanel" class="tab-pane fade in active show" id="services">
                <h2>Meine nächsten Gottesdienste</h2>
                <p>Angezeigt werden die Gottesdienste der nächsten 2 Monate</p>
                <div class="table-responsive">
                    <table class="table table-striped" width="100%">
                        <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Zeit</th>
                            <th>Ort</th>
                            <th>Details</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->day->date->format('d.m.Y') }}</td>
                                <td>{{ $service->timeText() }}</td>
                                <td>{{ $service->locationText() }}</td>
                                <td>
                                    @if($service->weddings->count())
                                        <div class="service-description">
                                            <span class="fa fa-ring"></span> {{ $service->weddingsText() }}
                                        </div>
                                    @endif
                                    @if($service->funerals->count())
                                        <div class="service-description">
                                            <span class="fa fa-cross"></span> {{ $service->funeralsText() }}
                                        </div>
                                    @endif
                                    <div class="service-team service-pastor"><span
                                                class="designation">P: </span>
                                        @if ($service->need_predicant)
                                            <span class="need-predicant">Prädikant benötigt</span>
                                        @else
                                            {{ $service->pastor }}
                                        @endif
                                    </div>
                                    <div class="service-team service-organist"><span
                                                class="designation">O: </span>{{ $service->organist }}</div>
                                    <div class="service-team service-sacristan"><span
                                                class="designation">M: </span>{{ $service->sacristan }}</div>
                                    <div class="service-description">{{ $service->descriptionText() }}</div>
                                    @if($service->baptisms->count())
                                        <div class="service-description">
                                            @if($service->baptisms->count()) <span class="fa fa-water" title="{{ $service->baptismsText(true) }}"></span> {{ $service->baptisms->count() }} @endif
                                        </div>
                                    @endif
                                    @if($service->cc) <img src="{{ env('APP_URL') }}img/cc.png" title="Parallel Kinderkirche ({{ $service->cc_location }}) zum Thema {{ '"'.$service->cc_lesson.'"' }}: {{ $service->cc_staff }}"/> @endif
                                </td>
                                <td>
                                    @include('partials.service.edit-rites-block', ['service', $service])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @canany(['gd-kasualien-lesen', 'gd-kasualien-bearbeiten'])
            <div role="tabpanel" class="tab-pane fade" id="baptisms">
                <h2>Meine Taufen</h2>
                <p>Angezeigt werden alle bereits bekannten Taufen in den nächsten 365 Tagen.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Zeit</th>
                            <th>Ort</th>
                            <th>Details</th>
                            <th>Täufling</th>
                            <th>Erstkontakt</th>
                            <th>Taufgespräch</th>
                            <th>Anmeldung</th>
                            <th>Urkunden</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($baptisms as $service)
                            @foreach($service->baptisms as $baptism)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ $service->baptisms->count() }}">{{ $service->day->date->format('d.m.Y') }}</td>
                                        <td rowspan="{{ $service->baptisms->count() }}">{{ $service->timeText() }}</td>
                                        <td rowspan="{{ $service->baptisms->count() }}">{{ $service->locationText() }}</td>
                                        <td rowspan="{{ $service->baptisms->count() }}">
                                            @include('partials.service.details', ['service' => $service])
                                        </td>
                                    @endif
                                    @include('partials.baptism.details', ['baptism' => $baptism])
                                    @if ($loop->first)
                                        <td rowspan="{{ $service->baptisms->count() }}">
                                            @include('partials.service.edit-rites-block', ['service', $service])
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="funerals">
                <h2>Meine Beerdigungen</h2>
                <p>Angezeigt werden alle bereits bekannten Beerdigungen.</p>
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
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($funerals as $service)
                            @foreach($service->funerals as $funeral)
                                <tr>
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
                                            <a class="btn btn-sm btn-secondary" href="{{ route('funeral.form', $funeral->id) }}" title="Formular für Kirchenregisteramt"><span class="fa fa-file-pdf"></span></a>
                                        </td>
                                    @if ($loop->first)
                                        <td rowspan="{{ $service->funerals->count() }}">
                                            <a class="btn btn-sm btn-secondary" href="{{ route('calendar', ['month' => $service->day->date->format('m'), 'year' => $service->day->date->format('Y')]) }}" title="Im Kalender ansehen"><span class="fa fa-calendar"></span></a>
                                            <a class="btn btn-sm btn-primary" href="{{route('services.edit', $service->id).'#rites'}}" title="Bearbeiten"><span class="fa fa-edit"></span></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="weddings">
                <h2>Meine Trauungen</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Zeit</th>
                            <th>Ort</th>
                            <th>Details</th>
                            <th>Ehepartner 1</th>
                            <th>Ehepartner 2</th>
                            <th>Traugespräch</th>
                            <th>Anmeldung</th>
                            <th>Urkunden</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($weddings as $service)
                            @foreach($service->weddings as $wedding)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ $service->weddings->count() }}">{{ $service->day->date->format('d.m.Y') }}</td>
                                        <td rowspan="{{ $service->weddings->count() }}">{{ $service->timeText() }}</td>
                                        <td rowspan="{{ $service->weddings->count() }}">{{ $service->locationText() }}</td>
                                        <td rowspan="{{ $service->weddings->count() }}">
                                            @include('partials.service.details', ['service' => $service])
                                        </td>
                                    @endif
                                    @include('partials.wedding.details', ['wedding' => $wedding])
                                    @if ($loop->first)
                                        <td rowspan="{{ $service->weddings->count() }}">
                                            @include('partials.service.edit-rites-block', ['service', $service])
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endcanany
        </div>
    @endcomponent
@endsection