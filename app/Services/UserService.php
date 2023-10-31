<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;


class UserService
{
    protected $userRespository, $providers;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRespository)
    {
        $this->userRespository = $userRespository;
        $this->providers = config('providers');
    }


    public function index(Request $request)
    {
        // Get the request data
        $provider = $request->query('provider');
        $statusCode = $request->query('statusCode') ?? $request->query('status');
        $balanceMin = $request->query('balanceMin');
        $balanceMax = $request->query('balanceMax');
        $currency = $request->query('currency');

        $data = [];
        if($provider){

            $jsonData = json_decode(file_get_contents(storage_path('app/Json/' . $this->providers[$provider]['file'])), true);

            $filteredDataProvider = $this->userRespository->filterDataProvider($jsonData, $this->providers[$provider], $statusCode, $balanceMin, $balanceMax, $currency);
            
            $data[$provider] = $filteredDataProvider;
                   
        }else{

            foreach ($this->providers as $provider => $providerConfig) {

                $jsonData = json_decode(file_get_contents(storage_path('app/Json/' . $providerConfig['file'])), true);

                $filteredDataProvider = $this->userRespository->filterDataProvider($jsonData, $providerConfig , $statusCode, $balanceMin, $balanceMax, $currency);

                $data[$provider] = $filteredDataProvider;
            }
    
        }
       
        return $data;

    }


}
