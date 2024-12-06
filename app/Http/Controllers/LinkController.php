<?php

namespace App\Http\Controllers;

use App\Services\LinkService;

class LinkController extends Controller
{
    public function __construct(
        private readonly LinkService $linkService
    ){}


    public function show($uniqueLink)
    {
        $link = $this->linkService->getLinkByUniqueLink($uniqueLink);

        abort_if(
            !$link->is_active || $link->expires_at->isPast(),
            404,
            'Link is invalid or expired.'
        );

        return view('link', ['link' => $link]);
    }

    public function regenerate($uniqueLink)
    {
        $link = $this->linkService->getLinkByUniqueLink($uniqueLink);

        $newLink = $this->linkService->regenerateLink($link);

        return redirect()->route('link.show', $newLink->unique_link);
    }

    public function deactivate($uniqueLink)
    {
        $link = $this->linkService->getLinkByUniqueLink($uniqueLink);

        $link->update(['is_active' => false]);

        return redirect('/');
    }
}
