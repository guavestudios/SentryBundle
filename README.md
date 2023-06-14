# Sentry Bundle

This contao module allow you to integrate Sentry via Twig into your templates with [`sentry/sentry-symfony` bundle][1]

## Requirements

- Contao 4.13+
- PHP 7.4 or 8.0+

## Install

```BASH
$ composer require guave/sentry-bundle
```

## Usage

First, configure the `sentry/sentry-symfony` bundle: [Documentation][2]

### Recommended configuration

```yml
sentry:
    dsn: "https://xyz@sentry.io/xy"
    register_error_listener: false

Sentry\Monolog\Handler:
    arguments:
        $hub: '@Sentry\State\HubInterface'
        $level: !php/const Monolog\Logger::ERROR # Can be one of https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#log-levels, but System::log() only uses INFO or ERROR
        $bubble: false

monolog:
    handlers:
        sentry:
            type: service
            id: Sentry\Monolog\Handler
            priority: 100 # Higher priority than ContaoTableHandler which will stop handling afterwards (bubbling is set to true)
            bubble: false # Use bubble: true if you don't want the logs to show up in the system log (bubbling means, no monolog handlers will run afterwards)
```

### User feedback

On the other hand you might want to implement the [User feedback][3] feature of sentry. The user feedback is primarily
useful to let the users know that you've gotten notified about the issue and to let users give the opportunity to add
some comments.

In order to integrate this feature, you have to alter the error page template. Place a copy of
`vendor/contao/core-bundle/src/Resources/views/Error/layout.html.twig` in the directory
`app/Resources/ContaoCoreBundle/views/Error/`.

Modify the copied template and place the following snippet just before the closing `</body>` tag:

```twig
{% set sentry_id = ''|sentry_last_event_id %}
{% if sentry_id %}
    <script src="https://browser.sentry-cdn.com/5.7.1/bundle.min.js"
            integrity="sha384-KMv6bBTABABhv0NI+rVWly6PIRvdippFEgjpKyxUcpEmDWZTkDOiueL5xW+cztZZ"
            crossorigin="anonymous"></script>
    <script>
        Sentry.init({dsn: '{{ ''|sentry_dsn }}'});
        Sentry.showReportDialog({eventId: '{{ sentry_id }}'})

        // You can also bind the "show" method to an event, e.g. to open the modal on button click
        {#document.querySelector('.btn-report').addEventListener('click', function (e) {#}
        {#    e.preventDefault();#}
        {#    Sentry.showReportDialog({eventId: '{{ sentry_id }}'})#}
        {#});#}
    </script>
{% endif %}
```

[1]: https://github.com/getsentry/sentry-symfony/

[2]: https://github.com/getsentry/sentry-symfony/#configuration-of-the-sdk

[3]: https://docs.sentry.io/learn/user-feedback/
