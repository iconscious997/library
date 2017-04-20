<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Tag\TagInterface;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * @var TagInterface
     */
    protected $tag;

    /**
     * ShelfController constructor.
     *
     * @param TagInterface $tag
     */
    public function __construct(TagInterface $tag)
    {
        $this->middleware('auth')->except('show');
        $this->tag = $tag;
    }

    /**
     * Show all books contained in tag.
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, string $slug)
    {
        $sortParameters = buildSortParameters($request->all());

        $tag = $this->tag->findSlug($slug);
        $books = $tag->books()
            ->sortBy($sortParameters['property'], $sortParameters['direction'])
            ->paginate($this->limit)
            ->appends($sortParameters['appends']);

        return view('tag.list', compact('tag', 'books'));
    }

    /**
     * Show medium create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('tag.create');
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
            $tag = $this->tag->store($request->all());

            return redirect()->route('tag.edit', ['id' => $tag->id]);
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
        $tag = $this->tag->find($id);

        return view('tag.edit', compact('tag'));
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
        $validator = $this->validator($request->all(), $id);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $tag = $this->tag->update($request->all(), $id);

            return redirect()->route('tag.show', ['slug' => $tag->slug]);
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
        $tags = $this->tag->getByName($request->tag);

        foreach ($tags as $tag) {
            $results['authors'][] = [
                'id' => $tag->id,
                'text' => $tag->name . ' ' . $tag->surname
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
            'name' => 'required|unique:tags,name,'.$id
        ]);
    }
}
