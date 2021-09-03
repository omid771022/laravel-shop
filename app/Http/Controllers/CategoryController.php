<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;
use App\Repositories\CategoryRepoInterface;

class CategoryController extends Controller
{
    public $repo;
    public function __construct(CategoryRepoInterface $categoryRepo)
    {
        $this->repo = $categoryRepo;
    }
    public function index()
    {
        //todo Category repository
        $categories = $this->repo->all();
        return view('Dashboard.Category.index', compact('categories'));
    }
    public function store(CategoryRequest $request)
    {
        $this->repo->store($request);
        return back();
    }

    public function edit($id)
    {
        $categoryInfo = $this->repo->findById($id);
        $categories = $this->repo->all();

        return view('Dashboard.Category.edit', compact(['categoryInfo', 'categories']));
    }

    public function update(Request $request, $id)
    {
        $this->repo->updateCategory($request, $id);
        return back();
    }
    public function delete($id)
    {
        $this->repo->deleteCategory($id);
        Session::flash('message', "
دسته شماره 
.'$id'.
حذف شد
");
        return back();
    }
}
