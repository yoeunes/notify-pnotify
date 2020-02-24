<?php

namespace Yoeunes\Notify\Pnotify\Notifiers;

use Yoeunes\Notify\Notifiers\BaseNotification;

class Pnotify extends BaseNotification
{
    public function getNotifier()
    {
        return 'pnotify';
    }

    public function render()
    {
        return sprintf("new PNotify({title:'%s', text:'%s', type:'%s'});",
            $this->getTitle(),
            $this->getMessage(),
            $this->getType()
//            json_encode($this->getOptions())
        );
    }
}
