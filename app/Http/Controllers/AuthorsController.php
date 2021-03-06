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
     * The default form rules
     *
     * @var array
     */
    protected $rules = [
        "name"      => ['required', 'string', 'max:255'],
        "country"   => ['required', 'string', 'max:255'],
        "gender"    => ['required', 'string', 'max:255', 'in:m,f'],
    ];

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
        $data = $this->validate($request, $this->rules);

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
        $author = Author::findOrFail($author);

        return $this->response($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $author)
    {
        $author = Author::findOrFail($author);

        $data = $this->validate($request, $this->rules);

        $author->fill($data);

        if($author->isClean()) {
            return $this->response(
                [],
                "At least one value must change",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $author->save();

        return $this->response(
            $author,
            "Author {$author->name} updated sucessfully",
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($author)
    {
        $author = Author::findOrFail($author);

        $author->delete();

        return $this->response(
            [],
            "Author {$author->name} deleted sucessfully",
            Response::HTTP_OK
        );
    }
}
