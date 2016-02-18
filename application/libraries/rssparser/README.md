RSSParser library - Production ready - CI 2.1.0 compatible
====================================================================

Install
--------------------------------------
Simply add this library to your /application/libraries/ folder.


Usage
----------------------------

If you have followed the Install step correctly you should be able to use.

```php
$this->load->library('rssparser');							// load library
$this->rssparser->set_feed_url('http://example.com/feed'); 	// get feed
$this->rssparser->set_cache_life(30); 						// Set cache life time in minutes
$rss = $this->rssparser->getFeed(6); 						// Get six items from the feed
```

$rss will return an array which will include:

```php
title, description, author, pubDate, link
```

You can also chain the above statement.

```php
$this->load->library('rssparser');
$this->rssparser->set_feed_url('http://example.com/feed')->set_cache_life(30)->getFeed(6);
```

Example
----------------------------

Getting RSS from a single source.

```php
function get_ars() 
{
	// Load RSS Parser
	$this->load->library('rssparser');
	
	// Get 6 items from arstechnica
	$rss = $this->rssparser->set_feed_url('http://feeds.arstechnica.com/arstechnica/index/')->set_cache_life(30)->getFeed(6);

	foreach ($rss as $item)
	{
		echo $item['title'];
		echo $item['description'];
	}
}
```

Getting RSS from multiple sources.

```php
function get_logistics_news() 
{
	// Load RSS Parser
	$this->load->library('rssparser');
	
	// Get RSS
	$rss[] = $this->rssparser->set_feed_url('http://www.3plwire.com/feed/')->set_cache_life(30)->getFeed(1);
	$rss[] = $this->rssparser->set_feed_url('http://www.supplychain.cn/en/rss/articles/')->set_cache_life(30)->getFeed(1);

	foreach ($rss as $feed)
	{
		foreach ($feed as $item)
		{
			echo $item['title'];
			echo $item['description'];
		}
	}
}
```


Misc
----------------------------
```php
// Using a callback function to parse addictional XML fields

$this->load->library('rssparser', array($this, 'parseFile')); // parseFile method of current class

function parseFile($data, $item)
{
	$data['summary'] = (string)$item->summary;
	return $data;
}
```
