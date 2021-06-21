<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FilesRequest;
use Illuminate\Support\Facades\File as FileFacade; 

use App\Models\File;
use Session;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); 
        $files = $user->files()->orderby('files.created_at')->get();
        return view('files',compact('files')); 
    } 

    public function store(FilesRequest $request)
    {
        try {
            $new = $request->all();
            $user = $request->user();
           
            if($request->hasFile('file')){
                $file = $request->file('file');
                $file_name = time().'-'.$file->getClientOriginalName();
                $file_path = 'uploads/'; 
                $file->move($file_path, $file_name);  
            }

            $file = $user->files()->create([
                'file' => $file_name
            ]);  

        } catch (\Throwable $th) {
            Session::flash('message', 'Não foi possível salvar o arquivo! Motivo : '.$th->getMessage()); 
            Session::flash('color', 'red');
            return redirect()->route('gallery.index');
        }

        return response()->json($file); 
    } 

    public function update(Request $request)
    {
        try {
            $data = $request->all(); 
            $file = File::findorFail($request->id);
            $file->update([
                'label' => $request->label
            ]);  
        } catch (\Throwable $th) {
            Session::flash('message', 'Não foi possível salvar o arquivo! Motivo : '.$th->getMessage()); 
            Session::flash('color', 'red');
            return redirect()->route('gallery.index');
        }

        return response()->json($file); 
    } 

    public function destroy($id)
    { 
        try {
            $file = File::findorFail($id);  

            //Remove file from folder
            unlink(public_path("/uploads/").$file->file);
            $file->delete();     

        }catch(\Throwable $th){  
            Session::flash('message', 'Não foi possível excluir o arquivo! Motivo : '.$th->getMessage()); 
            Session::flash('color', 'red');
            return redirect()->route('gallery.index');
        }

        Session::flash('message', 'Arquivo excluido com sucesso!'); 
        Session::flash('color', 'red');
        return redirect()->route('gallery.index'); 
    } 
}
