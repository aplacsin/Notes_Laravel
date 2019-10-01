<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Note;
use App\Image;
use App\Http\Requests\createNoteRequest;
use App\Http\Requests\importNoteRequest;



class NotesController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        $notes = Note::all();

        return view('notes.index', ['notes'=>$notes]);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(createNoteRequest $request)
    {
        
       $notes = new Note;

       $notes->title=$request->title;
       $notes->content=$request->content;
       $notes->save();
       
       
       $noteId =$notes->id; 
       $data = [];       
    
       $imagename =[];
       $i = 0;
              

       if($request->hasFile('image')){
            foreach($request->file('image') as $image)
            {
                if(!isset($image)){
                    break;
                }

                $name=$image->getClientOriginalName();
                $imagename[$i] = 'image-'.Str::random(10).'.jpg';                
                $image->move(public_path().'/images/', $imagename[$i]);                
                
                
                $data[] = [
                    'note_id' => $noteId,
                    'image' => $imagename[$i]
                ];  
            }
        }         

        $images = new Image();
        $images->insert($data);
         
        
        $images->save();


       // Redirect to index
       return redirect()->route('notes.index')
                        ->with('success','• Заметка успешно создана.');
    }    

    public function edit($id)
    {
        $notes = Note::findorfail($id);

        return view('notes.edit', ['note' => $notes]);
    }

    public function update(createNoteRequest $request, $id)
    {        

        $notes = Note::findorfail($id);

        $notes->fill($request->all());
        $notes->save();

        $noteId =$notes->id; 
        $data = [];

        $imagename =[];
        $i = 0;

        if($request->hasFile('image')){
            foreach($request->file('image') as $image)
            {
                if(!isset($image)){
                    continue;
                }

                $name=$image->getClientOriginalName();
                $imagename[$i] = 'image-'.Str::random(10).'.jpg';                
                $image->move(public_path().'/images/', $imagename[$i]);                 
                
                $data[] = [
                    'note_id' => $noteId,
                    'image' => $imagename[$i]
                ];  
            }
        }
         
        $images = new Image();
        $images->insert($data);


        // Redirect to index
        return redirect()->route('notes.index')
                         ->with('success','• Заметка успешно изменена.');
    }

    public function destroy($id)
    {
        Note::findorfail($id)->delete();

        // Redirect to index
        return redirect()->route('notes.index')
                         ->with('success','• Заметка успешно удалена.');
    }

    public function destroyImage($id)
    {        
        $imageId = Image::findorfail($id)->image; //search image from database
        Image::where('id', $id)->delete(); //delete image from database 

        $path = public_path().'/images/'.$imageId; //replace with folder path
        unlink($path); //delete image from path               
               
    }

    public function export()
    {
        return view('notes.export');
    }

    public function getexport()
    {        
        $table = Note::all();
        if ($table->count() > 0) {
        $output='';
        foreach ($table as $row) {
            $rows = Arr::except($row, ['id', 'created_at', 'updated_at']);
            $output.=  implode(";",$row->toArray());
            $output = strip_tags($output);
            $output.="\n";
        }
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ExportTable.csv"',
        );
      
        $response = response(rtrim($output, "\n"), 200, $headers);        
        
        return $response;  
    } else 
    {
        // Redirect to index
        return redirect()->route('notes.index')
                         ->with('errors','• Нет заметок для экспортирования.');
    }  
        
    }    

    public function import()
    {
        return view('notes.import');
    }    

    public function get_import(importNoteRequest $request)
    {
        
        $file = $request->file('import_file');
        $csvData = file_get_contents($file);
        $lines = explode("\n", $csvData);
        $array = array();
        foreach ($lines as $line) {            
            $array[] = str_getcsv($line, ";");
        }

        $rowCount = 0;

        foreach ($array as $row) {
            
            if ((empty($row[0])) && (empty($row[1]))) {
                $row[0] = 0;
                $row[1] = 0;
            }            

            $array[$rowCount] = [
                'title' => $row[0],
                'content' => $row[1],
            ];
            $rowCount++;
        }


        $notes = new Note;
        $notes->insert($array);
        

        // Redirect to index
        return redirect()->route('notes.index')
                         ->with('success','• Заметки успешно импортированы.');        
    }
}    
    
