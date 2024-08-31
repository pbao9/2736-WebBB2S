<?php

namespace App\Admin\Repositories;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function findByField(string $field, $value, array $relations = []): ?Model;
    /**
     * Return all records
     *
     * @param string $orderBy
     * @param array $relations
     * @param array $parameters
     * @return mixed
     */
    public function getAll();
    /**
     * Find a single record
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     * @throws \Exception
     */
    public function findOrFail($id);
    /**
     * Find a single record
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     * @throws \Exception
     */

    public function exists($conditions);
    public function find($id);
    public function findBy(array $filter, array $relations = []);
    /**
     * Create a new record
     *
     * @param array $data The input data
     * @return object model instance
     * @throws \Exception
     */
    public function create(array $data);

    /**
     * Update the model instance
     *
     * @param int $id The model id
     * @param array $data The input data
     * @return object model instance
     * @throws \Exception
     */
    public function update($id, array $data);

    public function updateOrCreate(array $attributes, array $values = []);
    /**
     * Delete a record
     *
     * @param int $id Model id
     * @return object model instance
     * @throws \Exception
     */
    public function delete($id);
    /**
     * make query
     *
     * @return mixed
     */
    public function getQueryBuilder();

    public function getByQueryBuilder(array $filter, array $relations = []);

    public function getQueryBuilderOrderBy();

    public function getBy(array $filter, array $relations = []);

    public function updateAttribute(mixed $id, string $attribute, mixed $value);
    /**
     * make query
     *
     * @return mixed
     */

    /**
     * make query
     *
     * @param string $action
     *
     * @return boolean
     */
    public function authorize($action);

    public function getInstance();

    public function syncModelRoles($modelId, array $roles);

    public function assignRoles(Model $model, array $rolesNames): bool;
}
