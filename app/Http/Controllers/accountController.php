<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Role;

use DB;

use Mail;

use Hash;

use DataTables;

use Illuminate\Support\Facades\Validator;

use App\Mail\activatedAccount;

class accountController extends Controller
{
    public function account()
    {
        $role = Role::where('id', '!=' , '4')->get();
        return view('/account/account', ['role' => $role]);
    }

    public function accountGet()
    {
        $user = User::where('level','!=','4')->get();
        return Datatables::of(User::where('level','!=','4'))
        ->addColumn('action', function ($user)
        {
             return '<a href="#" id="edit_user" onclick=edit_user("'.$user->id.'") class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="#" id="hapus_user" onclick=hapus_user("'.$user->id.'") class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
        })
        ->editColumn('active', function ($user){
            if ($user->status != 'active') return '<a href="#" onclick=active_user("'.$user->id.'") class="btn btn-info btn-sm">Active</a>';
            if ($user->status == 'active') return '<span class="badge badge-info">Activated</span>';
        })
        ->rawColumns(['action','active'])
        ->make(true);
    }

    public function accountTambah(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'level' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }        

        DB::table('users')->insert(['name'=> $request->name ,'email'=>$request->email ,'password'=>Hash::make($request->password), 'level' => $request->level]);

        return response()->json(array('res' => 'berhasil'));
    }

    public function accountEditGet(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        return response()->json(array('res' => 'berhasil', 'data' => $user));
    }

    public function accountEditStore(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);

        if ($validasi->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        }   

        $id = $request->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = $request->level;
        $user->save();

        return response()->json(array('res' => 'berhasil'));
    }

    public function accountHapus(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->delete();

        return response()->json(array('res' => 'berhasil'));
    }

    public function accountActivated(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        //$user->status = 'active';
        //$user->save();
        $role = Role::find($user->level);

        Mail::to('fikri@gosyen.co.id')->send(new activatedAccount($id));

        //Mail::send('/account/mail/activate', $user, function($message) {
        //    $message->to($user->email, $user->name)->subject
        //       ('Activated Account');
        //    $message->from('Lord Warehouse','Fikri Darmawan');
        // });
 
		return response()->json(array('res' => 'berhasil'));
    }
}
