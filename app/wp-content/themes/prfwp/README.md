<p align="center">
  <a href="https://proftit.com/">
    <img alt="Proftit" src="https://proftit.com/wp-content/uploads/2019/12/logo-copy-3.png" height="28px">
  </a>
</p>

<p align="center">
  <strong>WordPress starter theme with a modern development workflow</strong>
  <br />
   Created by PROFTIT developers, based on Roots/Sage starter theme
</p>

<p align="center">
  <a href="https://proftit.com/">Official Website</a> | <a href="https://binaricore.atlassian.net/wiki/spaces/WP/pages/2080768125/Getting+started">Getting Started</a> | <a href="https://binaricore.atlassian.net/wiki/spaces/WP/pages/3161194527/Deployment">Deployment Process</a>
</p>

## Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](https://secure.php.net/manual/en/install.php) >= 7.1.3
  (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 8.0.0
* [Yarn](https://yarnpkg.com/en/docs/install)

## Theme structure

```shell
themes/prfwp/                    # → Root of Proftit theme
├── app/                         # → Theme PHP
│   ├── Controllers/             # → Controller files
│   ├── Directives/              # → Custom functionality (ACF, etc.)
│   ├── actions.php              # → Theme actions
│   ├── admin.php                # → Theme customizer setup
│   ├── Directives.php           # → Theme directives
│   ├── filters.php              # → Theme filters
│   ├── helpers.php              # → Helper functions
│   ├── setup.php                # → Theme setup
│   └── shortcodes.php           # → Theme shortcodes
├── composer.json                # → Autoloading for `app/` files
├── composer.lock                # → Composer lock file (never edit)
├── dist/                        # → Built theme assets (never edit)
├── node_modules/                # → Node.js packages (never edit)
├── package.json                 # → Node.js dependencies and scripts
├── editorconfig                 # → IDE editor configuration
├── eslintrc.js                  # → Eslint configuration
├── gitattributes                # → Exclude files from archive files
├── nvmrc                        # → Current NVM version
├── prettierrc.js                # → Prettier configuration
├── stylelintignore              # → Files and folders ignored by stylelint
├── stylelintrc.js               # → Stylelint configuration
├── phpcs.xml                    # → PHP Coding Standards
├── resources/                   # → Theme assets and templates
│   ├── assets/                  # → Front-end assets
│   │   ├── config.json          # → Settings for compiled assets
│   │   ├── build/               # → Webpack and ESLint config
│   │   ├── fonts/               # → Theme fonts
│   │   ├── images/              # → Theme images
│   │   ├── scripts/             # → Theme JS
│   │   └── styles/              # → Theme stylesheets
│   ├── lang/                    # → Language storage directory
│   ├── functions.php            # → Composer autoloader, theme includes
│   ├── index.php                # → Never manually edit
│   ├── screenshot.png           # → Theme screenshot for WP admin
│   ├── style.css                # → Theme meta information
│   └── views/                   # → Theme templates
│       ├── acf                  # → ACF dynamic content
│       ├── layouts/             # → Base templates
│       ├── partials/            # → Partial templates
│       ├── popups/              # → Custom popups
│       ├── proftit-widgets/     # → PROFTIT widgets
│       └── svg/                 # → Theme svg
└── vendor/                      # → Composer packages (never edit)
```

## Theme development

- Run `yarn` from the theme directory to install dependencies

### Build commands

- `yarn start` — Compile assets when file changes are made, start Browsersync session
- `yarn build` — Compile and optimize the files in your assets directory
- `yarn prod` — Compile assets for production
