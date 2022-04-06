<?php

namespace App\Imports;

use App\Models\Superhero;
use App\Models\Superheroe;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class SuperheroeImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
     
        return new Superheroe([

         
            'name' => $row['name'],
            'fullName' => $row['fullname'],
            'strength' => $row['strength'],
            'speed' => $row['speed'],
            'durability' => $row['durability'],
            'power' => $row['power'],
            'combat' => $row['combat'],
            'race'=>$row['race'],
            'heigth'=> $row['height0'],
            'heigthCm'=> $row['height1'],
            'weigthLb'=> $row['weight0'],
            'weigthKg'=> $row['weight1'],
            'eyeColor'=>$row['eyecolor'],
            'hairColor'=>$row['haircolor'],
            'publisher'=>$row['publisher'],

                            
        ]);
    }
}