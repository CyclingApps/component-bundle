# Navbar Component

## Description

The main navigation container component for creating responsive Bootstrap navigation bars. The Navbar component serves as the top-level container that holds the brand/logo and contains Menu components.

**Component Nesting:**
- **Navbar** (this component) is the top-level container
  - Contains one or more **Menu** components inside its `content` block
    - Each Menu contains one or more **MenuItem** components

## Parameters

| Parameter       | Type      | Description                                                                 | Default   |
|:----------------|:----------|:----------------------------------------------------------------------------|:----------|
| `logo`          | `string`  | URL to the logo image                                                       | `null`    |
| `name`          | `string`  | The brand/application name                                                  | `null`    |
| `link`          | `string`  | The URL for the brand link                                                  | `/`       |
| `theme`         | `string`  | The navbar theme (light, dark)                                             | `light`   |
| `expand`        | `string`  | Breakpoint for navbar expansion (sm, md, lg, xl, xxl, always, never)      | `lg`      |
| `fixed`         | `bool`    | Whether the navbar is fixed                                                 | `false`   |
| `fixedPosition` | `string`  | Position when fixed (top, bottom)                                          | `top`     |

## Usage

### Basic navbar

```twig
{{ component('cyclingapps_navbar', {
    name: 'My Application'
}) }}
```

### Navbar with logo

```twig
{{ component('cyclingapps_navbar', {
    logo: '/images/logo.png',
    name: 'My Application',
    link: '/home'
}) }}
```

### Dark navbar

```twig
{{ component('cyclingapps_navbar', {
    name: 'My Application',
    theme: 'dark'
}) }}
```

### Fixed navbar

```twig
{{ component('cyclingapps_navbar', {
    name: 'My Application',
    fixed: true,
    fixedPosition: 'top'
}) }}
```

### Navbar with custom expand breakpoint

```twig
{{ component('cyclingapps_navbar', {
    name: 'My Application',
    expand: 'md'
}) }}
```

### Complete navbar with nested Menu and MenuItem components

This example shows how to nest Menu components (which contain MenuItem components) inside the Navbar:

```twig
{% component 'cyclingapps_navbar' with {
    logo: '/images/logo.png',
    name: 'My Application',
    link: '/',
    theme: 'dark',
    expand: 'lg'
} %}
    {% block content %}
        {# Menu component is nested inside Navbar #}
        {% component 'cyclingapps_menu' %}
            {% block content %}
                {# MenuItem components are nested inside Menu #}
                {{ component('cyclingapps_menu_item', {
                    label: 'Home',
                    link: '/',
                    active: true
                }) }}
                {{ component('cyclingapps_menu_item', {
                    label: 'About',
                    link: '/about'
                }) }}
                {{ component('cyclingapps_menu_item', {
                    label: 'Contact',
                    link: '/contact'
                }) }}
            {% endblock %}
        {% endcomponent %}
    {% endblock %}
{% endcomponent %}
```

## Complete Example

Here's a complete example with multiple menus (left and right aligned) showing the full nesting structure:

```twig
{% component 'cyclingapps_navbar' with {
    logo: '/images/logo.png',
    name: 'CyclingApps',
    link: '/',
    theme: 'dark',
    expand: 'lg',
    fixed: true,
    fixedPosition: 'top'
} %}
    {% block content %}
        {# Left-aligned menu with navigation items #}
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

        {# Right-aligned menu with user dropdown #}
        {% component 'cyclingapps_menu' with { align: 'end' } %}
            {% block content %}
                {% if app.user %}
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

### Custom brand content

You can override the brand block to customize the logo and name display:

```twig
{% component 'cyclingapps_navbar' %}
    {% block brand %}
        <a class="navbar-brand" href="/">
            <img src="/logo.png" alt="Logo" height="40">
            <span class="fw-bold">Custom Brand</span>
        </a>
    {% endblock %}
    
    {% block content %}
        {# Menu components here #}
    {% endblock %}
{% endcomponent %}
```

## See Also

- [Menu Component](menu.md) - Container for organizing navigation items (nested inside Navbar)
- [MenuItem Component](menuItem.md) - Individual navigation links (nested inside Menu)
