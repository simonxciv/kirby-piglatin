# Kirby Pig Latin Plugin!

Have you ever wished you could easily convert your website's text to pig latin? Have you looked far and wide for the perfect Kirby CMS plugin to do this exact thing for you? Are you a masochist who wants to install a terrible, hacky, ugly plugin that's certain to break things? Well today's your lucky day!

## Introducing, my Kirby Pig Latin plugin!

Built with terrible PHP for Kirby 3, this gross and unsightly plugin will provide you and your visitors with about a minute of priceless amusement, followed by disappointment and frustration.

## Get started now!

To install this plugin, simply download the `index.php` file, and place it in a directory named `kirby-piglatin` in your sites `site/plugins` folder.

Then, from your templates, call it using `<?= $page->fieldName()->toPiglatin()`.

## Known issues

1. This plugin doesn't work well, and I don't know if I can be bothered to make it work well :D
2. Currently, trying to parse Kirbytext doesn't work. I'd like it to.
3. I'm 110% certain there are language edge-cases where this plugin makes stuff go bang.
4. This plugin only works properly with basic a-z characters. This probably isn't enough for anything at all, really.