<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiblePathway extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'bible_pathways';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'diagram_type_id',
        'root_node_id',
        'double_tree_left_node_id',
        'double_tree_right_node_id',
        'sankey_start_node_id',
        'sankey_end_node_id',
        'link_for_pathway',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ContentTag::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ContentCategory::class);
    }

    public function links()
    {
        return $this->belongsToMany(Link::class);
    }

    public function diagram_type()
    {
        return $this->belongsTo(DiagramType::class, 'diagram_type_id');
    }

    public function root_node()
    {
        return $this->belongsTo(Node::class, 'root_node_id');
    }

    public function double_tree_left_node()
    {
        return $this->belongsTo(Node::class, 'double_tree_left_node_id');
    }

    public function double_tree_right_node()
    {
        return $this->belongsTo(Node::class, 'double_tree_right_node_id');
    }

    public function sankey_start_node()
    {
        return $this->belongsTo(Node::class, 'sankey_start_node_id');
    }

    public function sankey_end_node()
    {
        return $this->belongsTo(Node::class, 'sankey_end_node_id');
    }
}
