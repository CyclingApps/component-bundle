## Description

A Bootstrap widget component for displaying key metrics, statistics, and navigation elements in an attractive dashboard-style format. The widget component is perfect for showcasing important data with icons, counts, and optional click-through functionality.

## Parameters

| Parameter | Type     | Description                                                                        | Default   |
|:----------|:---------|:-----------------------------------------------------------------------------------|:----------|
| `label`   | `string` | The text label to display                                                          | `''`      |
| `variant` | `string` | The widget variant (primary, secondary, success, danger, warning, info, light, dark) | `primary` |
| `icon`    | `string` | The icon to display (using Symfony UX Icons notation like 'lucide:folder')        | `null`    |
| `link`    | `string` | URL to make the entire widget clickable                                            | `null`    |
| `count`   | `string` | Numerical or textual count to display prominently                                  | `null`    |

## Usage

### Basic widget with count

```twig
{{ component('CyclingApps:Widget', {
    label: 'Projects',
    count: '25',
    variant: 'primary',
    icon: 'lucide:folder'
}) }}
```

### Clickable widget

```twig
{{ component('CyclingApps:Widget', {
    label: 'View Projects',
    count: '25',
    variant: 'primary',
    icon: 'lucide:external-link',
    link: '/projects'
}) }}
```

### Widget without count (status display)

```twig
{{ component('CyclingApps:Widget', {
    label: 'Status: Active',
    variant: 'success',
    icon: 'lucide:check-circle'
}) }}
```

### Revenue widget with formatted count

```twig
{{ component('CyclingApps:Widget', {
    label: 'Revenue',
    count: '$45,123.50',
    variant: 'success',
    icon: 'lucide:dollar-sign'
}) }}
```

## All available variants

```twig
{{ component('CyclingApps:Widget', {
    label: 'Primary Widget',
    count: '10',
    variant: 'primary',
    icon: 'lucide:star'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Secondary Widget',
    count: '20',
    variant: 'secondary',
    icon: 'lucide:star'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Success Widget',
    count: '30',
    variant: 'success',
    icon: 'lucide:check-circle'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Danger Widget',
    count: '40',
    variant: 'danger',
    icon: 'lucide:alert-circle'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Warning Widget',
    count: '50',
    variant: 'warning',
    icon: 'lucide:alert-triangle'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Info Widget',
    count: '60',
    variant: 'info',
    icon: 'lucide:info'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Light Widget',
    count: '70',
    variant: 'light',
    icon: 'lucide:sun'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Dark Widget',
    count: '80',
    variant: 'dark',
    icon: 'lucide:moon'
}) }}
```

## Common use cases

### Dashboard metrics

```twig
<div class="row">
    <div class="col-md-3">
        {{ component('CyclingApps:Widget', {
            label: 'Total Users',
            count: '1,234',
            variant: 'primary',
            icon: 'lucide:users',
            link: '/admin/users'
        }) }}
    </div>
    <div class="col-md-3">
        {{ component('CyclingApps:Widget', {
            label: 'Active Projects',
            count: '89',
            variant: 'success',
            icon: 'lucide:folder',
            link: '/projects'
        }) }}
    </div>
    <div class="col-md-3">
        {{ component('CyclingApps:Widget', {
            label: 'Pending Tasks',
            count: '15',
            variant: 'warning',
            icon: 'lucide:clock',
            link: '/tasks'
        }) }}
    </div>
    <div class="col-md-3">
        {{ component('CyclingApps:Widget', {
            label: 'System Issues',
            count: '3',
            variant: 'danger',
            icon: 'lucide:alert-triangle',
            link: '/admin/issues'
        }) }}
    </div>
</div>
```

### Navigation widgets

```twig
<div class="row">
    <div class="col-md-4">
        {{ component('CyclingApps:Widget', {
            label: 'Manage Settings',
            variant: 'secondary',
            icon: 'lucide:settings',
            link: '/settings'
        }) }}
    </div>
    <div class="col-md-4">
        {{ component('CyclingApps:Widget', {
            label: 'View Reports',
            variant: 'info',
            icon: 'lucide:bar-chart',
            link: '/reports'
        }) }}
    </div>
    <div class="col-md-4">
        {{ component('CyclingApps:Widget', {
            label: 'User Profile',
            variant: 'primary',
            icon: 'lucide:user',
            link: '/profile'
        }) }}
    </div>
</div>
```

### Status indicators

```twig
{{ component('CyclingApps:Widget', {
    label: 'System Status: Online',
    variant: 'success',
    icon: 'lucide:check-circle'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Maintenance Mode',
    variant: 'warning',
    icon: 'lucide:wrench'
}) }}

{{ component('CyclingApps:Widget', {
    label: 'Service Unavailable',
    variant: 'danger',
    icon: 'lucide:x-circle'
}) }}
```

## Popular icon examples

### Business and analytics icons

```twig
{# Sales and revenue #}
{{ component('CyclingApps:Widget', {
    label: 'Monthly Sales',
    count: '$125,000',
    variant: 'success',
    icon: 'lucide:trending-up'
}) }}

{# User metrics #}
{{ component('CyclingApps:Widget', {
    label: 'New Registrations',
    count: '47',
    variant: 'primary',
    icon: 'lucide:user-plus'
}) }}

{# Performance indicators #}
{{ component('CyclingApps:Widget', {
    label: 'Page Views',
    count: '15.2K',
    variant: 'info',
    icon: 'lucide:eye'
}) }}

{# System metrics #}
{{ component('CyclingApps:Widget', {
    label: 'Server Load',
    count: '23%',
    variant: 'success',
    icon: 'lucide:server'
}) }}
```

### Project management icons

```twig
{# Tasks and projects #}
{{ component('CyclingApps:Widget', {
    label: 'Completed Tasks',
    count: '156',
    variant: 'success',
    icon: 'lucide:check-square'
}) }}

{# Time tracking #}
{{ component('CyclingApps:Widget', {
    label: 'Hours Logged',
    count: '240h',
    variant: 'primary',
    icon: 'lucide:clock'
}) }}

{# Team management #}
{{ component('CyclingApps:Widget', {
    label: 'Team Members',
    count: '12',
    variant: 'info',
    icon: 'lucide:users'
}) }}
```

### E-commerce icons

```twig
{# Orders and sales #}
{{ component('CyclingApps:Widget', {
    label: 'New Orders',
    count: '89',
    variant: 'primary',
    icon: 'lucide:shopping-cart'
}) }}

{# Inventory #}
{{ component('CyclingApps:Widget', {
    label: 'Low Stock Items',
    count: '5',
    variant: 'warning',
    icon: 'lucide:package'
}) }}

{# Customers #}
{{ component('CyclingApps:Widget', {
    label: 'Active Customers',
    count: '2,341',
    variant: 'success',
    icon: 'lucide:heart'
}) }}
```

## Custom block content

You can override the content block to customize the widget display:

```twig
{% component 'CyclingApps:Widget' with {
    variant: 'primary',
    icon: 'lucide:trophy'
} %}
    {% block content %}
        <div class="widget-content col-md-11">
            <h2 class="count text-primary mb-1">Achievement</h2>
            <p class="mb-0">Level Complete!</p>
            <small class="text-muted">+500 XP earned</small>
        </div>
    {% endblock %}
{% endcomponent %}
```

## Advanced usage with attributes

```twig
{{ component('CyclingApps:Widget', {
    label: 'Custom Widget',
    count: '42',
    variant: 'info',
    icon: 'lucide:star'
}, {
    class: 'my-custom-widget border-2',
    'data-bs-toggle': 'tooltip',
    'data-bs-title': 'Click for more details'
}) }}
```

## Grid layouts

Widgets work perfectly in Bootstrap grid layouts for responsive dashboards:

```twig
<div class="row g-3">
    <div class="col-xl-3 col-md-6">
        {{ component('CyclingApps:Widget', {
            label: 'Users',
            count: '1,234',
            variant: 'primary',
            icon: 'lucide:users'
        }) }}
    </div>
    <div class="col-xl-3 col-md-6">
        {{ component('CyclingApps:Widget', {
            label: 'Revenue',
            count: '$45K',
            variant: 'success',
            icon: 'lucide:dollar-sign'
        }) }}
    </div>
    <div class="col-xl-3 col-md-6">
        {{ component('CyclingApps:Widget', {
            label: 'Orders',
            count: '89',
            variant: 'warning',
            icon: 'lucide:shopping-cart'
        }) }}
    </div>
    <div class="col-xl-3 col-md-6">
        {{ component('CyclingApps:Widget', {
            label: 'Issues',
            count: '3',
            variant: 'danger',
            icon: 'lucide:alert-circle'
        }) }}
    </div>
</div>
```

## Responsive design

The widget component is fully responsive and adapts to different screen sizes. On mobile devices, the layout automatically adjusts for optimal viewing:

```twig
{# Responsive widget row #}
<div class="row g-2 g-md-3">
    {% for metric in dashboard_metrics %}
        <div class="col-6 col-lg-3">
            {{ component('CyclingApps:Widget', {
                label: metric.label,
                count: metric.count,
                variant: metric.variant,
                icon: metric.icon,
                link: metric.link
            }) }}
        </div>
    {% endfor %}
</div>
```

## Accessibility

The widget component includes proper semantic markup and accessibility features:

- Uses semantic HTML elements for proper screen reader support
- Clickable widgets use proper link semantics
- Icons are decorative and don't interfere with screen readers
- Color variants are supplemented with icons for better accessibility
- Proper focus management for keyboard navigation

## CSS Classes Generated

The component generates the following CSS classes based on the Enabel Bootstrap Theme:

- Base class: `widget`
- Variant classes: `widget-primary`, `widget-secondary`, `widget-success`, `widget-danger`, `widget-warning`, `widget-info`, `widget-light`, `widget-dark`
- Layout classes: `widget-icon`, `widget-content`, `widget-link`
- Typography classes: `count` (for numerical displays)

## Integration with Symfony UX Icons

The widget component seamlessly integrates with Symfony UX Icons, supporting all icon libraries available in your Symfony application:

```twig
{# Lucide icons (recommended) #}
{{ component('CyclingApps:Widget', {
    icon: 'lucide:folder'
}) }}

{# Bootstrap icons #}
{{ component('CyclingApps:Widget', {
    icon: 'bi:house-door'
}) }}

{# Font Awesome (if configured) #}
{{ component('CyclingApps:Widget', {
    icon: 'fa:user'
}) }}

{# Heroicons #}
{{ component('CyclingApps:Widget', {
    icon: 'heroicons:home'
}) }}
```