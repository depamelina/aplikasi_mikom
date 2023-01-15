<?php

namespace App\Exports;


use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class PresensiExport implements FromCollection,ShouldAutoSize, WithHeadings,  WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;
    protected $sampai;

    public function __construct($dari,$sampai)
    {
       $this->dari = $dari;
       $this->sampai = $sampai;
    }
    
    public function collection()
    {

        return DB::table('presensi')
        ->select(
            DB::raw('DATE_FORMAT(tanggal,"%d/%m/%Y") as tanggal'),
            'nama_lengkap',
            'divisi',
            'jam_in',
            'jam_out',
            DB::raw('DATE_FORMAT(time_in,"%H:%i") as time_in'),
            DB::raw('DATE_FORMAT(time_out,"%H:%i") as time_out')
            )
        ->join('users','users.username','presensi.username')
        ->join('divisi','divisi.id','users.id_divisi')
        ->join('users_detail','users_detail.username','presensi.username')
        ->join('jamkerja','jamkerja.id','users_detail.id_jamker')
        ->whereBetween('tanggal',[$this->dari,$this->sampai])
        ->orderBy('nama_lengkap','ASC')
        ->get();
    }

    public function headings(): array
    {
        return [
            ['Laporan Kehadiran'],
            ['Tanggal', 'Nama Lengkap','Divisi', 'Jadwal'],
            ['v']
         ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:G2'; // All headers
                $event->sheet->getDelegate()->mergeCells('A1:G1');
                $event->sheet->getDelegate()->mergeCells('A2:A3');
                $event->sheet->getDelegate()->mergeCells('B2:B3');
                $event->sheet->getDelegate()->mergeCells('C2:C3');
                $event->sheet->getDelegate()->mergeCells('D2:E2');
                $event->sheet->getDelegate()->mergeCells('F2:G2');
                $event->sheet->getDelegate()->setCellValue('D3',"Masuk");
                $event->sheet->getDelegate()->setCellValue('E3',"Pulang");
                $event->sheet->getDelegate()->setCellValue('F3',"Masuk");
                $event->sheet->getDelegate()->setCellValue('G3',"Pulang");
                $event->sheet->getDelegate()->setCellValue('F2',"Presensi");
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:G3')
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:G3')
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
                ])->getAlignment()->setWrapText(false);
            },
        ];
    }
}
