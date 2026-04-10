<?php
require __DIR__ . '/vendor/autoload.php';
include 'db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// ✅ FIX: ilagay sa taas (ONCE ONLY)
function val($d, $key) {
    return isset($d[$key]) ? $d[$key] : '';
}

$template = 'love.xlsx';
$spreadsheet = IOFactory::load($template);
$sheet = $spreadsheet->getActiveSheet();

$row = 14;

// loop 1–23 para walang missing rows
for ($h=1; $h<=23; $h++) {

    $res = $conn->query("SELECT * FROM readings WHERE hour=$h");
    $d = $res->fetch_assoc();

    // TIME COLUMN
    $sheet->setCellValue('A'.$row, $h . ":00");

    if ($d) {

        // 🔴 MAIN FEEDER
        $sheet->setCellValue('B'.$row, val($d,'mf_l1l2'));
        $sheet->setCellValue('C'.$row, val($d,'mf_l2l3'));
        $sheet->setCellValue('D'.$row, val($d,'mf_l3l1'));
        $sheet->setCellValue('E'.$row, val($d,'mf_a'));
        $sheet->setCellValue('F'.$row, val($d,'mf_b'));
        $sheet->setCellValue('G'.$row, val($d,'mf_c'));
        $sheet->setCellValue('H'.$row, val($d,'mf_n'));
        $sheet->setCellValue('I'.$row, val($d,'mf_l1'));
        $sheet->setCellValue('J'.$row, val($d,'mf_l2'));
        $sheet->setCellValue('K'.$row, val($d,'mf_l3'));
        $sheet->setCellValue('L'.$row, val($d,'mf_energy'));
        $sheet->setCellValue('M'.$row, val($d,'mf_gas'));

        // 🟡 FEEDER 7
        $sheet->setCellValue('N'.$row, val($d,'f7_a'));
        $sheet->setCellValue('O'.$row, val($d,'f7_b'));
        $sheet->setCellValue('P'.$row, val($d,'f7_c'));
        $sheet->setCellValue('Q'.$row, val($d,'f7_n'));
        $sheet->setCellValue('R'.$row, val($d,'f7_pf_a'));
        $sheet->setCellValue('S'.$row, val($d,'f7_pf_b'));
        $sheet->setCellValue('T'.$row, val($d,'f7_pf_c'));
        $sheet->setCellValue('U'.$row, val($d,'f7_pf_avg'));
        $sheet->setCellValue('V'.$row, val($d,'f7_l1'));
        $sheet->setCellValue('W'.$row, val($d,'f7_l2'));
        $sheet->setCellValue('X'.$row, val($d,'f7_l3'));
        $sheet->setCellValue('Y'.$row, val($d,'f7_energy'));
        $sheet->setCellValue('Z'.$row, val($d,'f7_batt'));

        // 🟢 FEEDER 8
        $sheet->setCellValue('AA'.$row, val($d,'f8_a'));
        $sheet->setCellValue('AB'.$row, val($d,'f8_b'));
        $sheet->setCellValue('AC'.$row, val($d,'f8_c'));
        $sheet->setCellValue('AD'.$row, val($d,'f8_n'));
        $sheet->setCellValue('AE'.$row, val($d,'f8_pf_a'));
        $sheet->setCellValue('AF'.$row, val($d,'f8_pf_b'));
        $sheet->setCellValue('AG'.$row, val($d,'f8_pf_c'));
        $sheet->setCellValue('AH'.$row, val($d,'f8_pf_avg'));
        $sheet->setCellValue('AI'.$row, val($d,'f8_l1'));
        $sheet->setCellValue('AJ'.$row, val($d,'f8_l2'));
        $sheet->setCellValue('AK'.$row, val($d,'f8_l3'));
        $sheet->setCellValue('AL'.$row, val($d,'f8_energy'));

        // 🔵 FEEDER 9
        $sheet->setCellValue('AN'.$row, val($d,'f9_a'));
        $sheet->setCellValue('AO'.$row, val($d,'f9_b'));
        $sheet->setCellValue('AP'.$row, val($d,'f9_c'));
        $sheet->setCellValue('AQ'.$row, val($d,'f9_n'));

        $sheet->setCellValue('AR'.$row, val($d,'f9_pf_a'));
        $sheet->setCellValue('AS'.$row, val($d,'f9_pf_b'));
        $sheet->setCellValue('AT'.$row, val($d,'f9_pf_c'));
        $sheet->setCellValue('AU'.$row, val($d,'f9_pf_avg'));

        $sheet->setCellValue('AV'.$row, val($d,'f9_l1'));
        $sheet->setCellValue('AW'.$row, val($d,'f9_l2'));
        $sheet->setCellValue('AX'.$row, val($d,'f9_l3'));

        $sheet->setCellValue('AY'.$row, val($d,'f9_energy'));
    }

    $row++;
}

// DOWNLOAD
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Substation_Report.xlsx"');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;