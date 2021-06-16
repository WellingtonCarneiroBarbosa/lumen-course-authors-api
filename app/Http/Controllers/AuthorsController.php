<?php

namespace App\Http\Controllers;

use App\Author;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->sucess_response([]);
        } catch(\Exception $e) {
            return $this->error_response($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->sucess_response([]);
        } catch(\Exception $e) {
            return $this->error_response($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        try {
            return $this->sucess_response([]);
        } catch(\Exception $e) {
            return $this->error_response($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        try {
            return $this->sucess_response([]);
        } catch(\Exception $e) {
            return $this->error_response($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        try {
            return $this->sucess_response([]);
        } catch(\Exception $e) {
            return $this->error_response($e->getMessage());
        }
    }
}
