<?php

namespace App\Exports;

use App\Models\ProposalTA;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProposalTAExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles, WithEvents
{

    public function registerEvents(): array
    {
        return [
            // AfterSheet::class => function (AfterSheet $event) {
            //     $event->sheet->getStyle('A:E')->applyFromArray([
            //         'borders' => [
            //             'allBorders' => [
            //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            //                 'color' => ['argb' => '000000'],
            //             ],
            //         ],
            //     ]);
            // },
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A2:A200')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->getDelegate()->getStyle('A1:E1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:E200')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);
            },
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // 1    => ['font' => ['bold' => true]],
            1  => ['font' => ['size' => 12, 'bold' => true]],
            'B' => ['alignment' => ['wrapText' => true]],
            'C' => ['alignment' => ['wrapText' => true]],
            'D' => ['alignment' => ['wrapText' => true]],
            'E' => ['alignment' => ['wrapText' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 16,
            'C' => 16,
            'D' => 16,
            'E' => 16,
        ];
    }

    public function headings(): array
    {
        return [
            'NIM', 'Nama', 'Judul Satu', 'Judul Dua', 'Judul Tiga'
        ];
    }

    public function map($row): array
    {
        return [
            $row->mahasiswa_nim,
            ucwords($row->mahasiswa->nama),
            ucwords($row->judul_satu),
            ucwords($row->judul_dua),
            ucwords($row->judul_tiga),
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProposalTA::where('status', 'dikirim')->with('mahasiswa')->get();
    }
}
