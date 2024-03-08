<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CrudTrait;
use App\Traits\imagesTrait;
use App\Models\Album;
use App\Models\AlbumImages;
use Validator;
use DB;
class AlbumController extends Controller
{

    use imagesTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $rows = Album::all();
       return view('admin.albums.index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.albums.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            
         ]);
        //  if ($validator->fails()) {
        //       return back()->withErrors($validator)->withInput();
        //  }
         $data= $request->only('title');

         try{
            DB::beginTransaction();

        $row=  Album::create($data);

        if($request->has('image')){
            $file = $request->image;
            $file_data['album_id'] =  $row->id ;
        foreach ($file as $f) {

            $file_data['title'] = $f->getClientOriginalName();
            $file_data['image'] = $this->saveImages($f,'images');
            AlbumImages::create($file_data);
        }
        }

             DB::commit();
            session()->flash('message','Album Created Successfully');
            }catch(Exception $e) {
            DB::rollBack();
            session()->flash('message','Error In Updating The Album Please Try Again Later');
            }
            return redirect()->route('album.index');
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
    public function edit($id)
    {
        $row= Album::findOrFail($id);
        return view('admin.albums.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
          
         ]);
         if ($validator->fails()) {
              return back()->withErrors($validator)->withInput();
         }
         $row= Album::findOrFail($id);
         $data= $request->only('title');
         try{
            DB::beginTransaction();
         $row->update($data);
         if($request->has('image')){
            $file = $request->image;
            $file_data['album_id'] =  $id ;
         foreach ($file as $f) {

            $file_data['title'] = $f->getClientOriginalName();
            $file_data['image'] = $this->saveImages($f,'images');
            AlbumImages::create($file_data);
        }
        }

        DB::commit();
        session()->flash('message','Album Updated Successfully');
        }catch(Exception $e) {
            DB::rollBack();
            session()->flash('message','Error In Updating The Album Please Try Again Later');
        }
        return redirect()->route('album.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function getChangeAlbum($id){
        $row = album::findOrFail($id);
        $albums = Album::all();
        return view('admin.albums.change-album',compact('row','albums'));
     }
    public function destroy($id)
    {
        Album::findorFail( $id)->delete();
        AlbumImages::where('album_id',$id)->delete();
        session()->flash('message','Album Deleted Successfully');
        return redirect()->back();
    }

    public function changeAlbum(Request $request,$id){

        if($request->has('newAlbum_id')){
             AlbumImages::where('album_id',$id)->update(['album_id'=>$request->newAlbum_id]);
            Album::findorFail($id)->delete();
        }else{
            $this->destroy( $id );
        } 
           
            session()->flash('message','Album Deleted Successfully');
        return redirect()->route('album.index');
    }
}
