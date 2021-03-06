@extends('layouts.app')

@section('title', 'Gottesdienstliste für den Gemeindebrief erstellen')

@section('content')
    <form method="post" action="{{ route('report.step', ['report' => $report, 'step' => 'configure']) }}">
        <div class="card">
            <div class="card-body">
                @csrf
                <div class="form-group"> <!-- Radio group !-->
                    <label class="control-label">Folgende Kirchengemeinden mit einbeziehen:</label>
                    @foreach ($cities as $city)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="includeCities[]"
                                   value="{{ $city->id }}"
                                   id="defaultCheck{{$city->id}}"
                                   @if(Auth::user()->cities->contains($city)) checked @endif >
                            <label class="form-check-label" for="defaultCheck{{$city->id}}">
                                {{$city->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="start">Gottesdienste von:</label>
                    <input type="text" class="form-control datepicker" name="start" value="{{ date('d.m.Y') }}"
                           placeholder="TT.MM.JJJJ"/>
                </div>
                <div class="form-group">
                    <label for="end">Bis:</label>
                    <input type="text" class="form-control datepicker" name="end" value="{{ $maxDate->date->format('d.m.Y') }}"
                           placeholder="TT.MM.JJJJ"/>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Weiter zu Schritt 2 ></button>
            </div>
        </div>
    </form>
@endsection
