<?php

namespace Rental\Services\_common;

use Rental\Models\_common\RentalDeviceData;

trait ArchiveTrait
{
    protected $_model;
    public function __construct(RentalDeviceData $model)
    {
        $this->_model = $model;
    }

    public function archive($rental_device_id)
    {
        $this->_model->setArchiveFlag($rental_device_id);
        return;
    }

    public function unset_archive($rental_device_id)
    {
        $this->_model->unsetArchiveFlag($rental_device_id);
        return;
    }
}
