<?php

namespace App\Exports;

use App\Event;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantExport implements FromQuery, WithHeadings
{
    
    use Exportable;

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    
    public function forEventId(int $event_id)
    {
        $this->event_id = $event_id;
        return $this;
    }
    
    public function query()
    {
        return DB::table('participants')
                ->join('users', 'users.user_id' , '=' ,'participants.user_id')
                ->where('participants.event_id', '=', $this->event_id)
                ->select('users.std_id', 'users.identify','users.realname', 'users.telephone')
                ->orderBy('users.user_id');
    }

    public function headings(): array
    {
        return [
            '學號', '班級', '姓名', '手機號碼'
        ];
    }
}
