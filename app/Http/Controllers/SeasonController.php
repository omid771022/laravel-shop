<?php

namespace App\Http\Controllers;

use App\Http\Requests\seasonRequest;
use App\Repositories\SeasonRepoInterface;
use App\Repositories\CouresRepoInterface;

class SeasonController extends Controller
{

    public $sasonrepo;
    public $courseRepo;
    public function __construct(CouresRepoInterface $courseRepo, SeasonRepoInterface $sasonrepo)
    {
        $this->courseRepo = $courseRepo;
        $this->sasonrepo = $sasonrepo;
    }
    public function  store(seasonRequest $request, $id)
    {
        $this->sasonrepo->store($request, $id);
        newFeedback("جلسه با موفقیت ثبت گردید", "feedbacks");
        return back();
    }
    public function accept($id)
    {
        $this->sasonrepo->updateStatus($id);
        newFeedback("جلسه با موفقیت تایید شد ", "feedbacks");
        return back();
    }
    public function pending($id)
    {
        $this->sasonrepo->updateStatusPending($id);
        return back();
    }
    public function reject($id)
    {
        $this->sasonrepo->updateStatusRejected($id);
        newFeedback("جلسه با موفقیت رد شد", "feedbacks");
        return back();
    }
    public function edit($id)
    {
        $season = $this->sasonrepo->findByIdSeasons($id);
        return view('Dashboard.Course.seasons.edit', compact('season'));
    }
    public function  update(seasonRequest $request, $id)
    {
        $this->sasonrepo->update($request, $id);
        newFeedback("جلسه با موفقیت اپدیت  گردید", "feedbacks");
        return back();
    }

    public function delete($id)
    {
        $this->sasonrepo->delete($id);
        newFeedback("جلسه با موفقیت حذف  گردید", "feedbacks");
        return back();
    }

    public function lock($id)
    {
        $this->sasonrepo->lock($id);
        newFeedback("جلسه با موفقیت قفل  گردید", "feedbacks");
        return back();
    }

    public function open($id)
    {
        $this->sasonrepo->open($id);
        newFeedback("جلسه با موفقیت باز  گردید", "feedbacks");
        return back();
    }


    public function upload($id)
    {
     
        $seasons=$this->sasonrepo->allseason($id);
        return view("Dashboard.Course.lessons.create",compact(["seasons", 'id']));
    }
  
}
