<?php

namespace ProjectManager\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjectManager\Transformers\ClientTransformer;

class ClientPresenter extends FractalPresenter
{
    
    public function getTransformer() 
    {
        return new ClientTransformer();
    }
    
}
