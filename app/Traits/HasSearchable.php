<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait HasSearchable
{
    public function scopeSearch(Builder $query, ?string $keyword, ?array $fields = null): Builder
    {
        if (empty($keyword)) return $query;

        $keyword = trim($keyword);
        $fields = $fields ?? ($this->searchable ?? []);

        if (empty($fields)) return $query;

        $likeOperator = $this->getLikeOperator($query);

        return $query->where(function ($q) use ($keyword, $fields, $likeOperator) {

            foreach ($fields as $field) {

                $parts = explode('.', $field);

                if (count($parts) > 1) {

                    $column = array_pop($parts);
                    $relation = implode('.', $parts);

                    // ⛔ Jika relasi tidak ada di model, skip agar tidak error
                    if (!method_exists($this, $parts[0])) {
                        continue;
                    }

                    // ⛔ Jika kolom tidak ada di tabel relasi, skip
                    if (!$this->relationColumnExists($parts[0], $column)) {
                        continue;
                    }

                    $q->orWhereHas($parts[0], function ($relQuery) use ($parts, $column, $keyword, $likeOperator) {
                        $this->applyNestedRelation($relQuery, array_slice($parts, 1), $column, $keyword, $likeOperator);
                    });
                } else {
                    // cek kolom model utama
                    if (Schema::hasColumn($this->getTable(), $field)) {
                        $q->orWhere($field, $likeOperator, "%{$keyword}%");
                    }
                }
            }
        });
    }

    protected function applyNestedRelation($query, $relations, $column, $keyword, $likeOperator)
    {
        if (empty($relations)) {
            $query->where($column, $likeOperator, "%{$keyword}%");
            return;
        }

        $relation = array_shift($relations);

        if (!method_exists($query->getModel(), $relation)) {
            return; // aman, skip
        }

        // cek kolom relasi terakhir
        if (empty($relations) && !$this->relationColumnExists($relation, $column, $query)) {
            return;
        }

        $query->whereHas($relation, function ($relQuery) use ($relations, $column, $keyword, $likeOperator) {
            $this->applyNestedRelation($relQuery, $relations, $column, $keyword, $likeOperator);
        });
    }

    /**
     * Check apakah kolom ada di tabel relasi
     */
    protected function relationColumnExists(string $relationName, string $column, $query = null): bool
    {
        try {
            $model = $query
                ? $query->getModel()->{$relationName}()->getRelated()
                : $this->{$relationName}()->getRelated();

            return Schema::hasColumn($model->getTable(), $column);
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected function getLikeOperator(Builder $query): string
    {
        return $query->getConnection()->getDriverName() === 'pgsql'
            ? 'ILIKE'
            : 'LIKE';
    }
}
