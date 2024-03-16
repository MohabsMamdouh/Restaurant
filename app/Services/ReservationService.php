<?php

namespace App\Services;

use App\Models\Reservation;

class ReservationService
{
    public function getReservations()
    {
        return Reservation::all();
    }

    public function storeReservation($data)
    {
        return Reservation::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'tel_number' => $data['tel_number'],
            'res_date' => $data['res_date'],
            'table_id' => $data['table_id'],
            'guest_number' => $data['guest_number']
        ]);
    }

    public function updateReservation(Reservation $reservation, $data)
    {
        $reservation->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'tel_number' => $data['tel_number'],
            'res_date' => $data['res_date'],
            'table_id' => $data['table_id'],
            'guest_number' => $data['guest_number']
        ]);

        return $reservation;
    }

    public function trashReservation() {
        return Reservation::onlyTrashed()->get();
    }

    public function restore($id) {
        return Reservation::withTrashed()->find($id)->restore();
    }

    public function forceDelete($id)
    {
        return Reservation::withTrashed()->find($id)->forceDelete();
    }

    public function destroy(Reservation $reservation)
    {
        return $reservation->delete();
    }
}
