<?php

namespace Modules\Customer\Repositories;

use Dnsoft\Core\Repositories\BaseRepositoryInterface;

interface CustomerRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCondition(array $data);

    public function findInDate($column, $from, $to, $paginate = 10);
}
