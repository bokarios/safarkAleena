<?php
  
namespace App\Exports;
  
use App\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class ReservationsExport implements FromCollection
{
  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection()
  {
      return Reservation::all();
  }
}