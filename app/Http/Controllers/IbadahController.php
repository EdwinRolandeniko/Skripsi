<?php

namespace App\Http\Controllers;

use App\DataTables\IbadahDataTable;
use App\Models\IbadahSyukur;
use App\Models\JadwalHalangan;
use App\Models\Lingkungan;
use App\Models\BaptisAnak;
use App\Models\Pernikahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IbadahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // validasi pada admin
    public function index(IbadahDataTable $dataTable)
    {
        $id = Auth::user()->id;
        $data = IbadahSyukur::with(['user.lingkungan', 'pendeta'])->get();
        return $dataTable->render('admin.ibadah', compact('data'));
    

    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lingkungan = Lingkungan::all();
       
        return view('admin.ibadahCreate', compact('lingkungan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // input pendaftaran ibadah syukur
    public function store(Request $request)
    {
        
        $idLingkungan = User::with('lingkungan')->where('id', Auth::user()->id)->first();
        $query = IbadahSyukur::with('pendeta')->where('tanggal', $request->tanggal)->where('id_pendeta', $request->id_pendeta)->get();

        if ($query->count() == 0) {
            $data = IbadahSyukur::create($request->all());
            return redirect()->route('Ibadah.umat')->with('success', 'Acara Ibadah berhasil dibuat, tunggu persetujuan dari pihak gereja');
        } else {
            return redirect()->route('Ibadah.umat')->with('error', 'Acara Ibadah gagal dibuat, tanggal dan pendeta tidak tersedia');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function showByUmat()
    {
        $dataIbadah = IbadahSyukur::with(['user.lingkungan', 'pendeta'])->where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $listPendeta = User::where('role', 'PENDETA')->get();

        $jadwalHalangan = JadwalHalangan::with(['pendeta'])->where('status', 'ACTIVE')->get();
        $jadwalHalangan = $jadwalHalangan->groupBy('pendeta.nama')->toArray();
        
        // data jadwal yang akan ditampilkan
        $baptis = BaptisAnak::with(['user.lingkungan', 'pendeta.lingkungan'])
            ->leftJoin('users', 'baptis_anak.id_user', '=', 'users.id')
            ->addSelect('*', 'tgl_pelaksanaan as tanggal', 'waktu_pelaksanaan as waktu', DB::raw('"Baptis Anak" as acara'))
            ->where('status', 'DITERIMA')
            ->get();
        // dd($baptis);

        $ibadah = IbadahSyukur::with(['user.lingkungan', 'pendeta.lingkungan'])
            ->addSelect('*',  DB::raw('"Ibadah Syukur" as acara'))
            ->whereNotNull('id_pendeta')
            ->where('status', 'DITERIMA')
            ->get();

        $pernikahan = Pernikahan::with(['userLaki', 'userPerempuan', 'pendeta.lingkungan'])
            ->leftJoin('users as userLaki', 'pernikahan.id_user_laki', '=', 'userLaki.id')
            ->leftJoin('users as userPerempuan', 'pernikahan.id_user_perempuan', '=', 'userPerempuan.id')
            ->addSelect('pernikahan.*', DB::raw('concat(userLaki.nama, " & ", userPerempuan.nama) as user_nama'), DB::raw('"Pernikahan" as acara'))
            ->whereNotNull('id_pendeta')
            ->where('status', 'DITERIMA')
            ->get();

        // Gabungkan semua data dalam satu koleksi
        $data = new Collection();
        $data = $data->merge($ibadah);
        $data = $data->merge($pernikahan);
        $data = $data->merge($baptis);

        return view('umat.ibadahCreate', compact('listPendeta',  'dataIbadah', 'data', 'jadwalHalangan'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    // validasi pada admin
    public function edit(string $id)
    {
        $data = IbadahSyukur::with(['user.lingkungan', 'pendeta'])->find($id);
        return view('admin.ibadahEdit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = IbadahSyukur::find($id);
        $data->update(['status' => 'DITERIMA']);
        return redirect()->route('ibadah-syukur.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = IbadahSyukur::find($id);
        $data->delete();
        return redirect()->route('ibadah-syukur.index');
    }

    public function storePenolakan($id, Request $request)
    {
        $data = IbadahSyukur::with('user.lingkungan')->where('id', $id)->first();
        $data->update([
            'keterangan' => $request->keterangan,
            'status' => 'DITOLAK',
        ]);
        return redirect()->route('ibadah-syukur.index');
    }

    public function print($ibadah_id)
    {
        $date = now();
        $id = auth()->user()->id;
        $data = IbadahSyukur::with(['user' => fn ($q) => $q->with('lingkungan')])
            ->join('users', 'ibadah_syukur.id_user', '=', 'users.id')
            ->join('lingkungan', 'users.id_lingkungan', '=', 'lingkungan.id')
            ->select('users.*', 'ibadah_syukur.*', 'lingkungan.nama as lingkungan')
            ->where('ibadah_syukur.id', $ibadah_id)
            ->first();
        return view('umat.ibadahPrint', compact('data','date'));
    }

    // memanggil data jadwal
    public function getJadwal()
    {
        $data = IbadahSyukur::with(['user.lingkungan', 'pendeta.lingkungan',])->get();
        return response()->json($data);
    }
}
