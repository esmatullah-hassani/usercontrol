<?php

namespace App\Http\Controllers\Administrator;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('administrator.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.categories.create', ['grades' => getGrades()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:categories',
            'title' => ['required',
                        Rule::unique('categories')
                            ->where('team_id', currentTeamId())->whereNull('deleted_at'),  
                        ],
        ]);

        $category = DB::transaction(function () use ($request) {
            $category = Category::create(
                array_merge(
                    $request->only([
                        'code', 'title', 'description', 
                    ]), [
                        'team_id' => currentTeamId()
                    ]
                )
            );

            if (!auth()->user()->isDeveloper()) {
                auth()->user()->departments()->attach([$department->id => ['team_id' => currentTeamId()]]);
            }

            return $category;
        });
        $route = $request->has('new') ? route('categories.create') : route("categories.index"); 

        
        return redirect($route)->with('success', trans('general.x_has_been_created', ['x' => $category->title]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('administrator.categories.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'code' => [
                'required',
                Rule::unique('categories')->where('team_id', currentTeamId())->ignore($category->id),
            ],

            'title' => [
                'required',
                Rule::unique("categories")->where("team_id",currentTeamId())->ignore($category->id),
            ],
        ]);
        //dd($request->all());
        $category->update(
            array_merge(
                $request->only([
                    'code', 'title',  'description'
                ]),
            )
        );

        return redirect(route('categories.index'))->with('success', trans('general.x_has_been_updated', ['x' => $category->title]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('categories.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.category')]));
    }
}
