<?php

namespace App\Models;

use App\Enums\SystemCacheKeyEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected static function booted()
    {
        static::updated(function ($object) {
            cache()->forget(SystemCacheKeyEnum::CATEGORIES_PRODUCT);
        });


        static::created(function ($object) {
            if($object->getAttributes()['parent_id'] === null) {
                $objectCategories = getCategories();
                $objectCategories->push($object);
                cache()->put(SystemCacheKeyEnum::CATEGORIES_PRODUCT, $objectCategories );
            }

        });
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function countCate($parent_id)
    {
        $countCate = Category::where('parent_id', $parent_id)->get();
        return $countCate->count();
    }


    public function childArray($model = null)
    {
        $model = $model ?? $this;

        $result = [];

        if ($model !== $this) {
            array_push($result, $model->id);
        }

        $childs = $model->children;
        if ($childs->isNotEmpty()) {
            foreach ($childs as $value) {
                $result = array_merge($result, $this->childArray($value));
            }
        }

        return $result;
    }
}
