# MenuItem Component

## Description

Individual navigation link or item component for use within a Bootstrap navbar Menu. The MenuItem component represents a single clickable navigation link, supports icons via Symfony UX Icons, includes automatic active state detection, and can be configured as a dropdown menu.

**Component Nesting:**
- **Navbar** is the top-level container
  - Contains one or more **Menu** components inside its `content` block
    - Each **Menu** contains one or more **MenuItem** components (this component) inside its `content` block

## Parameters

| Parameter       | Type     | Description                                                        | Default |
|:----------------|:---------|:-------------------------------------------------------------------|:--------|
| `label`         | `string` | The text label for the menu item                                   | `''`    |
| `link`          | `string` | The URL for the link                                               | `null`  |
| `active`        | `bool`   | Whether the item is currently active (auto-detected if not set)    | `false` |
| `disabled`      | `bool`   | Whether the item is disabled                                       | `false` |
| `icon`          | `string` | Icon name for Symfony UX Icons (e.g., 'bi:house')                 | `null`  |
| `isDropdown`    | `bool`   | Whether the item is a dropdown menu                                | `false` |
| `dropdownItems` | `array`  | Array of dropdown items (each with label, link, icon, etc.)       | `[]`    |

## Automatic Active Detection

The MenuItem component automatically detects whether it should be marked as active based on the current route. This eliminates the need to manually set the `active` parameter in most cases.

**How it works:**

- If the `link` parameter matches the current request path exactly, the item is automatically marked as active
- If the current path starts with the `link` (prefix match), the item is also marked as active, except for the root path `/`
- The root path `/` only matches exactly, not as a prefix
- Manual `active` parameter always takes precedence over auto-detection
- Auto-detection also works for dropdown items

**Examples:**

```twig
{# These items will automatically be marked as active when on their respective pages #}
{{ component('cyclingapps_menu_item', {
    label: 'Home',
    link: '/'
}) }}

{{ component('cyclingapps_menu_item', {
    label: 'Products',
    link: '/products'
}) }}

{# This will be active on /products, /products/123, /products/category/bikes, etc. #}
```

**Manual override:**

You can still manually control the active state when needed:

```twig
{# Force active even if not on this route #}
{{ component('cyclingapps_menu_item', {
    label: 'Home',
    link: '/',
    active: true
}) }}

{# Force inactive even if on this route #}
{{ component('cyclingapps_menu_item', {
    label: 'About',
    link: '/about',
    active: false
}) }}
```

## Usage

### Basic menu item

MenuItem components must be nested inside a Menu component, which itself is nested inside a Navbar:

```twig
{% component 'cyclingapps_navbar' with { name: 'My App' } %}
    {% block content %}
        {% component 'cyclingapps_menu' %}
            {% block content %}
                {# Basic MenuItem nested inside Menu #}
                {{ component('cyclingapps_menu_item', {
                    label: 'Home',
                    link: '/'
                }) }}
            {% endblock %}
        {% endcomponent %}
    {% endblock %}
{% endcomponent %}
```

### Active menu item

```twig
{{ component('cyclingapps_menu_item', {
    label: 'Current Page',
    link: '/current',
    active: true
}) }}
```

### Disabled menu item

```twig
{{ component('cyclingapps_menu_item', {
    label: 'Coming Soon',
    link: '/soon',
    disabled: true
}) }}
```

### Menu item without link

```twig
{{ component('cyclingapps_menu_item', {
    label: 'Text Only'
}) }}
```

### Menu item with icon

Menu items support icons using Symfony UX Icons:

```twig
{{ component('cyclingapps_menu_item', {
    label: 'Home',
    link: '/',
    icon: 'bi:house'
}) }}

{{ component('cyclingapps_menu_item', {
    label: 'Settings',
    link: '/settings',
    icon: 'bi:gear'
}) }}
```

### Dropdown menu item

Menu items can be configured as dropdowns with nested items:

```twig
{{ component('cyclingapps_menu_item', {
    label: 'Account',
    icon: 'bi:person-circle',
    isDropdown: true,
    dropdownItems: [
        {label: 'Profile', link: '/profile', icon: 'bi:person'},
        {label: 'Settings', link: '/settings', icon: 'bi:gear'},
        {divider: true},
        {label: 'Logout', link: '/logout', icon: 'bi:box-arrow-right'}
    ]
}) }}
```

### Dropdown with headers and dividers

Dropdown items support headers and dividers for better organization:

```twig
{{ component('cyclingapps_menu_item', {
    label: 'More',
    isDropdown: true,
    dropdownItems: [
        {header: true, label: 'Section 1'},
        {label: 'Action 1', link: '/action1', icon: 'bi:star'},
        {label: 'Action 2', link: '/action2', icon: 'bi:heart'},
        {divider: true},
        {header: true, label: 'Section 2'},
        {label: 'Action 3', link: '/action3', icon: 'bi:bookmark'}
    ]
}) }}
```

### Dropdown items with active and disabled states

Dropdown items can have active and disabled states (active state is also auto-detected for dropdown items):

```twig
{{ component('cyclingapps_menu_item', {
    label: 'Options',
    isDropdown: true,
    dropdownItems: [
        {label: 'Active Item', link: '/active', active: true},
        {label: 'Normal Item', link: '/normal'},
        {label: 'Disabled Item', link: '/disabled', disabled: true}
    ]
}) }}
```

## Complete Example

Here's a complete example showing MenuItem components with all features in a complete nesting structure:

```twig
{% component 'cyclingapps_navbar' with {
    logo: '/images/logo.png',
    name: 'CyclingApps',
    link: '/',
    theme: 'dark',
    expand: 'lg'
} %}
    {% block content %}
        {# Left-aligned menu with basic items (auto-active detection) #}
        {% component 'cyclingapps_menu' with { align: 'start' } %}
            {% block content %}
                {{ component('cyclingapps_menu_item', {
                    label: 'Home',
                    link: '/',
                    icon: 'bi:house'
                }) }}
                {{ component('cyclingapps_menu_item', {
                    label: 'Rides',
                    link: '/rides',
                    icon: 'bi:bicycle'
                }) }}
                {{ component('cyclingapps_menu_item', {
                    label: 'Profile',
                    link: '/profile',
                    icon: 'bi:person'
                }) }}
            {% endblock %}
        {% endcomponent %}

        {# Right-aligned menu with dropdown item #}
        {% component 'cyclingapps_menu' with { align: 'end' } %}
            {% block content %}
                {% if app.user %}
                    {# Dropdown MenuItem with nested dropdown items #}
                    {{ component('cyclingapps_menu_item', {
                        label: app.user.username,
                        icon: 'bi:person-circle',
                        isDropdown: true,
                        dropdownItems: [
                            {label: 'My Account', link: '/account', icon: 'bi:person'},
                            {label: 'Settings', link: '/settings', icon: 'bi:gear'},
                            {divider: true},
                            {label: 'Logout', link: '/logout', icon: 'bi:box-arrow-right'}
                        ]
                    }) }}
                {% else %}
                    {{ component('cyclingapps_menu_item', {
                        label: 'Login',
                        link: '/login',
                        icon: 'bi:box-arrow-in-right'
                    }) }}
                {% endif %}
            {% endblock %}
        {% endcomponent %}
    {% endblock %}
{% endcomponent %}
```

## Customization

### Custom menu item content

You can override the content block of a menu item for complete customization:

```twig
{% component 'cyclingapps_menu_item' with { link: '/profile' } %}
    {% block content %}
        <a class="nav-link" href="/profile">
            <i class="bi bi-person"></i> Profile
        </a>
    {% endblock %}
{% endcomponent %}
```

## See Also

- [Navbar Component](navbar.md) - Main navigation container (top-level container)
- [Menu Component](menu.md) - Container for organizing navigation items (parent component that contains MenuItem)
