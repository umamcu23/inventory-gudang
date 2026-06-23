<?php
namespace App\Http\Controllers;
use Dompdf\Dompdf;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('laporan-barang-masuk.index');
    }

    /**
     * Get Data 
     */
    public function getData(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
    
        $barangMasuk = BarangMasuk::query();
    
        if ($tanggalMulai && $tanggalSelesai) {
            $barangMasuk->whereBetween('tanggal_masuk', [$tanggalMulai, $tanggalSelesai]);
        }
    
        $data = $barangMasuk->get();

        if (empty($tanggalMulai) && empty($tanggalSelesai)) {
            $data = BarangMasuk::all();
        }
    
        return response()->json($data);
    }
    
    /**
     * Print DomPDF
     */
    public function printBarangMasuk_old(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
    
        $barangMasuk = BarangMasuk::query();
    
        if ($tanggalMulai && $tanggalSelesai) {
            $barangMasuk->whereBetween('tanggal_masuk', [$tanggalMulai, $tanggalSelesai]);
        }
    
        if ($tanggalMulai !== null && $tanggalSelesai !== null) {
            $data = $barangMasuk->get();
        } else {
            $data = BarangMasuk::all();
        }
        
        //Generate PDF
        $dompdf = new Dompdf();
        $html = view('/laporan-barang-masuk/print-barang-masuk', compact('data', 'tanggalMulai', 'tanggalSelesai'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('print-barang-masuk.pdf', ['Attachment' => false]);
    }

    public function printBarangMasuk(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $barangMasuk = BarangMasuk::query();

        if ($tanggalMulai && $tanggalSelesai) {
            $barangMasuk->whereBetween('tanggal_masuk', [$tanggalMulai, $tanggalSelesai]);
        }

        $data = ($tanggalMulai && $tanggalSelesai)
            ? $barangMasuk->get()
            : BarangMasuk::all();

        $dompdf = new Dompdf();

        $html = view(
            'laporan-barang-masuk.print-barang-masuk',
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
                'Content-Disposition' => 'inline; filename="print-barang-masuk.pdf"',
                'Cache-Control' => 'private, max-age=0, must-revalidate',
                'Pragma' => 'public'
            ]
        );
    }
    
    /**
     * Get Supplier
     */
    public function getSupplier()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
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
