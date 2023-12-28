<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'links';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'from_node_id',
        'to_node_id',
        'label',
        'connection_type',
        'weight',
        'show_text_on_click',
        'user_created_id',
        'affect_node_id',
        'affected_svg_state',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function linksBiblePathways()
    {
        return $this->belongsToMany(BiblePathway::class);
    }

    public function from_node()
    {
        return $this->belongsTo(Node::class, 'from_node_id');
    }

    public function to_node()
    {
        return $this->belongsTo(Node::class, 'to_node_id');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ContentTag::class);
    }

    public function affect_node()
    {
        return $this->belongsTo(Node::class, 'affect_node_id');
    }
}
