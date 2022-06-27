<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Memo1Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'employee_pengirim' => $this->pengirim->name,
            'employee_penerima' => $this->penerima->name,
            'Judul Meeting' => $this->meeting_id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
        ];
    }
}
