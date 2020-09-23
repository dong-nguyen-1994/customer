<?php

namespace Modules\Customer\Repositories\Eloquents;

use Dnsoft\Core\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Customer\Repositories\CustomerRepositoryInterface;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function paginate($itemOnPage)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($itemOnPage);
    }

    public function create(array $data)
    {
        $this->hashPassword($data);

        return parent::create($data);
    }

    public function update(array $condition, array $data)
    {
        $this->checkForNewPassword($data);

        return parent::update($condition, $data);
    }

    public function updateById(array $data, $id)
    {
        $this->checkForNewPassword($data);

        return parent::updateById($data, $id);
    }

    /**
     * Hash the password key
     * @param array $data
     */
    private function hashPassword(array &$data)
    {
        $data['password'] = Hash::make($data['password']);
    }

    /**
     * Check if there is a new password given
     * If not, unset the password field
     * @param array $data
     */
    private function checkForNewPassword(array &$data)
    {
        if (array_key_exists('password', $data) === false) {
            return;
        }

        if ($data['password'] === '' || $data['password'] === null) {
            unset($data['password']);

            return;
        }

        $data['password'] = Hash::make($data['password']);
    }

    public function getByCondition($array)
    {
        return $this->model->where($array);
    }

    public function findInDate($column, $from, $to, $itemOnPage = 10)
    {
        return $this->model
            ->whereBetween($column, [$from, $to])
            ->paginate($itemOnPage);
    }
}
