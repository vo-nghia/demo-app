<?php

namespace App\Repositories;

use EloquentFilter\Filterable;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    /**
     * set model class
     *
     * @return string
     */
    abstract public function modelClass(): string;

    /**
     * Get Table Name
     *
     * @return string
     */
    public function getTableName(): string
    {
        return $this->model->getTable();
    }

    /**
     * Get Key Name
     *
     * @return string
     */
    public function getKeyName(): string
    {
        return $this->model->getKeyName();
    }

    /**
     * Get All
     *
     * @param array $select
     *
     * @return ?\Illuminate\Database\Eloquent\Collection
     */
    public function all(array $select = []): ?\Illuminate\Database\Eloquent\Collection
    {
        if (empty($select)) {
            return $this->model::all();
        }

        return $this->model::select($select)->get();
    }

    /**
     * Get By Primary Key
     *
     * @param mixed $id
     * @param array $select
     *
     * @return ?\Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $select = []): ?\Illuminate\Database\Eloquent\Model
    {
        if (empty($select)) {
            return $this->model::find($id);
        }

        return $this->model::select($select)->find($id);
    }

    /**
     * Get By Array Primary Key
     *
     * @param array $ids
     * @param array $select
     *
     * @return ?\Illuminate\Database\Eloquent\Collection
     */
    public function findMany(array $ids, array $select = []): ?\Illuminate\Database\Eloquent\Collection
    {
        if (empty($select)) {
            return $this->model::findMany($ids);
        }

        return $this->model::select($select)->findMany($ids);
    }

    /**
     * Get First Record by Foreign Key
     *
     * @param string $column
     * @param mixed $value
     * @param array $select
     *
     * @return ?\Illuminate\Database\Eloquent\Model
     */
    public function firstByFK(string $column, $value, array $select = []): ?\Illuminate\Database\Eloquent\Model
    {
        if (empty($select)) {
            return $this->model::{ is_array($value) ? 'whereIn' : 'where' }($column, $value)
                ->first();
        }

        return $this->model::{ is_array($value) ? 'whereIn' : 'where' }($column, $value)
            ->select($select)
            ->first();
    }

    /**
     * Get Records by Foreign Key
     *
     * @param string $column
     * @param mixed $value
     * @param array $select
     *
     * @return ?\Illuminate\Database\Eloquent\Collection
     */
    public function getByFK(string $column, $value, array $select = []): ?\Illuminate\Database\Eloquent\Collection
    {
        if (empty($select)) {
            return $this->model::{ is_array($value) ? 'whereIn' : 'where' }($column, $value)
                ->get();
        }

        return $this->model::{ is_array($value) ? 'whereIn' : 'where' }($column, $value)
            ->select($select)
            ->get();
    }

    /**
     * Find with Filtered
     *
     * @param array $requestData
     * @param array $select
     *
     * @return ?\Illuminate\Database\Eloquent\Model
     */
    public function firstFiltered(array $requestData, array $select = []): ?\Illuminate\Database\Eloquent\Model
    {
        $builder = $this->model->filter($requestData);

        if (isset($requestData['sorts'])) {
            $builder->sortable($requestData['sorts']);
        }

        if (! empty($select)) {
            $builder->select($select);
        }

        return $builder->first();
    }

    /**
     * Get with Filtered
     *
     * @param array $requestData
     * @param array $select
     *
     * @return ?\Illuminate\Database\Eloquent\Collection
     */
    public function getFiltered(array $requestData, array $select = []): ?\Illuminate\Database\Eloquent\Collection
    {
        $builder = $this->model->filter($requestData);

        if (isset($requestData['sorts'])) {
            $builder->sortable($requestData['sorts']);
        }

        if (! empty($select)) {
            $builder->select($select);
        }

        return $builder->get();
    }

    /**
     * Get with Filtered
     *
     * @param array $requestData
     * @param array $select
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFilteredPaginator(array $requestData, array $select = []): LengthAwarePaginator
    {
        $perPage = $requestData['per_page'] ?? config('allu.DEFAULT_COUNT_PER_PAGE');

        $builder = $this->model->newQuery();

        if (isset($requestData['sorts'])) {
            $builder->sortable($requestData['sorts']);
        }

        if (! empty($select)) {
            $builder->select($select);
        }

        if (in_array(Filterable::class, class_uses_recursive($this->modelClass()), true)) {
            return $builder->filter($requestData)->paginateFilter($perPage);
        }

        return $builder->paginate($perPage);
    }

    /**
     * Update Or Create
     *
     * @param array $attributes
     * @param array $values
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = []): \Illuminate\Database\Eloquent\Model
    {
        return $this->model::updateOrCreate($attributes, $values);
    }

    /**
     * Update Or Create Many Record
     *
     * @param array $values
     * @param array|string $uniqueBy
     * @param ?array $updateColumns
     *
     * @return int
     */
    public function updateOrCreateMany(array $values, array|string $uniqueBy, ?array $updateColumns = null): int
    {
        return $this->model::upsert($values, $uniqueBy, $updateColumns);
    }

    /**
     * Soft Delete
     *
     * @param mixed $ids
     *
     * @return int
     */
    public function destroy($ids): int
    {
        return $this->model::{ is_array($ids) ? 'whereIn' : 'where' }($this->getKeyName(), $ids)
            ->delete();
    }

    /**
     * Hard Delete
     *
     * @param mixed $ids
     *
     * @return int
     */
    public function delete($ids): int
    {
        return $this->model::{ is_array($ids) ? 'whereIn' : 'where' }($this->getKeyName(), $ids)
            ->forceDelete();
    }

    /**
     * Restore
     *
     * @param mixed $ids
     *
     * @return int
     */
    public function restore($ids): int
    {
        return $this->model::{ is_array($ids) ? 'whereIn' : 'where' }($this->getKeyName(), $ids)
            ->restore();
    }

    /**
     * Filtering and delete
     *
     * @param array $where
     * @param bool $forceDelete
     *
     * @throws Exception
     *
     * @return void
     */
    public function findDelete(array $where, bool $forceDelete = false): void
    {
        $builder = $this->model->filter($where);

        if ($forceDelete) {
            $builder->forceDelete();
        } else {
            $builder->delete();
        }
    }

    /**
     * Create
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        return $this->model::create($data);
    }

    /**
     * Update
     *
     * @param array $attributes
     * @param array $values
     *
     * @return int
     */
    public function update(array $attributes, array $values = []): int
    {
        return $this->model::where(function ($query) use ($attributes) {
            foreach ($attributes as $key => $value) {
                $query->where($key, $value);
            }

            return $query;
        })->update($values);
    }

    /**
     * Set model
     */
    private function setModel()
    {
        $this->model = app()->make($this->modelClass());
    }
}
