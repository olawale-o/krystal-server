<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GigFormRequest;
use App\Models\Gig;
use App\Models\User;
use App\Http\Resources\GigResource;
use App\Http\Resources\GigCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GigController extends Controller
{
    
    /**
     * create new gig
     * 
     * @param \Illuminate\Http\Request|request
     * @return JsonResponse
     */

    public function create(GigFormRequest $request) {

        $validated =  $request->validated();
        $gig =  Gig::create([
            'user_id' => $validated["user"],
            'company' => $validated["company"],
            'role' => $validated["role"],
            'address' => $validated["address"],
            'region_id' => $validated["region"],
            'tags' => $validated["tags"],
            'min_salary' => $validated["min_salary"],
            'max_salary' => $validated["max_salary"],
        ]);
        if($gig) {
            
            $response = [
                'success' => true,
                'message' => 'gig created',
                'response' => new GigResource($gig),
            ];
            return response($response, 200);
        }
        $response = [
            'sucess' => false,
            'message' => "Failed to save gig",
        ];
        
        return response($response,500);
    }

    public function allGigs()
    {

        $gigs =  Gig::with("user")->get();
        
        if(!$gigs) {
            $response = [
                'success' => false,
                'message' => "Failed to fetch gigs at the moment",
            ];
            return response($response, 500);
        }

        $response = [
            'success' => true,
            'message' => "All gigs successfully retrieved",
            'response' => new GigCollection($gigs),
        ];

        return response($response, 200);

    }

    public function gigs($id , Request $request)
    {
        try {
            
            $user =  User::findOrFail($id);
            $gigs = $user->gigs;

            if(!$gigs) {

                $response = [
                    'success' => false,
                    'message' => 'Failed to fetch your gigs'
                ];
                
                return response($response, 500);
            }

            $response = [
                'success' => true,
                'message' => "My gigs successfully retrieved",
                'response' => new GigCollection($gigs),
            ];

            return response($response, 200);
        } catch (\Throwable $th) {

           if($th instanceof ModelNotFoundException) {
               $response = [
                   'success' => false,
                   'message' => $th->getMessage()
               ];
   
               return response($response, 404);
           }
        }
        

    }

    public function rejectedGigs()
    {
        $gigs =  Gig::where('is_rejected', true)->get();
        
        if($gigs)
        {

            $response = [
                'success' => true,
                'message' => "Rejected gigs successfully retrieved",
                'response' => new GigCollection($gigs),
            ];
    
            return response($response, 200);
        }

        $response = [
            'success' => false,
            'message' => "Failed to fetch rejected gigs",
        ];

        return response($response, 500);



    }

    public function delete($id)
    {
        
        $gig =  Gig::destroy($id);

        if($gig) {

            $response = [
                'response' => $gig,
                'message' => "Gigs successfully deleted"
            ];
    
            return response($response, 200);
        }

        $response = [
            'response' => $gig,
            'message' => "Gig does not exist"
        ];
        return response($response, 500);
        
    }

    public function update($id,GigFormRequest $request)
    {
       try {
           
            $validated  = $request->validated();
            $gig = Gig::findorFail($id);
            
            $gig->company = $validated["company"];
            $gig->role = $validated["role"];
            $gig->address = $validated["address"];
            $gig->region_id = $validated["region"];
            $gig->tags = $validated["tags"];
            $gig->min_salary = $validated["min_salary"];
            $gig->max_salary = $validated["max_salary"];
            $gig->save();

            if($gig) {

                $response = [
                    'response' => new GigResource($gig),
                    'message' => 'Gig updated sucessfully'
                ];
                
                return response($response, 200);
            }

            $response = [
                'success' => false,
                'message' => 'Gig cannot be updated'
            ];


            return response($response, 500);
            
        } catch (\Throwable $th) {
            
            if($th instanceof ModelNotFoundException) {
                
                $response = [
                    'success' => false,
                    'message' => $th->getMessage()
                ];
                return response($response, 404);

            }

       }
    }
}
