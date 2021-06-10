<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use App\Models\User;
    use App\Traits\ApiResponser;
    use DB;

    Class UserController extends Controller {
        use ApiResponser;

        private $request;

        public function __construct(Request $request){
            $this->request = $request;
        }


        public function getUsers(){
            $users = DB::connection('mysql')
            ->select("SELECT * FROM tbluser");

            return $this->successResponse($users);
        }


        public function index(){
            $users = User::all();

            return $this->successResponse($users);
        }


        public function add(Request $request){
            $rules = [
                'username' => 'required|max:25',
                'password' => 'required|max:25'
            ];
            
            $this->validate($request, $rules);
            $user = User::create($request->all());
            return $this->successResponse($user, Response::HTTP_CREATED);

        }


        public function show($id){

            $user = User::findOrFail($id);
            return $this->successResponse($user);
            /*
                $user = User::where('id', $id)->first();
                if($user){
                    return $this->successResponse($user);
                }{
                    return $this->errorResponse('User ID does not exist', Response::HTTP_NOT_FOUND);
                }
            */
        }


        public function update(Request $request, $id){
            $rules = [
                'username' => 'required|max:25',
                'password' => 'required|max:25'
            ];
            
            $this->validate($request, $rules);
            $user = User::findOrFail($id);

            $user->fill($request->all());

            if($user->isClean()){
                return $this->errorResponse('At least a value must be change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $user->save();
            return $this->successResponse($user);

            /*
                if($user){
                    $user->fill($request->all());

                    //if no changes were made
                    if($user->isClean()){
                        return $this->errorResponse('At least a value must be change',
                        Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                    $user->save();
                    return $this->successResponse($user);
                }{
                    return $this->errorResponse('User ID does not exist', Response::HTTP_NOT_FOUND);
                }
            */
        }


        public function delete($id){
            $user = User::findOrFail($id);
            $user->delete();
            return $this->errorResponse('User ID does not exist', Response::HTTP_NOT_FOUND);

            /*
                $user = User::where('id', $id)->first();
                if($user){
                    $user->delete();
                    return $this->successResponse($user);
                }{
                    return $this->errorResponse('User ID does not exist', Response::HTTP_NOT_FOUND);
                }
            */
        }
    }

 