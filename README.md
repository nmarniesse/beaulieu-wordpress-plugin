# Wordpress plugin for Cinema Beaulieu

This plugin is based on the [pods plugin](https://fr.wordpress.org/plugins/pods/) and provides:
- a *film* type with several fields (casting, synopsis, duration, poster, trailer, ...)
- a custom block to display the planning of the week

## Develop

Requirements:

- php 8.0
- composer

If you have a Wordpress instance, you can directly develop in it:
Clone the project, then:

```bash
cd <wordpress_directory>/wp-content/plugins
git clone git@github.com:nmarniesse/beaulieu-wordpress-plugin.git cinema-beaulieu
cd cinema-beaulieu && composer install
```

Then you just have to activate the `cinema-beaulieu` plugin in the Wordpress administration.

## Use the plugin:

- In your Wordpress instance, install and activate [pods](https://fr.wordpress.org/plugins/pods/)
- In the pod menu, import the config `config/pods-config.json`
- Import this plugin and activate it
- Start to create some movies!
