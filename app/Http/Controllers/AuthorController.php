<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Author\AuthorInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * @var AuthorInterface
     */
    protected $author;

    /**
     * AuthorController constructor.
     *
     * @param AuthorInterface $author
     */
    public function __construct(AuthorInterface $author)
    {
        $this->middleware('auth')->except('show');
        $this->author = $author;
    }

    /**
     * Show all books contained in tag.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        $author = $this->author->findSlug($slug);
        $books = $author->books()->paginate($this->limit);

        return view('author.list', compact('author', 'books'));
    }

    /**
     * Show author creation page.
     *
     * @method GET
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            return view('author.partials.create');
        }

        return view('author.create');
    }

    /**
     * Handle application store request.
     *
     * @method POST
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $author = $this->author->store($request->all());

            if ($request->ajax()) {
                $author->name = $author->name .' '. $author->surname;

                return response()->json($author);
            }

            return redirect('/');
        }
    }

    /**
     * Show author edit page.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $author = $this->author->find($id);

        return view('author.edit', compact('author'));
    }

    /**
     * Handle application update request.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $author = $this->author->update($request->all(), $id);

            return redirect()->route('author.show', ['slug' => $author->slug]);
        }
    }

    /**
     * Handle Select2 request on application.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function select(Request $request)
    {
        $results = [];
        $authors = $this->author->getByName($request->author);

        foreach ($authors as $author) {
            $results['authors'][] = [
                'id' => $author->id,
                'text' => $author->name . ' ' . $author->surname
            ];
        }

        return response()->json($results);
    }

    /**
     * Validate received data.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'surname' => 'required'
        ]);
    }
}
