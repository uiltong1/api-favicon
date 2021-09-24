<?php

namespace app\Repositories;

use App\Models\Maturity;
use App\Repositories\AbstractRepository;

class MaturityRepository extends AbstractRepository{

    protected $maturity;

    public function __construct(Maturity $maturity)
    {
        parent::__construct($maturity);
    }

}