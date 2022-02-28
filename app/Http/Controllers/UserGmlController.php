<?php

namespace App\Http\Controllers;

use App\Events\AdminUsersRegisters;
use App\Events\UserRegister;
use App\Models\userGml;
use App\Models\CategoryGml;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use UsersGml;

class UserGmlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->all());
        $queries = ['search'];

        $countries = Http::get("https://api.first.org/data/v1/countries?region=South America&pretty=true");
        $countries_array = $countries->json();
        $categories = CategoryGml::get()->toArray();
        $emails = userGml::select('email_user')->get()->toArray();
        $identifications = userGml::select('identification_user')->get()->toArray();

        //dd(!isset($request->type_filter) && !isset($request->filter));
        if (strlen($request->type_filter) === 0 && strlen($request->filter) > 0) {
            $userAll = userGml::join('categories_gml', 'categories_gml.id_category', '=', 'users_gml.id_category')
                ->where('name_user', 'ilike', '%' . $request->filter . '%')
                ->orWhere('surname_user', 'ilike', '%' . $request->filter . '%')
                ->orWhere('identification_user', 'ilike', '%' . $request->filter . '%')
                ->orWhere('email_user', 'ilike', '%' . $request->filter . '%')
                ->orWhere('country_user', 'ilike', '%' . $request->filter . '%')
                ->orWhere('address_user', 'ilike', '%' . $request->filter . '%')
                ->orWhere('movil_user', 'ilike', '%' . $request->filter . '%')
                ->orWhere('name_category', 'ilike', '%' . $request->filter . '%')
                ->get();
        } else if (strlen($request->type_filter) > 0 && strlen($request->filter) > 0) {
            $userAll = userGml::join('categories_gml', 'categories_gml.id_category', '=', 'users_gml.id_category')
                ->orWhere($request->type_filter, 'ilike', '%' . $request->filter . '%')
                ->get();
        } else {
            $userAll = userGml::join('categories_gml', 'categories_gml.id_category', '=', 'users_gml.id_category')->get();
        }

        return Inertia::render('User/Index', [
            'users' => $userAll,
            'filters' => $request->all($queries),
            'countries' => $this->orderArrayCountries($countries_array['data']),
            'categories' => $categories,
            'emails' => $emails,
            'identifications' => $identifications,
        ]);
    }

    /**
     * Order Array of Countries.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderArrayCountries($countries)
    {
        $s = 0;
        $countries_new = array();
        foreach ($countries as $key => $value) {
            $countries_new[$s] = ["value" => $key, "text" => $value['country']];
            $s++;
        }
        return $countries_new;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userGml = userGml::create($request->all());

        $userAll = userGml::join('categories_gml', 'categories_gml.id_category', '=', 'users_gml.id_category')
            ->where('id_user', '=', $userGml->id_user)->first();
        event(new UserRegister($userAll->toArray()));
        $this->eventMailAdmi();
        return Redirect::route('usersgml.index');
    }

    public function eventMailAdmi()
    {
        $usersAdmin = User::get()->toArray();
        $usersAll = userGml::selectRaw('count(*) as quantity_users,country_user')
                            ->groupBy('country_user')
                            ->get()
                            ->toArray();

        $userCountries['users_admin'] = $usersAdmin;
        $userCountries['users_system'] = $usersAll;

        event(new AdminUsersRegisters($userCountries));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userGml  $userGml
     * @return \Illuminate\Http\Response
     */
    public function show(userGml $userGml)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userGml  $userGml
     * @return \Illuminate\Http\Response
     */
    public function edit(userGml $id_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userGml  $userGml
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userGml)
    {
        $updUser = userGml::first()->where("id_user", "=", $userGml);
        $updUser->update($request->all());

        return Redirect::route('usersgml.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userGml  $userGml
     * @return \Illuminate\Http\Response
     */
    public function destroy($userGml)
    {
        $deleteUser = userGml::first()->where("id_user", "=", $userGml);
        $deleteUser->delete();
        return Redirect::route('usersgml.index');
    }
}
