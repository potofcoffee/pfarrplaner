<?php
/**
 * Created by PhpStorm.
 * User: Christoph Fischer
 * Date: 17.05.2019
 * Time: 08:46
 */

namespace App\Misc;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class VersionInfo
{

    /**
     * Get version "what's new" messages
     * @return Collection
     */
    public static function getMessages()
    {
        return collect([
            [
                'date' => Carbon::createFromFormat('d.m.Y', '06.08.2019'),
                'text' => 'Eine automatisch aktualisierte Übersicht der nächsten Gottesdienste kann in die Homepage der Kirchengemeinde (Gemeindebaukasten) '
                .'eingebunden werden. Mehr dazu aus der Kalenderansicht unter "Ausgaben..." > "Liste von Gottesdiensten"',
            ],
            [
                'date' => Carbon::createFromFormat('d.m.Y', '05.08.2019'),
                'text' => 'Einzelne Gottesdienste können nun per Klick in Outlook übernommen werden.'
            ],
            [
                'date' => Carbon::createFromFormat('d.m.Y', '18.07.2019'),
                'text' => 'Pfarrer können Trauungen direkt vom Startbildschirm aus anlegen.'
            ],
            [
                'date' => Carbon::createFromFormat('d.m.Y H:i:s', '17.05.2019 18:00:00'),
                'text' => 'E-Mailbenachrichtungen für neue/geänderte Gottesdienste können nun selbst im Menü unter  <a href="'.route('user.profile').'">'
                .'<span class="fa fa-user"></span>&nbsp;'
                .Auth::user()->name.' > Mein Profil</a> an- und abbestellt werden.',
            ],
            [
                'date' => Carbon::createFromFormat('d.m.Y', '14.05.2019'),
                'text' => 'E-Mailbenachrichtigungen zu neuen/geänderten Gottesdienste enthalten nun eine .ics-Datei im Anhang, die als
                Termin direkt in Outlook importiert werden kann.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '13.05.2019'),
                'text' => 'Kommentare können nun auch bei Kasualien angelegt werden.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '13.05.2019'),
                'text' => 'Beerdigungen können nun von Pfarrern vom Startbildschirm aus angelegt werden. Dabei werden die Einträge für
                Tag (falls noch nicht angelegt) und Gottesdienst automatisch angelegt.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '13.05.2019'),
                'text' => 'Das Schließen der Detailansicht eines Gottesdienstes löst nur noch dann einen Speichervorgang (und eine
                E-Mailbenachrichtigung) aus, wenn tatsächlich etwas verändert wurde.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '13.05.2019'),
                'text' => 'Taufen können nun zunächst als Taufantrag ohne Datum angelegt werden (über den Button, der bei Pfarrern und
                beim Kirchenregisteramt auf der Startseite erscheint).'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '24.04.2019'),
                'text' => 'Für jeden Benutzer gibt es jetzt einen Startbildschirm mit einer Übersicht der für ihn relevanten Daten.
        Für unterschiedliche Benutzertypen gibt es dabei verschiedene Varianten dieses Startbildschirms.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '24.04.2019'),
                'text' => 'Gottesdiensten können nun Kasualien (Bestattung, Taufe, Trauung) mit den entsprechenden Daten zugeordnet
                werden. Alle persönlichen Daten werden dabei ausschließlich verschlüsselt gespeichert und erst für die Anzeige
                entschlüsselt.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '03.04.2019'),
                'text' => 'Beim Anlegen von Tagen, die nur für bestimmte Gemeinden angezeigt werden sollen ("lilane Tage") ist es nun
                möglich, auch "fremde" Gemeinden auszuwählen.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '29.03.2019'),
                'text' => '"Lilane" Tage, die einen Gottesdienst enthalten, für den der aktuelle Nutzer eingeteilt sind,
                werden snun automatisch aufgeklappt.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '08.03.2019'),
                'text' => 'Der Organistenplan kann nun unter "Sammeleingabe > Organistenplan" für ein ganzes Jahr auf einmal
                bearbeitet werden.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '08.03.2019'),
                'text' => 'Es können nun Tage angelegt werden, die nur für bestimmte Gemeinden angezeigt werden sollen. Diese Tage
                werden im Kalender als lila Streifen angezeigt und erst auf ein Klicken hin eingeblendet.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '28.02.2019'),
                'text' => 'Der Urlaub der Pfarrer wird nur noch den Personen angezeigt, die auch Pfarrer einteilen dürfen.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '28.02.2019'),
                'text' => 'Nur Personen, die allgemeine Gottesdienstdaten bearbeiten dürfen, können auch neue Gottesdienste anlegen.'
            ],


            [
                'date' => Carbon::createFromFormat('d.m.Y', '28.02.2019'),
                'text' => 'Der Plan für die Kinderkirche kann nun ohne Login unter '.url('kinderkirche/{kirchengemeinde}').' (also z.B.
                <a href="'.url('kinderkirche/tailfingen').'">'.url('kinderkirche/tailfingen').'</a>) eingesehen werden.
        Außerdem steht der Plan unter "Ausgabe > Programm für die Kinderkirche" als PDF-Datei zur Verfügung.'
                            ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '28.02.2019'),
                    'text' => 'Der Plan für die Kinderkirche kann nun für ein ganzes Jahr unter "Sammeleingabe > Kinderkirche" bearbeitet werden.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '28.02.2019'),
                    'text' => 'Separate Benutzerrechte für die Bearbeitung von Informationen zu Opfer und Kinderkirche.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '28.02.2019'),
                    'text' => 'Neue Felder für weitere am Gottesdienst Beteiligte und Kinderkirche.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '22.02.2019'),
                    'text' => 'Das Gottesdienstformular ist übersichtlicher in mehrere Reiter unterteilt.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '22.02.2019'),
                    'text' => 'Der komplette Opferplan einer Gemeinde für ein Jahr kann jetzt unter "Sammeleingabe > Opferplan" auf einmal bearbeitet werden.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '22.02.2019'),
                    'text' => 'Die verschiedenen Ausgabeformate sind jetzt übersichtlicher auf einer separaten Seite angeordnet. Bei der
                Ausgabe für den Gemeindebrief kann zwischen verschiedenen Formaten (Tailfingen, Truchtelfingen) gewählt werden.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '20.02.2019'),
                    'text' => 'Öffentlich (d.h. ohne Passwort) einsehbarer Vertretungsplan unter ' . url('vertretungen')
                ],
        
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '14.02.2019'),
                    'text' => 'Mit "Berichte &gt; Jahresplan der Gottesdienste" kann eine Exceldatei mit einem Jahresplan aller Gottesdienste (inkl. Opfer) erzeugt werden.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '14.02.2019'),
                    'text' => 'Zu den Gottesdiensten können nun auch Opferzweck, Opferzähler, usw. angegeben werden. "Taufe" und "Abendmahl" sind Ankreuzfelder geworden, die den
                entsprechenden Text automatisch in die Anmerkungen einfügen und z.B. in Statistiken, usw. relevant sind.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '13.02.2019'),
                    'text' => 'Mit "Berichte &gt; Prädikantenanforderung" kann das Prädikantenformular für das Dekanat automatisch erstellt werden.'
                ],
            
            
                [
                    'date' => Carbon::createFromFormat('d.m.Y', '12.02.2019'),
                    'text' => 'Statt einen Pfarrer anzugeben, kann jetzt bei einem Gottesdienst angekreuzt werden, dass ein Prädikant benötigt wird. Dies wird im Kalender rot hervorgehoben.
        (Wenn der Eintrag "Prädikant benötigt" im Kalender nicht rot erscheint, Seite mit Strg+F5 neu laden.)'
                ],
            

        ]);
    }

}