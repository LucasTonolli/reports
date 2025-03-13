<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


/**
 * Class ReportExport depende da interface que vai ser usado
 * FromColletion
 */
class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMapping, WithColumnFormatting
{
    public function __construct(public string $startDate, public string $endDate) {}

    public function headings(): array
    {
        return [
            '#',
            'Nome',
            'Email',
            'Data de verificação do Email',
            'Data de cadastro',
            'Data de atualização'
        ];
    }



    public function styles(Worksheet $sheet)
    {
        return [
            1 => ["font" => ["bold" => true]]
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
            'F' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->email_verified_at),
            Date::dateTimeToExcel($user->created_at),
            Date::dateTimeToExcel($user->updated_at),
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::where('created_at', '>=', $this->startDate)->where('created_at', '<=', $this->endDate)->get();
    }

    public function query()
    {
        return User::where('created_at', '>=', $this->startDate)->where('created_at', '<=', $this->endDate);
    }
}
