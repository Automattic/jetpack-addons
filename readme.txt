=== Custom Open Graph URLs ===
Contributors: jeherve
Tags: Jetpack, Sharing, Facebook, Open Graph
Stable tag: 1.0.0
Requires at least: 4.7
Tested up to: 4.7

Define custom OG URLs for each one of your posts.

== Description ==

If you don't add a custom OG URL, the default one (post permalink) will be used.

= There are a few required conditions for this to work =

- Jetpack must be active on your site.
- Jetpack's Sharing module or Jetpack's Publicize module have to be active.
- No other Open Graph plugin must be installed on your site.

= How to use the plugin =

The plugin won't add any new input field or interface on your site. Once it's active, you can specify a custom Opeg Graph URL for each post by going to Posts > All Posts in your dashboard, clicking on the post you want to edit, and using the Custom Fields input field to add a new custom field with the name `custom_og_url` and the value you need, like so:

![Custom Fields' interface](https://cloud.githubusercontent.com/assets/426388/24169580/62189994-0e7e-11e7-9c9e-68548cf25444.png)

If you do not see a Custom Fields interface in your post editor, make sure it is enabled in your Screen Options at the top of the screen:

![Screen Options](https://cloud.githubusercontent.com/assets/426388/24169702/c07b4ab8-0e7e-11e7-9138-bc365ece7832.png)

= Why would I want to do that? =

This plugin is especially useful when switching from HTTP to HTTPS on your site, and if you want to keep the number of Facebook shares you had collected for some of your posts when your site was still using HTTP.

In an ideal world, Facebook would detect that the HTTP URL now redirects to HTTPs, and move the sharing counts over as well. Unfortunately, that does not always happen. Facebook recommends [the following](https://developers.facebook.com/docs/sharing/webmasters/crawler#updating) to keep the sharing counts. This plugin will allow you to do that for the posts that matter to you, while letting Facebook collect sharing counts for the new, HTTPS URL, for all the other posts where you do not specify a `custom_og_url` custom field.

For the posts where you want to keep the sharing counts from before the switch:
1. Install and activate [this plugin](https://github.com/automattic/jetpack-addons/archive/custom-og-urls.zip).
2. Go to Posts > All Posts
3. Find the post you want to edit.
4. Open the editor.
5. Follow the instructions above to locate the Custom Fields interface.
6. Create a new custom field with the name `custom_og_url`. The value should be the post URL, but with `http://` instead of `https://`.

= More info =

Find out more about this plugin here:
- [Original request](https://wordpress.org/support/topic/sharing-social-share-counts-are-gone/#post-8941087)
- [Filter used in the plugin](https://developer.jetpack.com/hooks/jetpack_open_graph_tags/)

== Changelog ==

= 1.0.0 =

* Initial release.
