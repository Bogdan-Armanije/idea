<?php

namespace App\Models;

use Database\Factories\IdeaFactory;
use App\IdeaStatus;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;

    protected $casts = [
        'links' =>AsArrayObject::class,
        'status' => IdeaStatus::class,
    ];

    protected $attributes = [
      'status' => IdeaStatus::PENDING->value
    ];

    public static function statusCount(User $user): Collection{
        $statusCounts= $user->ideas()->SelectRaw('count(*) as count, status')->groupBy('status')->pluck('count', 'status');

        return collect(IdeaStatus::cases())
            ->mapWithKeys(fn($status) => [
                $status->value => $statusCounts->get($status->value,0)
            ])
            ->put('all', $user->ideas()->count());

    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function steps():HasMany
    {
        return $this->hasMany(Step::class);
    }

}
