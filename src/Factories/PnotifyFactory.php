<?php

namespace Yoeunes\Notify\Pnotify\Factories;

use Yoeunes\Notify\Factories\BaseFactory;
use Yoeunes\Notify\Factories\Behaviours\ScriptableInterface;
use Yoeunes\Notify\Factories\Behaviours\ScriptsAwareTrait;
use Yoeunes\Notify\Factories\Behaviours\SingleNotificationAwareTrait;
use Yoeunes\Notify\Factories\Behaviours\StyleableInterface;
use Yoeunes\Notify\Factories\Behaviours\StylesAwareTrait;
use Yoeunes\Notify\Pnotify\Notifiers\Pnotify;

class PnotifyFactory extends BaseFactory implements StyleableInterface, ScriptableInterface
{
    use SingleNotificationAwareTrait;
    use StylesAwareTrait;
    use ScriptsAwareTrait;

    /** @var \Yoeunes\Notify\Notifiers\NotificationInterface */
    private $notification;

    public function notification($type, $message, $title = '', $context = [])
    {
        return $this->notification = new Pnotify($type, $message, $title, $context);
    }

    public function info($message, $title = '', $context = [])
    {
        return $this->notification('notice', $message, $title, $context);
    }

    public function render()
    {
        $options = isset($this->config['options']) ? $this->config['options'] : [];

        return sprintf('<script type="application/javascript">%sPNotify.defaults = %s;%s%s%s</script>',
            PHP_EOL,
            json_encode($options),
            PHP_EOL,
            $this->notification->render(),
            PHP_EOL
        );
    }

    public function getNotification()
    {
        return $this->notification;
    }
}
