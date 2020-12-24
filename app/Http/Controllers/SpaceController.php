<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $db = app('firebase.database');
        
        $uid = session()->get('current_user_id');
        $user = $db->getReference('users/'.$uid )->getValue();
        
        $spaces_info = $db->getReference('spaces')->getSnapshot()->getValue();
        $spaces =[];
        $j =0 ;
        for($i =1 ; $i< count($spaces_info); $i++){
            if($spaces_info[$i]['host'] == $uid){
                $spaces[$j] = $spaces_info[$i];
                $j ++;
            }
        }
        return view('spaces.index',compact('spaces','user','uid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $db = app('firebase.database');
        
        $uid = session()->get('current_user_id');
        $user = $db->getReference('users/'.$uid )->getValue();
        
        return view('spaces.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $db = app('firebase.database');
        
        $uid = session()->get('current_user_id');
        $user = $db->getReference('users/'.$uid )->getValue();
        
        $id = $db->getReference('spaces')->getSnapshot()->numChildren('space_id');
        $db -> getReference('spaces/'.$id)
        ->set([
            'basic_info' => [
                'address' => [
                    'add1' => $request->address,
                    'add2' => $request->detailAddress,
                    'zipcode' => $request->postcode,
                ],
                'title' => $request->title,
                'type' => $request->type,
            ],
            'host' => $uid,
            'space_id' => $id,
            'intro' => [
                'description' => $request->des,
            ],
            'price'=>[
                1 => [
                    'des'=>'기본가격',
                    'price'=>$request->price,
                ]
            ]
        ]);
        
        return redirect()->route('spaces.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $db = app('firebase.database');
        $uid = session()->get('current_user_id');
        $user = $db->getReference('users/'.$uid )->getValue();
        
        $space = $db->getReference('spaces/'.$id)->getValue();
        $doorlocks = [];
       
        if(isset($space['doorlock']))
        for($i =0 ;$i<count($space['doorlock']); $i++){
            if(isset($space['doorlock'][$i]['doorlock_id']) ){
                $doorlocks[$i] = $db->getReference('doorlocks/'.$space['doorlock'][$i]['doorlock_id'])->getValue();
            }
        }
        else
            $doorlocks = null;
        
        $users = $db->getReference('users')->getValue();
        return view('spaces.detail',compact('user','doorlocks','space','users'));
    }

    /**dddd
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
