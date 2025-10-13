# Cycling Apps Component for Symfony

This bundle provides reusable components and utilities for Symfony applications.

## Repository

https://github.com/CyclingApps/component-bundle

## Components

- [Alert](Alert/alert.md) - A Bootstrap alert component for displaying messages
- [Card](Card/card.md) - A Bootstrap card component for displaying content in a flexible and extensible container
- [LocaleSwitcher](LocaleSwitcher/localeSwitcher.md) - A locale switcher dropdown for Bootstrap navbar
- **Navbar Components** - Bootstrap navbar components for creating responsive navigation bars:
  - [Navbar](Navbar/navbar.md) - Main navigation container with logo, name, and link configuration
  - [Menu](Navbar/menu.md) - Menu container for organizing navigation items
  - [MenuItem](Navbar/menuItem.md) - Individual navigation links or items
- [Tab](Navigation/tab.md) - A Bootstrap nav-tabs/nav-pills component for creating tabbed navigation with content panes

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
