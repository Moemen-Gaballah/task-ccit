<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.pages.users.index');
    }

    /**
     * DataTable To show users - AJAX
     * @return mixed
     */

    public function dataTables()
    {
        $halls = User::where('type', 'customer')->select('*');

        return DataTables::of($halls)->addIndexColumn()

            ->addColumn('status', function ($row) {
                $active = ($row->status == "active") ? 'selected' : "";
                $inactive = ($row->status == "inactive") ? 'selected' : "";

                $status = '<select name="status" onchange="toggleStatus('. $row->id . ')">
                                <option value="active" '.  $active  . ' >Active</option>
                                <option value="inactive" '.  $inactive . ' >InActive</option>
                </select>';
                return $status;
            })
            ->addColumn('operation', function ($row) {

                $edit_tag = '<a href="' . url("admin/users/" . $row->id . "/edit") . '" > <i class="fa fa-edit"></i>  </a>';

                $delete_tag = '<a onclick="deleteUser(\'' . $row->id . '\')" style="cursor: pointer"> <i class="fas fa-trash-alt"></i> </a>';

                return $edit_tag . ' ' . $delete_tag;

            })
            ->rawColumns(['status' => 'status', 'operation' => 'operation'])
            ->make(true);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Coming soon <a href='/home'>Home</a>";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // TODO - notes better choose (DTO OR send status value)
        $user->status = ($user->status  == 'active') ? 'inactive' : 'active';
        $user->save();

        return response()->json(['message' => 'done update successfully', 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'Done deleted successfully', 'status' => 'success']);
    }
}
