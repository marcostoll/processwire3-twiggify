# ProcessWire Module "Twiggify" #

This module offers you template devlopment using the [Twig templating engine](http://twig.sensiolabs.org/) by replacing 
the TemplateFile::render hook with its own logic.

## Installing the module ##

Just copy the module files into you `site/modules/` folder or downoload it via the ModuleManager.  
Your directory structure should look like this:  

site/  
|-> modules/  
|--|-> Twiggify  
|--|--|-> Twiggify.module  
|--|--|-> TwiggifyConfig.php  
|--|--|-> License.txt  
|--|--|-> README.md  
 
After deploying the module files go to **Setup/Modules** in your ProcessWire backend. You should find the **Twiggify** 
module in the **Twiggify** section. Hit install and be ready.
 
## Configuring the module ##

The **Twiggify** module offers a small set of configuration options. Follow the hints and notes given within the 
configuration form.

## Dependancies ##

### ProcessWire Versions ###

This module is built for ProcessWire 3 only, requiring version 3.0.14 with support for file compilers at minimum.

### Twig ###

The module uses and depends on the [Twig libraries](http://twig.sensiolabs.org/). The module **does not** install Twig 
by itself. You should probable do this via composer. Follow the instructions on the Twig website. The module was tested using Twig v1.24.2.

## Accessing the ProcessWire API ###

According to your module configuration, each specified ProcessWire fuel key will be provided as global variable for the 
twig template. You may access their properties as normal:

    <h1>{{ page.title }}</h1>
    <h1>{{ user.name }}</h1>

Additionally a twig function **wr()** is provided to mimic the global \ProcessWire\wire() function. This lets you access 
any ProcessWire object that is listed as [ProcessWire Api variable](http://processwire.com/api/ref/). 

    <div>{{ wr('user').email }}</div>
    
A note aside: I'd loved to have named this twig function **wire()** instead of **wr()**. But the current Twig template 
compiler favors known global functions instead of added Twig_SimpleFunction instances in case of duplicate function 
names. And than crashes if the known global function is namespaced, which is the case with **\ProcessWire\wire()**.   

## Customizing Twiggify ##

The **Twiggify** modules provides it's own hooks for customization purposes:
 
### Twiggify::initTwig ###
  
This would be the place to either manipulate the twig environment options (by intercepting before the hook) or adding 
Twig extensions at will (by intercepting after the hook).

### Twiggify::initTwigLoader ###

As default behaviour Twiggify tells Twig to use a standard **Twig_Loader_Filesystem** to look up the configured template
path for the actual twig template to render. By using this hook you may customize this behaviour.

### Twiggify::getTwigTemplate ###

This is the place where Twiggify computes the file name of the page's template to render. Per default this is just the
basename of the page's template. By using this hook you may customize this behaviour.

### Twiggify::getTwigContext ###

At least Twiggify gathers the contextual data to pass to **Twig_Environment::render()**. The standard behaviour is the 
gather the configured wire fuel contents. By tapping into this hook you may add, remove, change any keys from the
gathered context, or by-pass Twiggify's implementation at all.

Use this as an simple example to add enable the Twig debug extension.

    namespace ffe\ProcessWire3;
    
    use ProcessWire\HookEvent;
    use ProcessWire\Module;
    use ProcessWire\WireData;
    
    class TwiggifyExtensions extends WireData implements Module {
    
        public static function getModuleInfo() {
            return array(
                'title' => "Twiggify Extensions",
                'version' => "0.0.1",
                'summary' => "Intercepts the ___initTwig() hook of Twiggify",
    
                'author' => "Marco",
    
                'autoload' => true,
                'singular' => true,
    
            );
        }
    
        public function init()
        {
            $this->addHookAfter('Twiggify::initTwig', $this, 'addTwigExtensions');
        }
    
        public function addTwigExtensions(HookEvent $event)
        {
            /** @var \Twig_Environment $twigEnv */
            $twigEnv = $event->return;
    
            $twigEnv->addExtension(new \Twig_Extension_Debug());
        }
    };
    
Additionally you may use the **Twiggify::initTwigLoader** and/or **Twiggify::getTwigTemplate** hooks to customize the 
loading of the twig templates to render.    
    
## Using the twig file extension ##

When using Twig templates it is best to configure ProcessWire to use either a `twig` or `html` file extension to get 
maxmimum support from your ide.

ProcessWire defines the default `php` file extensions for templates in its core config (`wire/config.php`, 
option `$config->templateExtension`). But you don't have to mess with the core files. Just add the following line to 
your site config (`site/config.php`):

	$config->templateExtension = 'twig';

**Attention**:  
Be sure to rename the default admin template from `site/templates/admin.php` to `site/templates/admin.twig`! Otherwise 
your ProcessWire backend won't work if you've change the template extension option.
    
## Things to do ##

- check interaction with ProcessWire's template cache
- check interaction with TemplateDataProviders module

## License ##

This module is released under the MIT License. See [LICENSE.txt](LICENSE.txt). 