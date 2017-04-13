<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Publisher\PublisherInterface;

class PublisherController extends Controller
{
    /**
     * @var PublisherInterface
     */
    protected $publisher;

    /**
     * PublisherController constructor.
     *
     * @param PublisherInterface $publisher
     */
    public function __construct(PublisherInterface $publisher)
    {
        $this->middleware('auth');
        $this->publisher = $publisher;
    }

    /**
     * Show application page for creating new publisher.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('publisher.create');
    }

    /**
     * Handle application request to store new publisher.
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
            $this->publisher->store($request->all());

            return redirect()->route('publisher.create');
        }
    }

    /**
     * Show page where user can edit publisher data.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $publisher = $this->publisher->find($id);

        return view('publisher.edit', compact('publisher'));
    }

    /**
     * Handle application publisher update request.
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
            $this->publisher->update($id, $request->all());

            return redirect('/');
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
        $publishers = $this->publisher->getByName($request->publisher);

        foreach ($publishers as $publisher) {
            $results['publishers'][] = [
                'id' => $publisher->id,
                'text' => $publisher->name
            ];
        }

        return response()->json($results);
    }

    /**
     * Validate data which should be stored.
     *
     * @param array $data
     * @param null $id
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data, $id = null)
    {
        return Validator::make($data, [
            'name' => 'required|unique:publishers,name,'.$id,
        ]);
    }
}
