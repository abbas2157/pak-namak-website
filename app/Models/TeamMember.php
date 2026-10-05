<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'title', 'bio', 'bio_ur', 'photo', 'facebook', 'tiktok', 'instagram', 'linkedin', 'twitter', 'youtube', 'whatsapp', 'sort_order'];

    public function getPhotoUrlAttribute(): ?string
    {
        if (! $this->photo) {
            return null;
        }

        return str_starts_with($this->photo, 'images/') ? asset($this->photo) : asset('storage/'.$this->photo);
    }
}
