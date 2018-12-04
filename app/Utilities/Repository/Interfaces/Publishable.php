<?php

namespace App\Utilities\Repository\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Publishable
{
    /**
     * @return BelongsToMany
     */
    public function authors(): BelongsToMany;
}
