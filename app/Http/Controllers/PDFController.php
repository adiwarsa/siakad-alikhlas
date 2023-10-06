<?php

namespace App\Http\Controllers;

use App\Models\AbsensiSantri;
use App\Models\Rapot;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF($santriId, $semester)
    {
        $rapot = Rapot::where('santri_id', $santriId)
        ->where('semester', $semester)
        ->first(); // Assuming you only want one record; use get() if you expect multiple records

        // Count 'Sakit' records for the specific Santri and semester
        $sakitCount = AbsensiSantri::where('santri_id', $santriId)
        ->where('keterangan', 'Sakit')
        ->where('semester', $semester)
        ->count();

        // Count 'Alpha' records for the specific Santri and semester
        $alphaCount = AbsensiSantri::where('santri_id', $santriId)
        ->where('keterangan', 'Alpha')
        ->where('semester', $semester)
        ->count();

        // Count 'Izin' records for the specific Santri and semester
        $izinCount = AbsensiSantri::where('santri_id', $santriId)
        ->where('keterangan', 'Izin')
        ->where('semester', $semester)
        ->count();

        if (!$rapot) {
            // Handle the case where no rapot is found
            abort(404); // You can return a 404 error or handle it differently as needed
        }

        $data['pageTitle'] = "Rapot Santri";
        $data['rapot'] = $rapot; // Pass the rapot data to the view
        $data['sakit'] = $sakitCount;
        $data['alpha'] = $alphaCount;
        $data['izin'] = $izinCount;

        // $pdf = PDF::loadView('rapot.exportraport', $data)->setOptions(['defaultFont' => 'sans-serif']);

        // // You can customize the PDF options as needed
        // PDF::setOptions(['dpi' => 150, 'isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif']); 

        // // Download the PDF
        return view('rapot.exportraport', $data);
    }

}
