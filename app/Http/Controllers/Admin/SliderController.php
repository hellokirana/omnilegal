<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'queue' => 'required|integer',
            'title_id' => 'nullable|string',
            'title_en' => 'nullable|string',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($validated->fails()) {
            Session::flash('warning', 'Data gagal disimpan');
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        $data = new Slider($request->only([
            'queue',
            'title_id',
            'title_en',
            'description_id',
            'description_en',
            'link',
            'link_caption_id',
            'link_caption_en',
            'status',
        ]));

        if ($request->hasFile('image')) {
            $fileimage = $request->file('image');
            $fileimageName = date('YmdHis') . '.' . $fileimage->getClientOriginalExtension();
            Storage::putFileAs('public/slider', $fileimage, $fileimageName);
            $data->image = $fileimageName;
        }

        $data->save();

        Session::flash('success', 'Data berhasil disimpan');
        return redirect()->route('admin.slider.index');
    }

    public function edit($id)
    {
        $data = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'queue' => 'required|integer',
            'title_id' => 'nullable|string',
            'title_en' => 'nullable|string',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = Slider::findOrFail($id);

        $data->fill($request->only([
            'queue',
            'title_id',
            'title_en',
            'description_id',
            'description_en',
            'link',
            'link_caption_id',
            'link_caption_en',
            'status',
        ]));

        if ($request->hasFile('image')) {
            // hapus image lama kalau ada
            if ($data->image && Storage::exists('public/slider/' . $data->image)) {
                Storage::delete('public/slider/' . $data->image);
            }

            $fileimage = $request->file('image');
            $fileimageName = date('YmdHis') . '.' . $fileimage->getClientOriginalExtension();
            Storage::putFileAs('public/slider', $fileimage, $fileimageName);
            $data->image = $fileimageName;
        }

        $data->save();

        Session::flash('success', 'Data berhasil diperbarui');
        return redirect()->route('admin.slider.index');
    }

    public function destroy($id)
    {
        $data = Slider::findOrFail($id);

        if ($data->image && Storage::exists('public/slider/' . $data->image)) {
            Storage::delete('public/slider/' . $data->image);
        }

        $data->delete();

        return response()->json(['success' => 'Hapus data berhasil']);
    }
}
