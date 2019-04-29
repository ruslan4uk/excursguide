<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Countries extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'key' => $this->country_iso_code,
            'value' => $this->country_iso_code,
            'flag' => \Str::lower($this->country_iso_code),
            'text' => $this->country_name,
        ];
    }
}
