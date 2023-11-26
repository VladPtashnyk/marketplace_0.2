<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_category';
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Read all entities from DB table Categories
     *
     * @return Collection
     */
    public function readAllCategories(): Collection
    {
        return Category::withTrashed()->get();
    }

    /**
     * Read all entities' ids & names from DB table Categories
     *
     * @return Collection
     */
    public function readCategoriesNames(): Collection
    {
        return Category::all([$this->primaryKey, 'name']);
    }

    /**
     * Read one entity from DB table Categories
     *
     * @param int $idCategory
     * @return object
     */
    public function readCategory(int $idCategory): object
    {
        return Category::findOrFail($idCategory);
    }

    /**
     * Insert entity into DB table Categories
     *
     * @param array $data
     * @return object
     */
    public function storeCategory(array $data): object
    {
        return Category::create($data);
    }

    /**
     * Insert entity into DB table Categories
     *
     * @param int $idCategory
     * @param array $data
     */
    public function updateCategory(int $idCategory, array $data): void
    {
        Category::where($this->primaryKey, $idCategory)
                ->update($data);
    }

    /**
     * Soft-Delete entity in DB table Categories
     *
     * @param int $idCategory
     */
    public function deleteCategory(int $idCategory): void
    {
        Category::findOrFail($idCategory)
                ->delete();
    }

    /**
     * Restore entity in DB table Categories
     *
     * @param int $idCategory
     */
    public function restoreCategory(int $idCategory): void
    {
        Category::onlyTrashed()
                ->find($idCategory)
                ->restore();
    }
}
