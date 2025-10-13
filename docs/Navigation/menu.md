# Menu Component

## Description

A menu container component for organizing navigation items within a Bootstrap navbar. The Menu component is used to group MenuItem components and control their layout and alignment.

**Component Nesting:**
- **Navbar** is the top-level container
  - Contains one or more **Menu** components (this component) inside its `content` block
    - Each **Menu** contains one or more **MenuItem** components inside its `content` block

## Parameters

| Parameter   | Type     | Description                          | Default      |
|:------------|:---------|:-------------------------------------|:-------------|
| `align`     | `string` | Menu alignment (start, center, end)  | `start`      |

## Usage

### Basic menu

This example shows a Menu nested inside a Navbar with MenuItem components:

```twig
{% component 'CyclingApps:Navigation:Navbar' with { name: 'My App' } %}
    {% block content %}
        {# Menu component nested inside Navbar #}
        {% component 'CyclingApps:Navigation:Menu' %}
            {% block content %}
                {# MenuItem components nested inside Menu #}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Home',
                    link: '/'
                }) }}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'About',
                    link: '/about'
                }) }}
            {% endblock %}
        {% endcomponent %}
    {% endblock %}
{% endcomponent %}
```

### Centered menu

```twig
{% component 'CyclingApps:Navigation:Navbar' with { name: 'My App' } %}
    {% block content %}
        {% component 'CyclingApps:Navigation:Menu' with { align: 'center' } %}
            {% block content %}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Home',
                    link: '/'
                }) }}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'About',
                    link: '/about'
                }) }}
            {% endblock %}
        {% endcomponent %}
    {% endblock %}
{% endcomponent %}
```

### Right-aligned menu

```twig
{% component 'CyclingApps:Navigation:Navbar' with { name: 'My App' } %}
    {% block content %}
        {% component 'CyclingApps:Navigation:Menu' with { align: 'end' } %}
            {% block content %}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Login',
                    link: '/login'
                }) }}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Register',
                    link: '/register'
                }) }}
            {% endblock %}
        {% endcomponent %}
    {% endblock %}
{% endcomponent %}
```

### Multiple menus in a navbar

You can have multiple Menu components in a single Navbar (e.g., left and right aligned):

```twig
{% component 'CyclingApps:Navigation:Navbar' with {
    name: 'My Application',
    logo: '/images/logo.png'
} %}
    {% block content %}
        {# Left-aligned menu #}
        {% component 'CyclingApps:Navigation:Menu' with { align: 'start' } %}
            {% block content %}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Home',
                    link: '/',
                    icon: 'bi:house'
                }) }}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Products',
                    link: '/products',
                    icon: 'bi:bag'
                }) }}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'About',
                    link: '/about',
                    icon: 'bi:info-circle'
                }) }}
            {% endblock %}
        {% endcomponent %}

        {# Right-aligned menu #}
        {% component 'CyclingApps:Navigation:Menu' with { align: 'end' } %}
            {% block content %}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Login',
                    link: '/login',
                    icon: 'bi:box-arrow-in-right'
                }) }}
            {% endblock %}
        {% endcomponent %}
    {% endblock %}
{% endcomponent %}
```

## Complete Example

Here's a complete example showing a navbar with multiple menus containing different types of menu items:

```twig
{% component 'CyclingApps:Navigation:Navbar' with {
    logo: '/images/logo.png',
    name: 'CyclingApps',
    link: '/',
    theme: 'dark',
    expand: 'lg'
} %}
    {% block content %}
        {# Primary navigation menu - left aligned #}
        {% component 'CyclingApps:Navigation:Menu' with { align: 'start' } %}
            {% block content %}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Home',
                    link: '/',
                    icon: 'bi:house'
                }) }}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Rides',
                    link: '/rides',
                    icon: 'bi:bicycle'
                }) }}
                {{ component('CyclingApps:Navigation:MenuItem', {
                    label: 'Profile',
                    link: '/profile',
                    icon: 'bi:person'
                }) }}
            {% endblock %}
        {% endcomponent %}

        {# User menu - right aligned with dropdown #}
        {% component 'CyclingApps:Navigation:Menu' with { align: 'end' } %}
            {% block content %}
                {% if app.user %}
                    {{ component('CyclingApps:Navigation:MenuItem', {
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
                    {{ component('CyclingApps:Navigation:MenuItem', {
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

## See Also

- [Navbar Component](navbar.md) - Main navigation container (parent component that contains Menu)
- [MenuItem Component](menuItem.md) - Individual navigation links (nested inside Menu)
