=== Plugin Name ===
Contributors: novarum
Donate link: https://plugins.novarumsoftware.com
Tags: woocommerce,order,status
Requires at least: 3.0.1
Tested up to: 5.5
Stable tag: 1.1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Order status customizer lets you create custom order status values for WooCommerce and define rules to run when the status changes

== Description ==

Order status customizer is an essential WooCommerce plugin that lets you define custom status values and rules that can be
run when an orders change status. Free version has the limitation of only allowing you to send emails when the status changes.

Features:

*   Define unlimited custom order status values
*   Customization for background and text color of the status
*   Preview for the new status during creation
*   Delete protection. System provides error if you try to delete a status that are used by orders
*   Defining rules and actions based on status transition. Ability to send emails, add notes to the orders (PRO), add a fee (PRO) or call an external api (PRO) when the order transitions between chosen status values

    You don’t see the functionality you are looking for? Please contact us at team@novarumsoftware.com and we will try our best to help you. We extend our plugins with weekly releases based on most relevant and requested features.


== Installation ==

This section describes how to install the plugin and get it working.


1. Upload `woocommerce-order-status-customizer` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Navigate to `Order Status` menu and start adding your status values and rules!

== Frequently Asked Questions ==

= Can I remove standard status values =

Yes. Please navigate to Settings under Order Status menu and uncheck the related status values.

= I need to access to the debug logs =

Yes. Please navigate to Settings and you can enable debug mode and access to the logs

= I cannot find the functionality I am looking for. How can I get help? =

Please send an email to team@novarumsoftware.com and we will do our best to help you.

== Screenshots ==

1. Order status list with custom status values
2. Adding a new custom order status

== Changelog ==
= 1.1.4 =
Email input sanitization is fixed. It was removing the tags.

= 1.1.3 =
Actions are now grouped

= 1.1.2 =
License Management added for automated updates.

= 1.0 =
Initial Release


