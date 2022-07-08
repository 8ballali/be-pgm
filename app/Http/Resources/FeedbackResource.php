<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
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
            'customer_name' => $this->customer->name,
            'category_name' => $this->category->name,
            'type' => $this->type,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'bukti' => $this->bukti_url,
            'feedback_score' => $this->feedback_score,
            'feedback_deskripsi' => $this->feedback_deskripsi,
            'tindak_lanjut' => $this->tindak_lanjut_url,
        ];
    }
}
