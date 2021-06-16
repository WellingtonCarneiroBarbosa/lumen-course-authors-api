<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->response(
            Author::paginate(15),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name"      => ['required', 'string', 'max:255'],
            "country"   => ['required', 'string', 'max:255'],
            "gender"    => ['required', 'string', 'max:255', 'in:m,f'],
        ]);

        $author = Author::create($data);

        return $this->response(
            $author,
            "Author created sucessfully",
            Response::HTTP_CREATED,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $author
     * @return \Illuminate\Http\Response
     */
    public function show($author)
    {
        if(! $author = Author::where("id", $author)->first()) {
            return $this->response(
                [],
                "Author not found",
                404,
            );
        }

        return $this->response($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        return $this->response([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        return $this->response([]);
    }
}
