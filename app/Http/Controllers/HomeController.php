<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        return view('home', compact('tasks'));
    }

    public function simpanTask(Request $request)
    {
        $userLogin = Auth::user()->id;
        $nama_task = $request->task;
        $deskripsi = $request->deskripsi;

        $validator = Validator::make($request->all(), [
            'task' => 'required',
            'foto' => 'mimes:png,jpg|max:2048',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $filePath = public_path('upload');
        $insert = new Task();
        $insert->nama = $nama_task;
        $insert->deskripsi = $deskripsi;
        $insert->user_id = $userLogin;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $file_name = time() . $file->getClientOriginalName();

            $file->move($filePath, $file_name);
            $insert->foto = $file_name;
        }

        $result = $insert->save();
        return redirect('home')->with('sukses', 'Berhasil Menyimpan! Data telah ditambahkan');
    }

    public function update(Request $request, string $id)
    {

        $task = Task::find($id);
        $task->status = $request->status;
        $task->save();

        return response()->json([
            'success' => true,
            'message' => "Data telah di update."
        ]);
    }

    public function destroy(string $id)
    {
        $data = Task::find($id);

        $image_path = public_path('upload/' . $data->foto);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        Task::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
