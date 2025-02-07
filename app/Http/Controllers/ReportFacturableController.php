<?php

namespace App\Http\Controllers;

use App\Models\BoardItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportFacturableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BoardItem::join('boards', 'board_items.board_id', '=', 'boards.id')
            ->join('work_spaces', 'boards.work_space_id', '=', 'work_spaces.id')
            ->join('clients', 'work_spaces.client_id', '=', 'clients.id');
            return DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !is_null($request->search['value'])) {
                        $query->where('clients.firstname', 'like', '%' . $request->search['value'] . '%')
                            ->orWhere('clients.second_name', 'like', '%' . $request->search['value'] . '%')
                            ->orWhere('clients.lastname', 'like', '%' . $request->search['value'] . '%')
                            ->orWhere('clients.second_surname', 'like', '%' . $request->search['value'] . '%');
                    }
                    if ($request->has('start') && $request->get('start') != '' && $request->has('end') && $request->get('end') != '') {
                        $query->whereBetween('board_items.created_at', [$request->get('start'), $request->get('end')]);
                    }
                    if ($request->has('status') && $request->get('status') != '') {
                        $query->where('board_items.billable_task', $request->get('status'));
                    }
                    if ($request->has('priority') && $request->get('priority') != '') {
                        $query->where('board_items.priority', $request->get('priority'));
                    }
                })
                ->make(true);
        }
        return view('report-task.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
