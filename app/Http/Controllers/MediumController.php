<?php

namespace App\Http\Controllers;

use App\Repositories\Medium\MediumInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediumController extends Controller
{
    /**
     * @var MediumInterface
     */
    protected $medium;

    /**
     * MediumController constructor.
     *
     * @param MediumInterface $medium
     */
    public function __construct(MediumInterface $medium)
    {
        $this->middleware(['auth', 'verified']);
        $this->medium = $medium;
    }

    /**
     * Show medium create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('medium.create');
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

        $medium = $this->medium->findSlug($slug);

        $books = $medium->books()
            ->sortBy($sortParameters['property'], $sortParameters['direction'])
            ->paginate($this->limit)
            ->appends($sortParameters['appends']);

        return view('medium.list', compact('medium', 'books'));
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
            $medium = $this->medium->store($request->all());

            return redirect()->route('medium.edit', ['id' => $medium->id]);
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
        $medium = $this->medium->find($id);

        return view('medium.edit', compact('medium'));
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
            $this->medium->update($request->all(), $id);

            return redirect()->route('medium.edit', ['id' => $id]);
        }
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
            'name' => 'required|unique:mediums,name,'.$id
        ]);
    }

}
