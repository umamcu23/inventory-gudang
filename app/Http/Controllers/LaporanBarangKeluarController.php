<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Customer;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanBarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('laporan-barang-keluar.index');
    }

    /**
     * Get Data 
     */
    public function getData(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
    
        $barangKeluar = BarangKeluar::query();
    
        if ($tanggalMulai && $tanggalSelesai) {
            $barangKeluar->whereBetween('tanggal_keluar', [$tanggalMulai, $tanggalSelesai]);
        }
    
        $data = $barangKeluar->get();

        if (empty($tanggalMulai) && empty($tanggalSelesai)) {
            $data = BarangKeluar::all();
        }
    
        return response()->json($data);
    }

    /**
     * Print DomPDF
     */
    public function printBarangKeluar(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $barangKeluar = BarangKeluar::query();

        if ($tanggalMulai && $tanggalSelesai) {
            $barangKeluar->whereBetween('tanggal_keluar', [$tanggalMulai, $tanggalSelesai]);
        }

        $data = ($tanggalMulai && $tanggalSelesai)
            ? $barangKeluar->get()
            : BarangKeluar::all();

        $dompdf = new Dompdf();

        $html = view(
            'laporan-barang-keluar.print-barang-keluar',
            compact('data', 'tanggalMulai', 'tanggalSelesai')
        )->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $canvas = $dompdf->getCanvas();
        $fontMetrics = $dompdf->getFontMetrics();

        $font = $fontMetrics->getFont('Helvetica', 'normal');
        $fontBold = $fontMetrics->getFont('Helvetica', 'bold');

        $canvas->page_text(
            30,
            580,
            'Dicetak oleh : ' . auth()->user()->name,
            $font,
            8
        );

        $canvas->page_text(
            650,
            580,
            'Tanggal Cetak : ' . date('d-m-Y H:i'),
            $font,
            8
        );

        $canvas->page_text(
            370,
            580,
            'Halaman {PAGE_NUM} / {PAGE_COUNT}',
            $fontBold,
            8
        );

        // Bersihkan output buffer
        while (ob_get_level()) {
            ob_end_clean();
        }

        return response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="print-barang-keluar.pdf"',
                'Cache-Control' => 'private, max-age=0, must-revalidate',
                'Pragma' => 'public',
            ]
        );
    }

    /**
     * Get Customer
     */
    public function getcustomer()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
