<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VisitorsResource;
use App\Http\Resources\VisitorsCollection;
use App\Visitor;

class VisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VisitorsCollection(Visitor::orderBy('id', 'DESC')->paginate(10));
    }

    public function search($field, $query){
        return new VisitorsCollection(Visitor::where($field, 'LIKE', "%$query%")->latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visitor = Visitor::create($this->validateData());
        return new VisitorsResource($visitor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VisitorsResource(Visitor::findOrFail($id));
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
        $validatedData = $this->validateData($request);

        $visitor = Visitor::findOrFail($id);  

        $visitor->guestName = $request->guestName;
        $visitor->guestDesignation = $request->guestDesignation;
        $visitor->guestOrg = $request->guestOrg;
        $visitor->restroom = $request->restroom;
        $visitor->bodyguardName = $request->bodyguardName;
        $visitor->carNumber = $request->carNumber;
        $visitor->visitingDate = $request->visitingDate;
        $visitor->messengerName = $request->messengerName;
        $visitor->messengerDesignation = $request->messengerDesignation;
        $visitor->authorizerName = $request->authorizerName;
        $visitor->authorizerDesignation = $request->authorizerDesignation;
        
        $visitor->save();
        return new VisitorsResource($visitor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return new VisitorsResource($visitor);
    }

    protected function validateData(){

        return request()->validate([
            'guestName' => 'required',
            'guestDesignation' => 'required',
            'guestOrg' => 'required',
            'restroom' => 'required',
            'bodyguardName' => 'required',
            'carNumber' => 'required',
            'visitingDate' => 'required',
            'messengerName' => 'required',
            'messengerDesignation' => 'required',
            'authorizerName' => 'required',
            'authorizerDesignation' => 'required'
        ]);
    }
}
