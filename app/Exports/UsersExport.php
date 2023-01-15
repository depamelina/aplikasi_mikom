<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection,ShouldAutoSize, WithHeadings,  WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')
            ->select(
                'users.username', 
                'nama_lengkap',
                'divisi',
                'tgl_lahir',
                'jk',
                'no_tlp',
                'asal_sekolah',
                'email',
                'id_tele',
                'alamat',
                'tgl_mulai',
                'tgl_akhir')
            ->where('id_level','=', 'user')
            ->join('users_detail', 'users_detail.username','=','users.username')
            ->join('divisi','divisi.id','users.id_divisi')
            ->get();
        
    }

    public function headings(): array
    {
        return [
            ['Daftar Peserta Magang'],
            ['Username', 'Nama Lengkap', 'Divisi', 'Tanggal Lahir', 'Jenis Kelamin', 'No Telepon', 'Asal Sekolah', 'Email', 'ID Telegram', 'Alamat','Tanggal Mulai', 'Tanggal Akhir'],
         ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:L2'; // All headers
                $event->sheet->getDelegate()->mergeCells('A1:L1');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('A1:L2')
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:L2')
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
