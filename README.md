# Website boilerplate

This package is a boilerplate (or a *very light* framework?) to easily start with a fresh base. It is suitable for any 
simple website (you can do more serious website too). With the initial configuration, you are quickly ready to go!

I first made it for myself, to prevent start from scratch every time I launch a quick projet, or develop a simple 
website for clients that need more than just front-end languages.

**Powered by:**
- php 7.4+
- Slim 4
- Twig 3
- Webpack
    - Scss + Stylelint + PostCss
    - JS (es6) + Eslint + Babel
    - Minfiers
- Dotenv

**Chapters**

- [Install](#install)
- [Configure](#configure)
- [Run](#run)
- [Deploy](#deploy)
- *Routes (one day...)*
- *Views (one day...)*
- *Storage (one day...)*
- *Helpers (one day...)*

---

## <a name="install"></a>Install

Well, let's go! First, you have to install the packages. To do that, simply run the commands below. This document uses
*yarn* but since we didn't included the `*.lock` file, you can switch to *npm*.

```shell script
composer install
yarn install
```

## <a name="configure"></a>Configure

Before running the website and start to develop. You have to take a moment to configure it.

**Environment**

The most important on is the app environmement. Copy the `.env.example` file as an `.env` file.
Then, edit the values inside according to your needs.

**Bedrock (css base)**

*Bedrock* is the sweet name I found for the base css. Its main adventages are to reset default browser styles and setup
new styles basis. If you want to define all of that yourself, just remove it and go on.

Configurable as follow:

| File                   | Purpose
| ---------------------- |---------
| `bedrock/_config.scss` | Main configuration file, edit it first
| `bedrock/_text.scss`   | Configuration for main texts related styles and classes
| `bedrock/_colors.scss` | Color palette
| `bedrock/_fonts.scss`  | The place to put your @font-face 

Some credits:
- [normalize.css](https://github.com/necolas/normalize.css): for reseting styles
- [Tailwind Css](https://tailwindcss.com): for reseting styles
- [Suit Css](https://github.com/suitcss/base): for reseting styles
- [Open Color](https://yeun.github.io/open-color): for the default color palette

## <a name="run"></a>Run

Ok, you configured your app, you are good to start the engines.

First, run the php server.

```shell script
composer serve
```

Then, run webpack to compile files.

```shell script
yarn run dev
```

**Auto compiling**

To let webpack re-compile when you change an asset, you can run the command below. It will automatically open a page on
your webbrowser.

```shell script
yarn run hot
```


## <a name="deploy"></a>Deploy

Yeah, you made it so far! Congratulation for your new website!

Before publishing it, you must prepare it. First, change the `.env` file in order to reflect the production environment.
Do not forget to set `APP_ENV=production`, it makes the framework uses cache views, mask errors, and so on...

Install php packages without the ones for development. Then publish your assets as production, it will optimize them. 

```shell script
composer install --no-dev --optimize-autoloader
yarn run prod
```

**Nginx**

We did not include nginx base configuration. You have to redirect requests to `public/index.php`.
Do not forget to set the `public/` as a root directory for better security.

**Apache**

For Apache users, a `.htaccess` is implemented, but not tested. Check it before publishing your website.
Do not forget to set the `public/` as a root directory for better security.