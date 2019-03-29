<?php

namespace App\Http\Controllers;
use App\City;
use App\Country;
use App\CityManager;
use App\User;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // $countries= Country::all();
        // //  dd($countries);
        // $cities = City::all();
        // // dd($cities);
        // $countryId=$cities[0]->country_id;
        // $countryInfo=Country::findOrFail($countryId);

        // $cityManagerId=$cities[0]->city_manager_id;
        // $cityManagerInfo=User::findOrFail($cityManagerId);

        // return view('Cities.index',[
         
        //     'cities'=>$cities,
        //     'countries'=>$countries,
        //     'countryInfo'=>$countryInfo,
        //     'cityManagerInfo'=>$cityManagerInfo
        // ]);

        $cities = City::all();
         return view('Cities.index',[
         
            'cities'=>$cities,
         ]);
    }


    public function create()
    {
        $cities = City::all();
        $countries=Country::all();
        return view('Cities.create',[
            'cities'=>$cities,
            'countries'=>$countries
        ]);

    }


    public function store(Request $request)
    {

        City::create($request->all());
        return view('Cities.index');
    }


    public function show($cityId)
    {
        // dd($cityId);
     
        // $city = City::findOrFail($cityId);
     
        // $cityManagerId=$city->city_manager_id;
        // // dd($cityManagerId);
        // $cityManagerInfo=User::findOrFail($cityManagerId);
        
        // $countryId=$city->country_id;
        // $countryInfo=Country::findOrFail($countryId);
        // return view('Cities.show',[
        //     'city'=>$city,
        //     'cityManagerInfo'=>$cityManagerInfo,
        //     'countryInfo'=>$countryInfo
        // ]);
        $city = City::findOrFail($cityId);
        return view('Cities.show',[
                'city'=>$city,
                
            ]);

    }

    public function edit($cityId)
    {
         
     
        //   $city = City::findOrFail($cityId);
        // dd($city);
        //   $cityManagerId=$city->city_manager_id;
        
        //   $cityManagerInfo=User::findOrFail($cityManagerId);
          
        //   $countryId=$city->country_id;
        //   $countryInfo=Country::findOrFail($countryId);
        //   return view('Cities.edit',[
        //       'city'=>$city,
        //       'cityManagerInfo'=>$cityManagerInfo,
        //       'countryInfo'=>$countryInfo
        //   ]);
        $cityManagers=CityManager::all();
        $city = City::findOrFail($cityId);
        return view('Cities.edit', [
            'city' => $city,
            'cityManagers' =>$cityManagers
        ]);
    }

   
        public function update(Request $request,$cityId)
        {
    
            //  $city = City::findOrFail($cityId);
            // //  dd($city);
            // $city->update($request->all());
            
            // // $cityManager->role->update($request->all());
            // return redirect()->route('Cities.index');

            // City::find($cityId->id)->update($request->all());
            // return view('Cities.index');

            // $city = City::findOrFail($cityId);
            // $city->update($request->all());
            // return redirect()->route('Cities.index');

            $city = City::findOrFail($cityId);
            $city->update($request->all());
           
            return redirect()->route('Cities.index');
        }
    


    public function destroy($cityId)
    {
    //     $city=City::findOrFail($cityId);  
    //     $city[0]->delete();

    //     return redirect()->route('Cities.index');
    $city = new City;      
    $city = City::find($cityId);
    $city->delete($cityId);
    return redirect()->route('Cities.index');
    }

    public function getcities()
    {
        // $user = auth()->user();
        // return datatables()->of(City::where('country_id',$user->role->id)->with('country'))->toJson();
        // return datatables()->of(City::with(['country,cityManager']))->toJson();

        // $query=City::select('id','name','country_id','city_manager_id');
        // return datatables($query)->make(true);
        // return datatables()->of(DB::table('city'))->toJson();
        return datatables()->eloquent(City::query())->toJson();
    }

   
}
