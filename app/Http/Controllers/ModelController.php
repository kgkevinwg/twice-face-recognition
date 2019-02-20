<?php

namespace App\Http\Controllers;


use JsonCollectionParser\Parser;
use App\Descriptor;
use App\Models;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Nexmo\Response;

class ModelController extends Controller
{

    protected $parser;
    protected $itesm = [];
    protected $jsonFilePath;

    public function setUpParser()
    {

        $this->jsonFilePath = $_SERVER['DOCUMENT_ROOT']."\\json\\descriptor.json" ;
        $this->parser = new Parser();
        $this->parser->setOption('emit_whitespace',true);
    }

    public function uploadModel(Request $r)
    {



        $validator = Validator::make($r->all(),[
            'name'=>'required',
            'image'=>'required|mimes:jpeg,bmp,png',
            'key'=>'required|in:letmein',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->messages(),200);
        }
        else
        {
            $file = $r->file('image');
            $name = $r->name.rand(11111,99999);
            $mdl= new Descriptor();
            $mdl->name = $r->name;
            $mdl->path = $name;
            $mdl->save();
            $r->file('image')->move("images",$name.'.'.$file->getClientOriginalExtension());
            return response()->json(["success"=>"success","path"=>$name,"name"=>$r->name,"format"=>$file->getClientOriginalExtension()],200);
        }

    }

    public function processArrayItem($item)
    {
        $this->items[] = $item;
    }

    public function saveDescriptor(Request $r)
    {

        $this->setUpParser();
        $this->items  = [];
        $this->parser->parse($this->jsonFilePath, [$this,'processArrayItem']);
        $data = Input::all();
        array_push($this->items, $data);
        $jsonData = json_encode($this->items, JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT);
        file_put_contents($_SERVER['DOCUMENT_ROOT']."\\json\\descriptor.json",stripslashes($jsonData));
        return response()->json(["success"=>"Face Descriptor Saved"]);

    }

    public function recognizeSingle()
    {

    }

    public function getDescriptor()
    {
        $this->setUpParser();
        $this->items = [];
        $this->parser->parse($this->jsonFilePath, [$this,'processArrayItem']);
        return response()->json($this->items);
    }
}
