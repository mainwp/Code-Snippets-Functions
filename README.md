# Code Snippets Functions

This repository contains "code snippets" for use with the [MainWP Code Snippets Extension](https://mainwp.com/extension/code-snippets/).

The Code Snippets Extension is a custom plugin built to allow the [MainWP Dashboard](https://wordpress.org/support/plugin/mainwp/) to excecute code snippets on a [MainWP Child site](https://wordpress.org/plugins/mainwp-child/).  

## How it Works

MainWP Code Snippets Extension works by allowing you to run code snippets that would be in your themes **functions.php** or in the sites **wp-config.php** file. Code Snippets extension for MainWP is a simple way to add code snippets to your child sites from one centralized location. **This tool is recommended for advanced users only.** We only recommend utilizing it if you are experienced PHP coder.

## Code Snippet Types

**Have a Code Snippet execute a function on the Child site**
This type of snippets will add the snippet on your child site and it will be executed on site load. This type of snippets will be saved in your child site database and will be executed each time your child site is loaded by the PHP command eval().

You would use this option to make actual changes on your child sites. For example, if you wanted to customize the admin footer across different sites in your network you would use this option.

**Have a Code Snippet return information from a Child site**
This type of snippets will just get the info from child sites and display it in the Output Display. This type of snippets will not saved on your child sites.

This option queries the child and returns the information to you. An example would be if you wanted to know the published post count of all of your sites.

**Have a Code Snippet edit the wp-config.php file on a Child site**
This type of snippets will be added to your child site wp-config.php file. This type of snippets will be saved only in your child site wp-config.php file.

One of the most important files in your WordPress installation is the wp-config.php file. A Code Snippet in this section allows you to do things such as increase WordPress memory, block external requests, disable WP Cron and much more.

## Related documents ##
[Execute a Code Snippet](https://mainwp.com/help/docs/code-snippets-extension/execute-a-code-snippet/) 

[Save a Code Snippet](https://mainwp.com/help/docs/code-snippets-extension/save-a-code-snippet/)

[Remove a Code Snippet from a Broken Site](https://mainwp.com/help/docs/code-snippets-extension/remove-a-code-snippet-from-a-broken-site/)

[Remove a Code Snippet from Child Sites](https://mainwp.com/help/docs/code-snippets-extension/remove-a-code-snippet-from-child-sites/)
