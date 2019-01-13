<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Reservation;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
class CalendarController extends Controller
{
    public function index(){

        $events = [];
        $data = Reservation::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $apartment = Apartment::where('id', $value->apartment_id)->first();
                $n = "  (" . $value->name . ")";
                $title = [$apartment->location, $n];
                $title = implode(',', $title);
                $colors = ['darkcyan', 'darkred', 'darkyellow', 'grey', 'yellow', 'lightred','brown'];
                $events[] = Calendar::event(
                    $title,
                    true,
                    new \DateTime($value->check_in),
                    new \DateTime($value->check_out),
                    $value->id,
                    // Add color and link on event

                    [
                        'color' => $colors[array_rand($colors)],

                    ]


                );
            }

        }
        $calendar = Calendar::addEvents($events)->setOptions([

            //set fullcalendar options
            'selectable'=>true,
            'defaultView'=>'month',
            'editable'=>true,

        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)

            'dayClick' => 'function(date) {
              $(\'input[name=check_in]\').val(date.format());
            $(\'#addReservation\').modal(\'show\');}',
            'select'=> 'function(startDate, endDate) {
             $(\'input[name=check_in]\').val(startDate.format());
              $(\'input[name=check_out]\').val(endDate.format());
            $(\'#addReservation\').modal(\'show\');}',
                'eventClick'=>'function(event) {
          
            $(\'#viewReservationDetails-\'+event.id).modal(\'show\');}',
            'eventDrop'=>'function(event, view) {
           $(\'input[name=check_in]\').val(event.start.format());
           $(\'input[name=check_out]\').val(event.end.format());
            $(\'#editReservation-\'+event.id).modal(\'show\');
            
            }',

            'eventResizeStop'=>'function(event, view) {
           $(\'input[name=check_in]\').val(event.start.format());
           $(\'input[name=check_out]\').val(event.end.format());
            $(\'#editReservation-\'+event.id).modal(\'show\');
            }',
           'eventDrop'=>'function(event) {
          if (!confirm("Are you sure want to change the date?")) {
         revertFunc();
         }else{
          $(\'input[name=check_in]\').val(event.start.format());
           $(\'input[name=check_out]\').val(event.end.format());
            $(\'#editReservation-\'+event.id).modal(\'show\');
         }
           }',
            'eventResizeStop'=>'function(event) {
          if (!confirm("Are you sure you want to change the date?")) {
         revertFunc();
         }else{
          $(\'input[name=check_in]\').val(event.start.format());
           $(\'input[name=check_out]\').val(event.end.format());
            $(\'#editReservation-\'+event.id).modal(\'show\');
         }
           }',
        ]);
        return view('admin.calendar', compact('calendar'));
    }
}
