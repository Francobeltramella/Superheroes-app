<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CountryResource
 * @OA\Schema(
 * )
 */
class SuperheroResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     * 
     * @OA\Property(format="int64", title="id", default="10", description="10", property="id"),
     * @OA\Property(format="string", title="name", default="Argentina", description="Argentina", property="name"),
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'fullName' => $this->fullName,
            'strength' => $this->strength,
            'speed' => $this->speed,
            'durability' => $this->durability,
            'power' => $this->power,
            'combat' => $this->combat,
            'race'=> $this->race,
            'heigth'=> $this->heigth,
            'heigthCm'=> $this->heigthCm,
            'weightLb'=> $this->weightLb,
            'weightKg'=> $this->weightKg,
            'eyeColor'=> $this->eyeColor,
            'hairColor'=> $this->hairColor,
            'publisher'=> $this->publisher,
        ];
    }
}
