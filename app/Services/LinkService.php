<?php

namespace App\Services;

use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Str;

class LinkService
{
    public function getLinkByUniqueLink(string $uniqueLink): Link
    {
        return Link::where('unique_link', $uniqueLink)->firstOrFail();
    }

    public function generateLink(User $user)
    {
        return Link::create([
            'user_id' => $user->id,
            'unique_link' => Str::uuid(),
            'expires_at' => now()->addDays(7),
        ]);
    }

    public function regenerateLink(Link $link)
    {
        $link->update([
            'is_active' => false
        ]);

        return $this->generateLink($link->user);
    }

    public function checkLink($user)
    {
        $link = $user->links->last();

        abort_if(
            !$link || !$link->is_active || $link->expires_at->isPast(),
            404,
            'Link is invalid or expired.'
        );

        return $link;
    }
}
