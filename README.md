Happy Cosmos
============

These are the source codes of my personal website.  The online version
can be accessed at <http://happy-cosmos.comuf.com/>.

Blog
----

The current version of blog is just an XML parser.  `selectblog.php`
selects source (feed) from a MySQL database, and `getblog.php` render
it dynamically using AJAX.  There are plans to combine multiple
sources and to add my own blog codes in the future.  Notice that
`connect-database.php` has been removed from repo because of security
issue.
