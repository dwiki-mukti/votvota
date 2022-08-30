<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VoteTokenExport implements WithEvents, ShouldAutoSize
{
    use Exportable;
    
    protected $tokens;

    public function __construct($tokens = [])
    {
        $this->tokens = $tokens;
    }

    public function registerEvents(): array
    {
        $styleHeader = [
            'font' => [
                'bold' => true,
                'italic' => true,
                'size' => 12,
            ],
        ];
        $styleDefault = [
            'font' => [
                'size' => 12,
            ],
            'alignment' => [
                'vertical' => 'center',
            ],
        ];
        
        return[
            AfterSheet::class => function (AfterSheet $event) use ($styleHeader, $styleDefault) {
                $event->sheet->setCellValue("A1", "no");
                $event->sheet->getColumnDimension("A")->setWidth(10);
                $event->sheet->setCellValue("B1", "token");
                $event->sheet->getColumnDimension("B")->setWidth(20);
                $event->sheet->getStyle('A1:B1')->applyFromArray($styleHeader);
                $event->sheet->getStyle("A1:B1")->getBorders()->getAllBorders()->setBorderStyle('thin');

                $row = 1;
                foreach ($this->tokens as $token) {
                    $event->sheet->setCellValue("A".strval($row+1), $row);
                    $event->sheet->setCellValue("B".strval($row+1), $token);
                    $row++;
                }

                $event->sheet->getStyle("A2:B" . strval($row+1))->applyFromArray($styleDefault);
                $event->sheet->getStyle("A2:B" . strval($row+1))->getBorders()->getAllBorders()->setBorderStyle('thin');
            }
        ];
    }
}
