<?php

use App\Models\Kerusakan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Sarana;

function checkedData($data, $search, $key = 'saranaId')
{
    $return = '';

    // Decode the JSON data
    $dataArray = json_decode($data, true);

    // Initialize a variable to store the matching data
    $matchingData = null;

    // Loop through the array to find the item with produkId 2
    foreach ($dataArray as $item) {
        if ($item['saranaId'] == $search) {
            $matchingData = $item;
            break;
        }
    }

    if ($matchingData) {
        $return = 'checked';
    }

    return [
        'checked' => $return,
        'data' => $matchingData[$key] ?? ''
    ];
}

function listData()
{
    $data = [
        'list' => [
            'Sarana', 'Peminjaman', 'Pengembalian', 'Kerusakan'
        ],
        'icons' => [
            'fa fa-dropbox',
            'fa fa-arrow-up',
            'fa fa-arrow-down',
            'fa fa-times',
        ]
    ];
    return $data;
}

function countData($model)
{
    $model = 'App\\Models\\' . $model;
    $jumlah = $model::count();
    return $jumlah;
}
