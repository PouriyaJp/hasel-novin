<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }
    public function index()
    {
        $countries = $this->countryRepository->all();

        return view('index', compact('countries'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $countries = $this->countryRepository->search($query);

        return response()->json($countries);
    }
}
