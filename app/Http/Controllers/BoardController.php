<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Resources\BoardResource;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
        //$this->middleware('JWT', ['except' => ['']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return auth()->user()->id;
        //where id int seka ieskosime lentu pagal to user id
        //return BoardResource::collection(Board::latest()->where('user_id', auth()->user()->id))->get();
        return BoardResource::collection(Board::latest()->where('user_id', auth()->user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ;

        //auth()->user()->board()->create($request->all());
        //Board::create($request->all());
        //return response('Created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show($boardId)
    {
        //rodome vis1 info is db pagal id
//        $board = Board::find($board);
//        return $board;
        //kiekvienos atskirai lentos gi nerodysiu
        //return new BoardResource($board);

        //tikriname ar autorizuotas parsymas
        //if(Board::where('id', $boardId)->where('bellongsToBoard', 3))
        //return Task::where('id', $boardId)->orderBy('updated_at','desc')->get();
        //if(Board::where('id', $boardId)->get('user_id'))
        //return Task::where('bellongsToBoard', $boardId)->where('bellongsToBoard', auth()->user()->id)->get;
        //echo "$boardId";
        //echo Board::where('id', $boardId)->pluck('user_id');
        //echo auth()->user()->id;

        //gauname info kokiam user_id priklauso ta lenta
        $boardUserId = Board::where('id', $boardId)->value('user_id');
        //echo $boardUserId;
        //tikriname ar prisijunges vartotojas turi leidima perziureti sia lenta
        if( $boardUserId === auth()->user()->id){
            //returninam pagal BOARD ID
            return Task::where('bellongsToBoard', $boardId)->get();
        }else{
            //return header("HTTP/1.1 401 Unauthorized");
            return response(['error' => 'HTTP/1.1 401 Unauthorized'], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        return new BoardResource($board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        $board->update($request->all());
        return response('Updated', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $board->delete();
//        return response('Deleted', Response::HTTP_NO_CONTENT);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
