## Description

A Bootstrap nav-tabs/nav-pills component for creating tabbed navigation with content panes. Supports multiple variants, alignment options, and styling configurations.

## Parameters

| Parameter    | Type     | Description                                                    | Default  |
|:-------------|:---------|:---------------------------------------------------------------|:---------|
| `tabs`       | `array`  | Array of tab items with id, label, link, and content keys     | `[]`     |
| `activeTab`  | `string` | ID of the active tab                                           | `null`   |
| `variant`    | `string` | Navigation style: `tabs` or `pills`                            | `tabs`   |
| `fill`       | `bool`   | Whether tabs should fill available width proportionally        | `false`  |
| `justified`  | `bool`   | Whether tabs should fill available width equally               | `false`  |
| `alignment`  | `string` | Horizontal alignment: `start`, `center`, or `end`              | `start`  |

## Tab Item Structure

Each tab in the `tabs` array can have the following keys:

| Key       | Type     | Description                                      | Required |
|:----------|:---------|:-------------------------------------------------|:---------|
| `id`      | `string` | Unique identifier for the tab                    | Yes      |
| `label`   | `string` | Text displayed in the tab link                   | Yes      |
| `link`    | `string` | URL for the tab link (optional)                  | No       |
| `content` | `string` | HTML content displayed in the tab pane           | No       |

## Usage

### Basic tabs

```twig
{{ component('cyclingapps_tab', {
    tabs: [
        {
            id: 'home',
            label: 'Home',
            content: '<p>Home tab content goes here.</p>'
        },
        {
            id: 'profile',
            label: 'Profile',
            content: '<p>Profile tab content goes here.</p>'
        },
        {
            id: 'contact',
            label: 'Contact',
            content: '<p>Contact tab content goes here.</p>'
        }
    ],
    activeTab: 'home'
}) }}
```

### Pills variant

```twig
{{ component('cyclingapps_tab', {
    tabs: [
        {
            id: 'overview',
            label: 'Overview',
            content: '<p>Overview content.</p>'
        },
        {
            id: 'details',
            label: 'Details',
            content: '<p>Detailed information.</p>'
        }
    ],
    activeTab: 'overview',
    variant: 'pills'
}) }}
```

### Centered tabs

```twig
{{ component('cyclingapps_tab', {
    tabs: [
        {
            id: 'tab1',
            label: 'Tab 1',
            content: '<p>Tab 1 content.</p>'
        },
        {
            id: 'tab2',
            label: 'Tab 2',
            content: '<p>Tab 2 content.</p>'
        },
        {
            id: 'tab3',
            label: 'Tab 3',
            content: '<p>Tab 3 content.</p>'
        }
    ],
    activeTab: 'tab1',
    alignment: 'center'
}) }}
```

### Fill tabs

```twig
{{ component('cyclingapps_tab', {
    tabs: [
        {
            id: 'longer-tab',
            label: 'Longer tab title',
            content: '<p>This tab has a longer title.</p>'
        },
        {
            id: 'short',
            label: 'Short',
            content: '<p>Short tab content.</p>'
        },
        {
            id: 'medium',
            label: 'Medium tab',
            content: '<p>Medium tab content.</p>'
        }
    ],
    activeTab: 'longer-tab',
    fill: true
}) }}
```

### Justified tabs

```twig
{{ component('cyclingapps_tab', {
    tabs: [
        {
            id: 'first',
            label: 'First',
            content: '<p>First tab content.</p>'
        },
        {
            id: 'second',
            label: 'Second',
            content: '<p>Second tab content.</p>'
        },
        {
            id: 'third',
            label: 'Third',
            content: '<p>Third tab content.</p>'
        }
    ],
    activeTab: 'first',
    justified: true
}) }}
```

### Right-aligned pills

```twig
{{ component('cyclingapps_tab', {
    tabs: [
        {
            id: 'settings',
            label: 'Settings',
            content: '<p>Settings content.</p>'
        },
        {
            id: 'privacy',
            label: 'Privacy',
            content: '<p>Privacy content.</p>'
        }
    ],
    activeTab: 'settings',
    variant: 'pills',
    alignment: 'end'
}) }}
```

### Tabs with links only (no content panes)

```twig
{{ component('cyclingapps_tab', {
    tabs: [
        {
            id: 'page1',
            label: 'Page 1',
            link: '/page1'
        },
        {
            id: 'page2',
            label: 'Page 2',
            link: '/page2'
        },
        {
            id: 'page3',
            label: 'Page 3',
            link: '/page3'
        }
    ],
    activeTab: 'page1'
}) }}
```

## Custom block content

You can override the tabs or content blocks to customize the display:

```twig
{% component 'cyclingapps_tab' with {
    tabs: [
        {id: 'tab1', label: 'Tab 1'},
        {id: 'tab2', label: 'Tab 2'}
    ],
    activeTab: 'tab1'
} %}
    {% block content %}
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="tab1-pane">
                <h4>Custom Tab 1 Content</h4>
                <p>Your custom content here with full control over markup.</p>
            </div>
            <div class="tab-pane fade" id="tab2-pane">
                <h4>Custom Tab 2 Content</h4>
                <p>More custom content.</p>
            </div>
        </div>
    {% endblock %}
{% endcomponent %}
```

## Notes

- The `fill` option makes tabs proportionally fill available width based on their content
- The `justified` option makes all tabs equal width
- If both `fill` and `justified` are true, `fill` takes precedence
- Tab content supports HTML (use with caution for user-generated content)
- The `activeTab` parameter should match one of the tab `id` values
- If no `activeTab` is specified, no tab will be active by default
