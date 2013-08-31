=== WordPress Video Sitemaps by ClknGo ===
Contributors: clkngo
Donate link: http://www.clkngo.com/
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Tags: seo, SEO, google, search engine optimization, xml sitemap, xml sitemaps, google sitemap, sitemap, sitemaps, video sitemap, yahoo, bing, WordPress SEO, WordPress SEO by ClknGo, ClknGo, multisite, webmaster tools, google webmaster tools
Requires at least: 3.3
Tested up to: 3.6
Stable tag: 0.0.2

Provides a XML Video Sitemap for quicker indexing of your videos. 

== Description ==

WordPress Video Sitemaps is an addon module to Yoast's WordPress SEO plugin. It enables the video sitemap capability that is built into Yoast's plugin.

= Write better content with WordPress SEO =



= Page Analysis =
The WordPress SEO plugins [Linkdex Page Analysis](http://yoast.com/content-seo-wordpress-linkdex/) functionality checks simple things you're bound to forget. It checks, for instance, if you have images in your post and whether they have an alt tag containing the focus keyword for that post. It also checks whether your posts are long enough, if you've written a meta description and if that meta description contains your focus keyword, if you've used any subheadings within your post, etc. etc.

The plugin also allows you to write meta titles and descriptions for all your category, tag and custom taxonomy archives, giving you the option to further optimize those pages.

Combined, this plugin makes sure that your content is the type of content search engines will love!

= Technical WordPress Search Engine Optimization =
While out of the box WordPress is pretty good for SEO, it needs some tweaks here and there. This WordPress SEO plugin guides you through some of the settings needed, for instance by reminding you to enable pretty permalinks. But it also goes beyond that, by automatically optimizing and inserting the meta tags and link elements that Google and other search engines like so much:

= Meta & Link Elements =
With the WordPress SEO plugin you can control which pages Google shows in its search results and which pages it doesn't show. By default, it will tell search engines to index all of your pages, including category and tag archives, but only show the first pages in the search results. It's not very useful for a user to end up on the third page of your "personal" category, right?

WordPress itself only shows canonical link elements on single pages, WordPress SEO makes it output canonical link elements everywhere. Google has recently announced they would also use `rel="next"` and `rel="prev"` link elements in the `head` section of your paginated archives, this plugin adds those automatically, see [this post](http://yoast.com/rel-next-prev-paginated-archives/ title="rel=next & rel=prev for paginated archives") for more info.

= XML Sitemaps =
WordPress SEO has the most advanced XML Sitemaps functionality in any WordPress plugin. Once you check the box, it automatically creates XML sitemaps and notifies Google & Bing of the sitemaps existence. These XML sitemaps include the images in your posts & pages too, so that your images may be found better in the search engines too.

These XML Sitemaps will even work on large sites, because of how they're created, using one index sitemap that links to sub-sitemaps for each 1,000 posts. They will also work with custom post types and custom taxonomies automatically, while giving you the option to remove those from the XML sitemap should you wish to.

Because of using [XSL stylesheets for these XML Sitemaps](http://yoast.com/xsl-stylesheet-xml-sitemap/), the XML sitemaps are easily readable for the human eye too, so you can spot things that shouldn't be in there.

= RSS Optimization =
Are you being outranked by scrapers? Instead of cursing at them, use them to your advantage! By automatically adding a link to your RSS feed pointing back to the original article, you're telling the search engine where they should be looking for the original. This way, the WordPress SEO plugin increases your own chance of ranking for your chosen keywords and gets rid of scrapers in one go!

= Breadcrumbs =
If your theme is compatible, and themes based on Genesis or by WooThemes for instance often are, you can use the built-in Breadcrumbs functionality. This allows you to create an easy navigation that is great for both users and search engines and will support the search engines in understanding the structure of your site.

Making your theme compatible isn't hard either, check [these instructions](http://yoast.com/wordpress/breadcrumbs/).

= Edit your .htaccess and robots.txt file =
Using the built-in file editor you can edit your WordPress blogs .htaccess and robots.txt file, giving you direct access to the two most powerful files, from an SEO perspective, in your WordPress install.

= Social Integration =
SEO and Social Media are heavily intertwined, that's why this plugin also comes with a Facebook OpenGraph implementation and will soon also support Google+ sharing tags.

= Multi-Site Compatible =
This WordPress SEO plugin, unlike some others, is fully Multi-Site compatible. The XML Sitemaps work fine in all setups and you even have the option, in the Network settings, to copy the settings from one blog to another, or make blogs default to the settings for a specific blog.

= Import & Export functionality =
If you have multiple blogs, setting up plugins like this one on all of them might seem like a daunting task. Except that it's not, because what you can do is simple: you set up the plugin once. You then export your settings and simply import them on all your other sites. It's that simple!

= Import functionality for other WordPress SEO plugins =
If you've used All In One SEO Pack or HeadSpace2 before using this plugin, you might want to import all your old titles and descriptions. You can do that easily using the built-in import functionality. There's also import functionality for some of the older Yoast plugins like Robots Meta and RSS footer.

Should you have a need to import from another SEO plugin or from a theme like Genesis or Thesis, you can use the [SEO Data Transporter](http://wordpress.org/extend/plugins/seo-data-transporter/) plugin, that'll easily convert your SEO meta data from and to a whole set of plugins like Platinum SEO, SEO Ultimate, Greg's High Performance SEO and themes like Headway, Hybrid, WooFramework, Catalyst etc.

Read [this migration guide](http://yoast.com/all-in-one-seo-pack-migration/) if you still have questions about migrating from another SEO plugin to WordPress SEO.

= WordPress SEO Plugin in your Language! =
Currently a huge translation project is underway, translating WordPress SEO in as much as 24 languages. So far, the translations for French and Dutch are complete, but we still need help on a lot of other languages, so if you're good at translating, please join us at [translate.yoast.com](http://translate.yoast.com).

= News SEO =
Be sure to also check out the [News SEO module](http://yoast.com/wordpress/seo/news-seo/) if you need Google News Sitemaps. It tightly integrates with WordPress SEO to give you the combined power of News Sitemaps and full Search Engine Optimization.

= Further Reading =
For more info, check out the following articles:

* [WordPress SEO - The definitive Guide by Yoast](http://yoast.com/articles/wordpress-seo/).
* Once you have great SEO, you'll need the [best WordPress Hosting](http://yoast.com/articles/wordpress-hosting/).
* The [WordPress SEO Plugin](http://yoast.com/wordpress/seo/) official homepage.
* Other [WordPress Plugins](http://yoast.com/wordpress/) by the same author.
* Follow Yoast on [Facebook](https://facebook.com/yoast) & [Twitter](http://twitter.com/yoast).

== Installation ==

1. Upload the `wordress-video-sitemap` folder to the `/wp-content/plugins/` directory
2. Activate the WordPress Video Sitemap plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

You'll find the [FAQ on www.clkngo.com](http://www.yoast.com/wordpress/wordpress-video-sitemap/faq/).

== Screenshots ==

1. The WordPress SEO plugin general meta box. You'll see this on edit post pages, for posts, pages and custom post types.
2. Some of the sites using this WordPress SEO plugin.
3. The WordPress SEO settings for a taxonomy.
4. The fully configurable XML sitemap for WordPress SEO.
5. Easily import SEO data from All In One SEO pack and HeadSpace2 SEO.
6. Example of the Page Analysis functionality.
7. The advanced section of the WordPress SEO meta box.

== Changelog ==

= 0.0.2 =

* Enhancements
	* Supports embedded youtube videos and shortcode extensions.
* Bug Fixes
	* Resolve fclose problem with wrong file pointer.
	
= 0.0.1 =

* Baseline Beta Release
	* Submit button displays again on Titles & Metas page.
	* SEO Title now calculates length correctly.
	* Force rewrite titles should no longer reset wrongly on update.
