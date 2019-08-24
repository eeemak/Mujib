<?php

namespace App\Http\Controllers;

use App\Model\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCategoryResource;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PostCategoryResource::collection(PostCategory::orderBy('id', 'desc')->paginate($request->take ?? 10));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new PostCategoryResource(PostCategory::create($request->input()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $postCategory)
    {
        return new PostCategoryResource($postCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $postCategory)
    {
        return new PostCategoryResource($postCategory->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        if($postCategory->delete())
        return new PostCategoryResource($postCategory);
    }
}
