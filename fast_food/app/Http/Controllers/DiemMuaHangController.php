<?php

namespace App\Http\Controllers;

use App\Models\DiemMuaHang;
use App\Models\User;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use App\Http\Requests\StoreDiemMuaHangRequest;
use App\Http\Requests\UpdateDiemMuaHangRequest;

class DiemMuaHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lstTaiKhoan = User::all()->where('trang_thai', 1);
        $lstDonHang = DonHang::all()->where('trang_thai', 1);
        // $lstDiemMuaHang = DiemMuaHang::where('trang_thai', 1)->unique('user_id');
        $lstDiemMuaHang = DiemMuaHang::where('trang_thai', 1)->paginate(5);
        // $lstDiemMuaHang = DiemMuaHang::all()->where('trang_thai', 1);
        // $diemMuaHang = DiemMuaHang::where('trang_thai', 1)->unique('user_id');
        // $results = DiemMuaHang::whereIn('so_diem', function ($query) {
        //     $query->select('so_diem')
        //         ->from('diem_mua_hangs')
        //         ->groupBy(['user_id'])
        //         ->havingRaw('count(*) > 1');
        // })->get();
        // $testArray = [];
        // foreach ($lstDonHang as $item) {
        //     $sum = DiemMuaHang::where('user_id', $item->user_id)->get();
        //     $tong = $sum->sum('so_diem');
        //     // $a = $tong;


        //     Arr::set($testArray, 'user_id', $tong);
        // $testArray;

        // }
        // dd($testArray);
        // dd($a);

        return view('component/diem-mua-hang/diemmuahang-show', compact('lstDiemMuaHang', 'lstDonHang', 'lstTaiKhoan', 'request'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $lstTaiKhoan = User::all()->where('trang_thai', 1);
        $lstDonHang = DonHang::all()->where('trang_thai', 1);
        $lstDiemMuaHang = DiemMuaHang::where('trang_thai', 1)->where(function ($query) use ($search) {
            $query->where('so_diem', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        return view('component/diem-mua-hang/diemmuahang-show', compact('lstDiemMuaHang', 'lstDonHang', 'lstTaiKhoan', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiemMuaHangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiemMuaHangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiemMuaHang  $diemMuaHang
     * @return \Illuminate\Http\Response
     */
    public function show(DiemMuaHang $diemMuaHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiemMuaHang  $diemMuaHang
     * @return \Illuminate\Http\Response
     */
    public function edit(DiemMuaHang $diemMuaHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiemMuaHangRequest  $request
     * @param  \App\Models\DiemMuaHang  $diemMuaHang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiemMuaHangRequest $request, DiemMuaHang $diemMuaHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiemMuaHang  $diemMuaHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiemMuaHang $diemMuaHang)
    {
        //
    }

    public function xoa($id)
    {
        $diemMuaHang = DiemMuaHang::find($id);
        $diemMuaHang->trang_thai = 0;
        $diemMuaHang->save();
        return Redirect::route('diemMuaHang.index');
    }
}
