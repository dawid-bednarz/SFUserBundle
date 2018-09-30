# INTRODUCTION
This bundle is very elastic. There is no dependence with view or other non-logic purpose. **100% pure CRUD.**
# ECOSYSTEM
Events, Exceptions 
# EXCEPTIONS
you have to handle exceptions on your own.

### Available exceptions:
- `DawBed\UserBundle\Exception\Form\ErrorException` - catch all !isValid form

for example your main project directory is src/. Create file **EventListener/UserExceptionListener**
```php
    namespace App\EventListener;
    
    use DawBed\UserBundle\Exception\Form\ErrorException;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
    
    class UserExceptionListener
    {
        public function __invoke(GetResponseForExceptionEvent $event)
        {
            if ($event->getException() instanceof ErrorException) {
                $response = new Response;
                /**
                 * you have access to form $event->getException()->getForm()
                 * may convert to json,xml or twig view ?
                 */
                $response->setContent('....');
                $event->setResponse($response);
            }
        }
    }
```
declare exception listener in your **service.yaml**
```yaml
    App\EventListener\UserExceptionListener:
            tags:
                - { name: kernel.event_listener, event: kernel.exception }
```
To enable validation edit your **framework.yaml** config
```yaml
framework:
    validation: { enabled: true }
```
# EVENTS
You can:
- overwrite user entity
- extend support request/response registration process

#### Overwrite user entity
services.yaml
```yaml
    App\EventListener\User\GetUserEntityListener:
        tags:
            - { name: kernel.event_listener, event: !php/const DawBed\UserBundle\Event\Events::GET_USER_ENTITY }
```
```php
namespace App\EventListener\User;
use App\Entity\User;
use DawBed\UserBundle\Event\Entity\GetUserEntityEvent;

class GetUserEntityListener
{
    function __invoke(GetUserEntityEvent $getUserEntityEvent): void
    {
        $getUserEntityEvent->setEntity(new User());
    }
}
```
#### Response registration process
services.yaml
```yaml
    App\EventListener\User\RegistrationResponseListener:
        tags:
            - { name: kernel.event_listener, event: !php/const DawBed\UserBundle\Event\Events::REGISTRATION_RESPONSE }
```
```php
namespace App\EventListener\User;

use DawBed\UserBundle\Event\Response\RegistrationEvent;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationResponseListener
{
    private $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    function __invoke(RegistrationEvent $event): void
    {

        $this->entityManager->flush(); // save new user

        $event->getResponse()
            ->setContent('...');
    }
}
```
# COMMANDS
Checking if you have all registered listeners
```
bin/console dawbed:debug:event_listener  
```
