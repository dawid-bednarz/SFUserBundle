# DESCRIPTION
Elastic user registration bundle
# INSTALATION
1 Add bundle route file to your main routes.yaml (config/routes.yaml)
```yaml
userRegistrationBundle:
    prefix: user/registration/
    resource: '@UserRegistrationBundle/Resources/config/routes.yaml'
``` 
2 Register Listener (config/services.yaml)
```yaml
    App\EventListener\User\Registration\ResponseListener:
        tags:
            - { name: kernel.event_listener, event: !php/const DawBed\UserRegistrationBundle\Event\Events::REGISTRATION_RESPONSE }
    App\EventListener\User\Registration\ErrorListener:
        tags:
            - { name: kernel.event_listener, event: !php/const DawBed\UserRegistrationBundle\Event\Events::REGISTRATION_ERROR }
```
Look on the below to see example listener
```php
namespace App\EventListener\Registration\User;

class ResponseListener
{
    function __invoke(ResponseInterfaceEvent $event): void
    {
        $response = new Response();
        $user = $event->getUser();
        $response->setContent('...');

        $event->setResponse($response);
    }
}
```
Example Registration Error Listener
```php
namespace App\EventListener\Registration\User;

class ErrorListener
{
    public function __invoke(FormErrorEvent $event)
    {
        $form = $event->getForm();
        $response = new Response();
        $response->setContent('...');
        $event->setResponse($response);
    }
}
```
# COMMANDS
Checking if you have all registered listeners
```
bin/console dawbed:debug:event_listener  
```
