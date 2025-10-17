# Cycling Apps Component for Symfony

This bundle provides reusable components and utilities for Symfony applications.

## Repository

https://github.com/CyclingApps/component-bundle

## Components

- [Alert](Alert/alert.md) - A Bootstrap alert component for displaying messages
- [Card](Card/card.md) - A Bootstrap card component for displaying content in a flexible and extensible container
- **Navigation Components** - Bootstrap components for creating responsive navigation:
  - [Navbar](Navigation/navbar.md) - Main navigation container with logo, name, and link configuration
  - [Menu](Navigation/menu.md) - Menu container for organizing navigation items
  - [MenuItem](Navigation/menuItem.md) - Individual navigation links or items
  - [LocaleSwitcher](Navigation/localeSwitcher.md) - A locale switcher dropdown for Bootstrap navbar
  - [Tab](Navigation/tab.md) - A Bootstrap nav-tabs/nav-pills component for creating tabbed navigation

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
- Copy/paste the original file (for example the `templates/card/card.html.twig` to your `templates/bundles/CyclingAppsComponentBundle/card/card.html.twig`)
- Update it with your own twig code

## How to override components

- Create a `src/Twig/Components/Card/Card.php` file in your application
- Extend from the component of this bundle
- Update your `config/services.yaml`

```yaml
services:
  CyclingApps\ComponentBundle\Twig\Components\Card\Card:
    class: App\Twig\Components\Card
    ...
```
