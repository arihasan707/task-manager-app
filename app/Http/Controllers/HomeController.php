<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userLogin = Auth::user()->id;
        $tasks = Task::where('user_id', $userLogin)->get();

        return view('home', compact('tasks'));
    }

    public function simpanTask(Request $request)
    {
        $userLogin = Auth::user()->id;
        $nama_task = $request->task;
        $deskripsi = $request->deskripsi;

        Task::create([
            'nama' => $nama_task,
            'deskripsi' => $deskripsi,
            'user_id' => $userLogin
        ]);

        return redirect('home')->with('sukses', 'data telah ditambahkan');
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
        Task::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
