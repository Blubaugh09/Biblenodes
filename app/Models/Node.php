<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Node extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'nodes';

    protected $appends = [
        'default_node_image',
        'other_node_images',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'text',
        'gender',
        'weight',
        'show_text_on_click',
        'object_type',
        'user_id',
        'location',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function nodesVerseConnections()
    {
        return $this->belongsToMany(VerseConnection::class);
    }

    public function nodesRelatedToNodeMedia()
    {
        return $this->belongsToMany(NodeMedium::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ContentTag::class);
    }

    public function getDefaultNodeImageAttribute()
    {
        return $this->getMedia('default_node_image')->last();
    }

    public function getOtherNodeImagesAttribute()
    {
        return $this->getMedia('other_node_images');
    }
}
