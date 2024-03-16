<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private $ReservationService;


    public function __construct(ReservationService $ReservationService) {
        $this->ReservationService = $ReservationService;
    }

    public function index()
    {
        $tables = Table::where('status', 'available')->get();
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.index', compact('tables', 'min_date', 'max_date'));
    }

    public function store(ReservationStoreRequest $request)
    {
        $table = Table::findOrFail($request->table_id);

        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose table based on guest number');
        }

        $res_date = Carbon::parse($request->res_date);

        foreach ($table->reservations as $res) {
            $q_date = Carbon::parse($res->res_date);

            if ($q_date->format('Y-m-d') == $res_date->format('Y-m-d')) {
                return back()->with('warning', 'This table is taken for this date');
            }
        }

        $reservation = $this->ReservationService->storeReservation($request->validated());

        return to_route('frontend.reservations.data',['reservation'=> $reservation->id])->with('success', 'Reservation Completed Successfully');
    }

    public function data(Reservation $reservation)
    {
        return view('reservations.data', compact('reservation'));
    }
}
