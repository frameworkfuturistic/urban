<?php

namespace App\Http\Controllers;

use App\Repository\Hostel\EloquentHostelRepository;
use Illuminate\Http\Request;
use App\Models\Hostel;

class HostelController extends Controller
{

    public function __construct(EloquentHostelRepository $eloquentHostel)
    {
        $this->EloquentHostel=$eloquentHostel;
    }

    function userView(){
        return $this->EloquentHostel->view();
    }

    function saveHostel(Request $request){
        // dd($request->all());
        return $this->EloquentHostel->addHostel($request);
     }

     function hostelInbox(){
         return $this->EloquentHostel->hostelInboxView();
     }

     function updateHostelInbox($id){
         return $this->EloquentHostel->updateHostelInboxView($id);
     }

     function updateHostel(Request $request){
         return $this->EloquentHostel->editHostel($request);
     }

     function hostelWorkflow(Request $request){
         return $this->EloquentHostel->hostelWorkflowUpdate($request);
     }

     function addComment(Request $request){
            return $this->EloquentHostel->workflowTrack($request);
        }

     function hostelOutbox(){
         return $this->EloquentHostel->hostelOutboxView();
     }

     function hostelOutboxUpdate($id){
         return $this->EloquentHostel->hostelOutboxUpdateView($id);
     }

     
     function hostelApproved(){
        return $this->EloquentHostel->hostelApprovedView();
    }

    function updateHostelApproved($id){
        return $this->EloquentHostel->updateHostelApprovedView($id);
    }

    function hostelRejected(){
        return $this->EloquentHostel->hostelRejectedView();
    }

    function updateHostelRejected($id){
        return $this->EloquentHostel->updateHostelRejectedView($id);
    }

}
