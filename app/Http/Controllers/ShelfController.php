<?php

namespace App\Http\Controllers;

use App\Repositories\Shelf\ShelfInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShelfController extends Controller
{
    /**
     * @var ShelfInterface
     */
    protected $shelf;

    /**
     * ShelfController constructor.
     *
     * @param ShelfInterface $shelf
     */
    public function __construct(ShelfInterface $shelf)
    {
        $this->middleware('auth')->except('show');
        $this->shelf = $shelf;
    }

    /**
     * Show all books contained in tag.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        $section = $this->shelf->findSlug($slug);
        $books = $section->books()->paginate($this->limit);

        return view('book.list', compact('section', 'books'));
    }

    /**
     * Show medium create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('shelf.create');
    }

    /**
     * Handle application store request.
     *
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
            $shelf = $this->shelf->store($request->all());

            return redirect()->route('shelf.edit', ['id' => $shelf->id]);
        }
    }

    /**
     * Show medium edit page.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $shelf = $this->shelf->find($id);

        return view('shelf.edit', compact('shelf'));
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
            $this->shelf->update($request->all(), $id);

            return redirect()->route('shelf.edit', ['id' => $id]);
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
        $shelves = $this->shelf->getByName($request->shelf);

        foreach ($shelves as $shelf) {
            $results['shelves'][] = [
                'id' => $shelf->id,
                'text' => $shelf->name
            ];
        }

        return response()->json($results);
    }

    /**
     * Validate input.
     *
     * @param array $data
     * @param int|null $id
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data, int $id = null)
    {
        return Validator::make($data, [
            'name' => 'required|unique:shelves,name,'.$id
        ]);
    }
}
