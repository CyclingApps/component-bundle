# Cycling Apps Component for Symfony

This bundle provides reusable components and utilities for Symfony applications.

## Repository

https://github.com/CyclingApps/component-bundle

## Components

- [FlashMessage](FlashMessage/index.md) - A Bootstrap alert component for displaying flash messages
- [LocaleSwitcher](LocaleSwitcher/index.md) - A locale switcher dropdown for Bootstrap navbar

## Install

Install with composer

```bash
  composer require cyclingapps/component-bundle
```

## Requirements

**Client:**
- Bootstrap 5
- Stimulus

**Server:**
- Symfony 7.3+
- Symfony UX Twig components 2.3+
- Symfony UX Icons components 2.3+

## How to override templates

- Create a `bundles/CyclingAppsComponentBundle/` directory in your template directory
- Copy/paste the original file (for example the `templates/components/locale_switcher.html.twig` to your `templates/bundles/CyclingAppsComponentBundle/components/locale_switcher.html.twig`)
- Update it with your own twig code

## How to override components

- Create a `src/Twig/Components/LocaleSwitcher.php` file in your application
- Extend from the component of this bundle
- Update your `config/services.yaml`

```yaml
services:
  CyclingApps\ComponentBundle\Twig\Components\LocaleSwitcher:
    class: App\Twig\Components\LocaleSwitcher
    public: true
    autoconfigure: true
    autowire: true
```
