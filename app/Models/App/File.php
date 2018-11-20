<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    const PATH = 'path';
    const FILEABLE_ID = 'fileable_id';
    const FILEABLE_TYPE = 'fileable_type';

    /**
     * @var array
     */
    protected $fillable = [
        self::PATH,
        self::FILEABLE_ID,
        self::FILEABLE_TYPE,
        'extension'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
