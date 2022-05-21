<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Geolocation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerService
{

    /**
     * Import Customers from CSV File
     *
     * @param string $fileName
     * @param string $password
     * @return array
     */
    public static function importCustomersFromCSV(string $fileName)
    {
        $statistics = [];
        $filePath = storage_path("imports/$fileName");

        try {
            $customerData = FileService::readCSV($filePath);
            $statistics = self::importCustomersFromArray($customerData);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $statistics;
    }

    /**
     * Imports customers from array
     *
     * @param $customerData
     * @return int[]
     */
    public static function importCustomersFromArray(array $customerData): array
    {
        $statistics = ['newlyCreated' => 0, 'previouslyCreated' => 0];

        try {
            foreach ($customerData as $singleCustomerInfo) {
                $customer = Customer::firstOrCreate(['email' => $singleCustomerInfo['email']], $singleCustomerInfo);

                //retrieve geolocation
                $location = GoogleMapService::getAddressLocation($singleCustomerInfo['city']);

                $geolocation = new Geolocation();
                $geolocation->latitude = $location['latitude'];
                $geolocation->longitude = $location['longitude'];
                $customer->geolocation()->save($geolocation);

                if ($customer->wasRecentlyCreated) {
                    $statistics['newlyCreated']++;
                } else {
                    $statistics['previouslyCreated']++;
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $statistics;
    }

    /**
     * Get all customers
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getCustomers(Request $request)
    {
        $customers = Customer::with('geolocation')->search($request)->paginate();
        return response()->json(['data' => $customers, 'success' => true], 200);
    }

    /**
     * Get a single customer
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getCustomer(int $id)
    {
        $customer = Customer::with('geolocation')->find($id);
        return response()->json(['data' => $customer, 'success' => true], 200);
    }
}
