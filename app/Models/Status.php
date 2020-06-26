<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Status
 *
 * @property int $id
 * @property string $content
 * @property int $user_id
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Status whereUserId($value)
 * @mixin \Eloquent
 */
class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['content'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
