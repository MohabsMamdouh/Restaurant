<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = $this->ReservationService->getReservations();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', 'available')->get();
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('admin.reservations.create', compact('tables', 'min_date', 'max_date'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return to_route('admin.reservations.index')->with('success', 'Reservation Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', 'available')->get();
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('admin.reservations.edit', compact('reservation', 'tables', 'min_date', 'max_date'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationUpdateRequest $request, Reservation $reservation)
    {

        $table = Table::findOrFail($request->table_id);

        if ($request->guest_number > $table->guest_number) {
            return back()->with('warning', 'Please choose table based on guest number');
        }

        $res_date = Carbon::parse($request->res_date);
        $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();

        foreach ($reservations as $res) {
            $q_date = Carbon::parse($res->res_date);

            if ($q_date->format('Y-m-d') == $res_date->format('Y-m-d')) {
                return back()->with('warning', 'This table is taken for this date');
            }
        }

        $reservation = $this->ReservationService->updateReservation($reservation, $request->validated());

        return to_route('admin.reservations.index')->with('success', 'reservation Updated Successfully');
    }

    public function trach()
    {
        $reservations = $this->ReservationService->trashReservation();
        return view('admin.reservations.trash',compact('reservations'));
    }

    public function restore($id)
    {
        $menu = $this->ReservationService->restore($id);

        return to_route('admin.reservations.index')->with('success', 'Reservation Restored Successfully');
    }

    public function forceDelete($id)
    {
        $this->ReservationService->forceDelete($id);

        return to_route('admin.reservations.trash')->with('danger', 'Reservation Deleted Successfully Forever');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $this->ReservationService->destroy($reservation);
        return to_route('admin.reservations.index')->with('danger', 'Reservation Deleted Successfully');
    }
}
