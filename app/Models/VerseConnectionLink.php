<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerseConnectionLink extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'verse_connection_links';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'link_id',
        'verse',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function link()
    {
        return $this->belongsTo(Link::class, 'link_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
