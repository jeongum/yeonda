<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoorlockController extends Controller
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
        
        $doorlocks_info = $db->getReference('doorlocks')->getSnapshot()->getValue();
        $spaces = $db->getReference('spaces')->getValue();
        $j =0 ;
        for($i =1 ; $i< count($doorlocks_info); $i++){
            if($doorlocks_info[$i]['host'] == $uid){
                $doorlocks[$j] = $doorlocks_info[$i];
                $j ++;
            }
        }
        return view('doorlocks.index',compact('doorlocks','user','spaces','uid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        
        $id = $db->getReference('doorlocks')->getSnapshot()->numChildren('doorlocks_id');
        $db -> getReference('doorlocks/'.$id)
            ->set([
                'info' => [
                    'des' => $request->info_des,
                    'manufacturing_date' => $request->manufacturing_date,
                    'serial_num' => $request->serial_num,
                ],
                'host' => $uid,
                'space_id' => $request->space,
                'doorlock_id' => $id,
                'current_key_holder' => null,
                'opening' => false,
                'records' => null,
            ]);
        $space_doorlock_id = $db->getReference('spaces/'.$request->space.'/doorlock')->getSnapshot()->numChildren('doorlock_id');
        $db -> getReference('spaces/'.$request->space.'/doorlock/'.$space_doorlock_id)
        ->set([
            'doorlock_id' => $id
        ]);
        return redirect()->route('doorlocks.index');
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
        
        $doorlock = $db->getReference('doorlocks/'.$id)->getValue();
        
        $spaces = $db->getReference('spaces/'.$doorlock['space_id'])->getValue();
        
        $reservations = $db->getReference('reservations')->getValue();
        
        $users = $db->getReference('users')->getValue();
        return view('doorlocks.detail',compact('user','doorlock','spaces','reservations','users'));
    }

    /**
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
        $db = app('firebase.database');
        if($request->opening == 0){
            $updates = [
                'opening' => true,
            ];
        }
       else{
            $updates = [
                'opening' => false,
            ];
        }
        $db->getReference('doorlocks/'.$id)->update($updates);
        
        return redirect()->route('doorlocks.index');
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
