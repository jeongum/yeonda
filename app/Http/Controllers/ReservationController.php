<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
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
        $reservations_info = $db->getReference('resevations')->getSnapshot()->getValue();
        $doorlocks = $db->getReference('doorlocks')->getSnapshot()->getValue();
        $spaces = $db->getReference('spaces')->getSnapshot()->getValue();
        $reservations =[];
        $j =0 ;
        for($i =1 ; $i< count($reservations_info); $i++){
            $space = $db->getReference('spaces/'.$reservations_info[$i]['space_id'])->getValue();
            if( $space['host']== $uid){
                $reservations[$j] = $reservations_info[$i];

                $oldDate = strtotime($reservations_info[$i]['date']);
                $newDate = date('Y-m-d',$oldDate);
                
                $reservations[$j]['date'] = $newDate;
                
                $j ++;
            }
        }
        $users = $db->getReference('users')->getSnapshot()->getValue();
        return view('reservations.index',compact('user','reservations','users','spaces','doorlocks','uid'));
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
        
        $id = $db->getReference('resevations')->getSnapshot()->numChildren('reservation_id');
        $db -> getReference('resevations/'.$id)
        ->set([
            'user' => $request->create_reservation_user,
            'status' => 1,
            'start_time' => $request->create_reservation_start_time,
            'end_time' => $request->create_reservation_end_time,
            'date' => $request->create_reservation_date,
            'price_option_id' => $request->create_reservation_price,
            'doorlock_id' => $request->create_reservation_doorlock,
            'capacity' => $request->create_reservation_capacity,
            'space_id' => $request->create_reservation_space,
            'reservation_id' => $id,
        ]);
        
        return redirect()->route('reservations.index');
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
        $updates = [
            'request_change' => [
                'status'=> $request->request_status,
                'content' => $request->request_des,
            ],
            'doorlock_id' => $request->select_doorlock,
        ];
        $db->getReference('resevations/'.$id)->update($updates);
        
        return redirect()->route('reservations.index');
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
