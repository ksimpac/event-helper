<?php

namespace App\Exports;

use App\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantExport implements FromCollection, WithHeadings
{

    public function __construct(int $event_id)
    {
        $this->event_id = $event_id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Participant::where('event_id', $this->event_id)
            ->get(['STU_ID', 'identify', 'NAME']);
    }

    public function headings(): array
    {
        return [
            '學號', '班級', '姓名',
        ];
    }
}
