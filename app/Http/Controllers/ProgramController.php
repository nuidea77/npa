<?php

namespace App\Http\Controllers;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index() {
        $program = Program::with('translations')->orderBy('order', 'asc')->paginate(12);
        return view('program.index')
        ->with('program', $program);
    }
    public function view($id)
    {
        $data = Program::with('translations')->where('id',  $id)->first();
        return view('program.view')
        ->with('data', $data);
    }
}
