<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewGigFormRequest;
use App\Models\Gig;
use App\Models\User;
use App\Http\Resources\GigResource;
use App\Http\Resources\GigCollection;

class GigController extends Controller
{
    
    /**
     * create new gig
     * 
     * @param \Illuminate\Http\Request|request
     * @return JsonResponse
     */

    public function create(NewGigFormRequest $request) {

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
                'gig' => new GigResource($gig),
                'response' => 'gig created'
            ];
            return response($response, 200);
        }
        $response = [
            'message' => "unable to save gig",
        ];
        
        return response($response,500);
    }

    public function allGigs()
    {

        $gigs =  Gig::with("user")->get();

        $response = [
            'response' => new GigCollection($gigs),
            'message' => "All gigs successfully retrieved"
        ];

        return response($response, 200);

    }

    public function gigs($id , Request $request)
    {
        $user =  User::findOrFail($id);
        $gigs = $user->gigs;

        $response = [
            'response' => new GigCollection($gigs),
            'message' => "My gigs successfully retrieved"
        ];

        return response($response, 200);

    }

    public function rejectedGigs()
    {
        $gigs =  Gig::where('is_rejected', true)->get();
        

        $response = [
            'response' => new GigCollection($gigs),
            'message' => "Rejected gigs successfully retrieved"
        ];

        return response($response, 200);

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

    public function update($id,NewGigFormRequest $request)
    {
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
            'message' => 'Gig cannot be updated'
        ];


        return response($response, 500);
    }
}
