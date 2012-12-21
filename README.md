<!--- -*- eval: (auto-fill-mode); fill-column: 70; -*- -->

Happy Cosmos
============

These are the source codes of my personal website.  The online version
can be accessed at <http://happy-cosmos.comuf.com/>.

Blog
----

The current version of blog is just an XML parser.
`blog/selectblog.php` selects source (feed) from a MySQL database, and
`blog/getblog.php` render it dynamically using AJAX.  There are plans
to combine multiple sources and to add my own blog codes in the
future.  Notice that `blog/connect-database.php` has been removed from
repo because of security issue.

Message Board
-------------

After several days' work, the message board finally begins to
function.  I have finished main part of the message board (rendering
and posting of the messages), and the new user registration system.
The only thing I leave undone is the page to modify user account
information (`msgbrd/modify.html`).
