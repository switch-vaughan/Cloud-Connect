<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-06-22 02:13:03 --- ERROR: ErrorException [ 1 ]: Call to undefined method Security::xss_clean() ~ APPPATH/classes/controller/admin/article.php [ 10 ]
2011-06-22 03:03:02 --- ERROR: ErrorException [ 1 ]: Class 'Model_articles' not found ~ SYSPATH/classes/kohana/model.php [ 26 ]
2011-06-22 03:03:10 --- ERROR: ErrorException [ 1 ]: Class 'Model_articles' not found ~ SYSPATH/classes/kohana/model.php [ 26 ]
2011-06-22 03:04:32 --- ERROR: ErrorException [ 2048 ]: Declaration of Model_Articles::update() should be compatible with that of Kohana_ORM::update() ~ APPPATH/classes/model/articles.php [ 2 ]
2011-06-22 03:15:11 --- ERROR: Database_Exception [ 1146 ]: Table 'smmt_online.articleses' doesn't exist [ SHOW FULL COLUMNS FROM `articleses` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-06-22 03:25:13 --- ERROR: ErrorException [ 2048 ]: Declaration of Model_Article::update() should be compatible with that of Kohana_ORM::update() ~ APPPATH/classes/model/article.php [ 2 ]
2011-06-22 03:30:28 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'WHERE1 id='1'' at line 1 [ UPDATE articles SET copy='Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' WHERE1 id='1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-06-22 03:34:18 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'title' in 'field list' [ UPDATE articles SET title='contact us', slug='contact', copy='Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' WHERE id='1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-06-22 03:36:13 --- ERROR: ErrorException [ 8 ]: Undefined index: updated ~ APPPATH/classes/model/article.php [ 37 ]
2011-06-22 03:36:27 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'WHERE id='1'' at line 1 [ UPDATE articles SET title='contact us', slug='contact', copy='Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', updated1308731787 WHERE id='1' ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2011-06-22 04:33:40 --- ERROR: ErrorException [ 8 ]: Undefined variable: a ~ APPPATH/classes/controller/admin/article.php [ 94 ]
2011-06-22 06:00:25 --- ERROR: ErrorException [ 8 ]: Undefined variable: converts ~ APPPATH/classes/controller/admin/article.php [ 80 ]
2011-06-22 06:01:15 --- ERROR: ErrorException [ 8 ]: Undefined variable: ke ~ APPPATH/classes/controller/admin/article.php [ 80 ]
2011-06-22 07:53:03 --- ERROR: ErrorException [ 8 ]: Undefined index: name ~ APPPATH/views/admin/pages.php [ 6 ]
2011-06-22 08:20:23 --- ERROR: ErrorException [ 8 ]: Undefined index: username ~ APPPATH/classes/controller/admin/login.php [ 17 ]
2011-06-22 08:21:19 --- ERROR: ErrorException [ 8 ]: Undefined index: username ~ APPPATH/classes/controller/admin/login.php [ 17 ]
2011-06-22 09:25:56 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH/classes/model/article.php [ 50 ]
2011-06-22 09:32:33 --- ERROR: ErrorException [ 2048 ]: Declaration of Model_Article::save() should be compatible with that of Kohana_ORM::save() ~ APPPATH/classes/model/article.php [ 72 ]
2011-06-22 09:49:46 --- ERROR: ErrorException [ 1 ]: Class 'Archive' not found ~ APPPATH/classes/model/article.php [ 22 ]
2011-06-22 09:51:12 --- ERROR: ErrorException [ 1 ]: Class 'Model_article_archive' not found ~ SYSPATH/classes/kohana/model.php [ 26 ]
2011-06-22 09:51:56 --- ERROR: ErrorException [ 1 ]: Class 'Model_article_archive' not found ~ SYSPATH/classes/kohana/model.php [ 26 ]