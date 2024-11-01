=== Taxonomy slug fixer ===
Contributors: fariborzasgarpour
Tags: taxonomy, category
Requires at least: 4.7
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later

fix the middle slugs of parent category and child category.

== Description ==

In WordPress, when you create a main category and create a category as its child, connect some articles to the child category and then open that category, you will see that article in the list of that category.
So far no problem and everything is working properly.
Now, if you add a word in the browser address between the main category and the child category, it will still display the same list if that category does not exist and it should be referred to the 404 page.

example.com/parent_category/child_category/ ---> post1 , post2
example.com/parent_category/random_text/child_category/ ---->post1 , post2

after install

example.com/parent_category/child_category/ ---> post1 , post2
example.com/parent_category/random_text/child_category/ ---> 404

With this plugin, this problem will be solved and a 404 page will be displayed for addresses that do not exist.
This problem will be very useful for colleagues who work in the field of SEO.