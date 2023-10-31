<?php

namespace App\Repositories;


class UserRepository
{

    public function filterDataProvider($data, $provider, $statusCode, $balanceMin, $balanceMax, $currency)
    {
        $filteredData = array_filter($data, function ($item) use ($provider, $statusCode, $balanceMin, $balanceMax, $currency) {

            $isStatusCodeMatched = empty($statusCode) || $item[$this->getStatusCodeKey($provider['name'])] == $this->dataProviderStatus($provider['name'], $statusCode);

            $isBalanceMatched = (empty($balanceMin) || $item[$this->getBalanceKey($provider['name'])] >= $balanceMin) && (empty($balanceMax) || $item[$this->getBalanceKey($provider['name'])] <= $balanceMax);

            $isCurrencyMatched = empty($currency) || $item['currency'] === $currency;

            return $isStatusCodeMatched && $isBalanceMatched && $isCurrencyMatched;
        });

        return array_values($filteredData);
    }

    private function getStatusCodeKey($providerName)
    {
        $data = [
            'DataProviderX' => 'statusCode',
            'DataProviderY' => 'status'
        ];
        return $data[$providerName];
    }

    private function getBalanceKey($providerName)
    {
        $data = [
            'DataProviderX' => 'parentAmount',
            'DataProviderY' => 'balance'
        ];
        return $data[$providerName];
    }


    private function dataProviderStatus($providerName, $status)
    {

        $statusArray = [
            'DataProviderX' => [
                'authorised' => 1,
                'decline' => 2,
                'refunded' => 3
            ],
            'DataProviderY' => [
                'authorised' => 100,
                'decline' => 200,
                'refunded' => 300
            ],
        ];

        return $status != null ? $statusArray[$providerName][$status] : '';
    }
}
