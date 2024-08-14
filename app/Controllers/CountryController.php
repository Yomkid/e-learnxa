<?php

namespace App\Controllers;

use App\Models\CountryModel;
use CodeIgniter\Controller;

class CountryController extends Controller
{
    public function populateCountries()
    {
        $countryModel = new CountryModel();

        $apiUrl = 'https://restcountries.com/v3.1/all';
        $response = file_get_contents($apiUrl);
        $countries = json_decode($response, true);

        foreach ($countries as $country) {
            $countryData = [
                'country_name' => $country['name']['common']
            ];

            $countryModel->insert($countryData);
        }

        return "Countries inserted successfully!";
    }
}
