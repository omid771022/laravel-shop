<?php

namespace App\Http\Controllers;

use App\Http\Requests\seasonRequest;
use App\Repositories\SeasonRepoInterface;
use App\Repositories\CouresRepoInterface;

class SeasonController extends Controller
{

    public $sasonrepo;
    public $courseRepo;
    public function __construct(CouresRepoInterface $courseRepo , SeasonRepoInterface $sasonrepo)
    {
        $this->courseRepo = $courseRepo;
        $this->sasonrepo = $sasonrepo;
    }

    public function  store(seasonRequest $request, $id)
    {
        $this->sasonrepo->store($request, $id);
        newFeedback("جلسه با موفقیت ثبت گردید","feedbacks");
        return back();
        
    }



    public function accept($id)
    {
        $this->courseRepo->updateStatus($id);
        return back();
    }
    public function pending($id)
    {
        $this->courseRepo->updateStatusPending($id);
        return back();
    }
    public function reject($id)
    {
        $this->courseRepo->updateStatusRejected($id);
        return back();
    }
}
