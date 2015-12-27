<?php

namespace ProjectManager\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjectManager\Transformers\UserTransformer;

class UserPresenter extends FractalPresenter
{
    
    public function getTransformer()
    {
        return new UserTransformer();
    }
}
