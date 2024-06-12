# Feedback Form plugin

This plugin allows customers to sending information for feedback and this plugin can be automatically changed language when the website changes

## Getting Started

Use composer to install the plugin:

```bash
composer install nguyenhien/feedback
```

## Feedback Component

The admin can create feedback form on any page. This component will display a simple feedback form

    title = "feedback"
    url = "/"

    [mails]
    ==

    <h1>This is the feedback form</h1>
    {% component 'mails' %}