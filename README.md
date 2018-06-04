# SCSS plugin for Craft CMS 3.x

Compile SCSS to CSS in your templates

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require chasegiunta/scss

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for SCSS.

## SCSS Overview

Craft conveniently offers `{% css %}` tags to include template-specific styles in the `head` of your page. This plugin takes that functionality a bit further by enabling support for compiling SCSS to CSS with `{% scss %}` using the scssphp library (https://github.com/leafo/scssphp).

## Configuring SCSS

By default, while working with devMode enabled, the styles generated will be output into a readable "Expanded" format. If Craft is not running in devMode, the styles will be uglified into a "Crunched" format.

You can configure these default output formats by copying the `scss.php` file from the plugin directory in your `config` folder.

## Using SCSS

```
{% scss %}
... insert scss here ...
{% endscss %}
```

Given the following SCSS:

```
{% scss %}
/*! Comment */
.navigation {
    ul {
        line-height: 20px;
        color: blue;
        a {
            color: red;
        }
    }
}

.footer {
    .copyright {
        color: silver;
    }
}
{% endscss %}
```

Specifying an output format will take precedence over any default settings in `config/scss.php`.

`{% scss expanded %}`

```
/*! Comment */
.navigation ul {
  line-height: 20px;
  color: blue;
}
.navigation ul a {
  color: red;
}
.footer .copyright {
  color: silver;
}
```


`{% scss nested %}`
```
/*! Comment */
.navigation ul {
  line-height: 20px;
  color: blue; }
    .navigation ul a {
      color: red; }

.footer .copyright {
  color: silver; }
```


`{% scss compact %}`
```
/*! Comment */
.navigation ul { line-height:20px; color:blue; }

.navigation ul a { color:red; }

.footer .copyright { color:silver; }
```


`{% scss compressed %}`
```
/* Comment*/.navigation ul{line-height:20px;color:blue;}.navigation ul a{color:red;}.footer .copyright{color:silver;}
```


`{% scss crunched %}`
```
.navigation ul{line-height:20px;color:blue;}.navigation ul a{color:red;}.footer .copyright{color:silver;}
```

You can output the original SCSS line numbers within the compiled styles for better frontend debugging by appending debug `{% scss debug %}`
Note: this only works with the Expanded, Nested, and Compact output formats.



Brought to you by [Chase Giunta](https://chasegiunta.com)
