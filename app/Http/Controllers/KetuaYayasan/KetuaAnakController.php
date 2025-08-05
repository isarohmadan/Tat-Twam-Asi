<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biodata;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KetuaAnakController extends Controller
{
    public function index(Request $request)
    {

        $katakunci = $request->get('katakunci');

        $data = Biodata::when($katakunci, function ($query) use ($katakunci) {
            return $query->where('nama', 'like', '%' . $katakunci . '%')
                ->orWhere('nama_orangtua', 'like', '%' . $katakunci . '%')
                ->orWhere('asal', 'like', '%' . $katakunci . '%')
                ->orWhere('sekolah', 'like', '%' . $katakunci . '%');
        })->paginate(25);


        foreach ($data as $anak) {
            $anak->tanggal_lahir = \Carbon\Carbon::parse($anak->tanggal_lahir);
        }


        return view('ketua_yayasan.anak.dataanak', compact('data'));
    }

    public function export()
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator("Your App Name")
            ->setLastModifiedBy("Your App Name")
            ->setTitle("Data Anak Export")
            ->setSubject("Data Anak")
            ->setDescription("Export data anak ke Excel");

        // Set headers
        $headers = [
            'A1' => 'No',
            'B1' => 'NIK',
            'C1' => 'Nama',
            'D1' => 'Nama Orang Tua',
            'E1' => 'Tanggal Lahir',
            'F1' => 'Asal',
            'G1' => 'Sekolah'
        ];

        // Apply headers
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style the headers
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5);   // No
        $sheet->getColumnDimension('B')->setWidth(20);  // NIK
        $sheet->getColumnDimension('C')->setWidth(25);  // Nama
        $sheet->getColumnDimension('D')->setWidth(25);  // Nama Orang Tua
        $sheet->getColumnDimension('E')->setWidth(15);  // Tanggal Lahir
        $sheet->getColumnDimension('F')->setWidth(20);  // Asal
        $sheet->getColumnDimension('G')->setWidth(30);  // Sekolah

        // Format NIK column as text BEFORE adding data
        $sheet->getStyle('B:B')->getNumberFormat()->setFormatCode('@');

        // Get data from database
        $data = Biodata::all();
        $row = 2; // Start from row 2 (after headers)
        $no = 1;

        foreach ($data as $item) {
            // Set cell values
            $sheet->setCellValue('A' . $row, $no);
            
            // For NIK, explicitly set as string to prevent scientific notation
            $sheet->setCellValueExplicit('B' . $row, $item->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            
            $sheet->setCellValue('C' . $row, $item->nama);
            $sheet->setCellValue('D' . $row, $item->nama_orangtua);
            $sheet->setCellValue('E' . $row, \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y'));
            $sheet->setCellValue('F' . $row, $item->asal);
            $sheet->setCellValue('G' . $row, $item->sekolah);

            // Apply borders to data rows
            $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN
                    ]
                ]
            ]);

            $row++;
            $no++;
        }

        // Center align the No column
        $sheet->getStyle('A2:A' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Center align the Tanggal Lahir column
        $sheet->getStyle('E2:E' . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set row height for headers
        $sheet->getRowDimension('1')->setRowHeight(25);

        // Auto-filter
        $sheet->setAutoFilter('A1:G' . ($row - 1));

        // Freeze the header row
        $sheet->freezePane('A2');

        // Create writer and save
        $writer = new Xlsx($spreadsheet);
        
        // Set filename with current date
        $filename = 'data-anak-' . date('Y-m-d-H-i-s') . '.xlsx';
        
        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        // Save to output
        $writer->save('php://output');
        exit;
    }

    public function exportPdf($id)
    {
        $anak = Biodata::findOrFail($id);
        $pdf = Pdf::loadView('ketua_yayasan.anak.pdf', compact('anak'));

        return $pdf->download('data-anak.pdf');
    }
}
