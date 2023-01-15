<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\DB;

class TeachExport implements FromCollection,ShouldAutoSize, WithHeadings,  WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('teach')
            ->select(
                'username',
                'nama_lengkap',
                'divisi',
                'email',
                'no_tlp',
                'id_tele')
            ->join('divisi','divisi.id','teach.id_divisi')
            ->get();
        
    }

    public function headings(): array
    {
        return [
            ['Daftar Pembimbing'],
            ['Username', 'Nama Lengkap','Divisi', 'Email', 'No Telepon', 'ID Telegram'],
         ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F2'; // All headers
                $event->sheet->getDelegate()->mergeCells('A1:F1');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:F2')
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:F2')
                ->getFill()
                ->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'],]);
                $to = $event->sheet->getDelegate()->getHighestColumn();
                $a = $event->sheet->getDelegate()->getHighestRow();
                $event->sheet->getStyle('A2:'.$to.$a)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ])->getAlignment()->setWrapText(true);
            },
        ];
    }
}
