<?php

namespace App\Http\Controllers;

use App\models\LoaiGiamGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoaiGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lstLoaiGiamGia = LoaiGiamGia::all()->where('trang_thai', 1);
        return view('component/loai-ma-giam-gia/loaimagiamgia-show', compact('lstLoaiGiamGia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('component/loai-ma-giam-gia/loaimagiamgia-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'TenLoaiMaGiamGia' => 'required',
            ],
            [
                'TenLoaiMaGiamGia.required' => 'Bạn chưa nhập tên loại mã giảm giá',
            ]
        );
        $loaiGiamGia = new LoaiGiamGia();
        $loaiGiamGia->fill([
            'ten_loai_giam_gia' => $request->input('TenLoaiMaGiamGia'),
        ]);
        // dd($request->input('TenLoaiMaGiamGia'));
        $ktLoaiMaGiamGia = LoaiGiamGia::all()->where('ten_loai_giam_gia', $request->input('TenLoaiMaGiamGia'))->where('trang_thai', 1)->first();
        // dd($ktMonAn);
        if ($ktLoaiMaGiamGia) {
            return Redirect::back()->with('error', 'Tên loại giảm giá đã tồn tại');
        } else {
            $loaiGiamGia->save();
            return Redirect::route('loaiGiamGia.index')->with('success', 'Thêm loại mã giảm giá thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LoaiGiamGia $loaiGiamGium)
    {
        //
        return view('component/loai-ma-giam-gia/loaimagiamgia-edit', compact('loaiGiamGium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoaiGiamGia $loaiGiamGium)
    {
        //
        $this->validate(
            $request,
            [
                'TenLoaiMaGiamGia' => 'required|unique:loai_giam_gias,ten_loai_giam_gia',
            ],
            [
                'TenLoaiMaGiamGia.required' => 'Bạn chưa nhập tên loại mã giảm giá',
                'TenLoaiMaGiamGia.unique' => 'Tên mã giảm giá đã tồn tại',
            ]
        );
        $loaiGiamGium->fill([
            'ten_loai_giam_gia' => $request->input('TenLoaiMaGiamGia'),
        ]);
        $loaiGiamGium->save();
        return Redirect::route('loaiGiamGia.index')->with('success', 'Chỉnh sửa loại giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function xoa($id)
    {
        $loaiGiamGia = loaiGiamGia::find($id);
        $loaiGiamGia->trang_thai = 0;
        $loaiGiamGia->save();
        $loaiGiamGia->maGiamGias()->update(['ma_giam_gias.trang_thai' => 0]);
        return Redirect::route('loaiGiamGia.index');
    }
}
