Magento2 Module Category Redirect
=========================================

Magento 2 Module to simply customize the menu with additional URLs: Create a category, enter the redirect, done

Installation
------------

Install the module as usual using the composer client with the module name `Goodson/magento-module-categoryredirect`.

    composer require goodson/magento2-module-categoryredirect


Use
---

The module adds the field "Redirect URL" to categories.

To add the CMS page "About us" to the main menu:

* Add a new category "About us"
* Enter the redirect URL "about-us.html"

It is possible to add external links

* Add a new category "Blog"
* Enter the redirect URL "https://blog.company.com"