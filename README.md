# INTRODUCTION
This bundle is very elastic. There is no dependence with view or other non-logic purpose. **100% pure CRUD.**
# ECOSYSTEM
Events, Exceptions and SOLID supportet by [SOLID](http://github.com/dawid-bednarz/SOLID "SOLID")
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
declare listener in **service.yaml**
```yaml
    App\EventListener\UserExceptionListener:
            tags:
                - { name: kernel.event_listener, event: kernel.exception }
```