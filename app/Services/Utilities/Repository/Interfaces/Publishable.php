<?php

namespace App\Services\Utilities\Repository\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Publishable
{
    /**
     * @return BelongsToMany
     */
    public function authors(): BelongsToMany;
}
