SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `eoen`
--

-- --------------------------------------------------------

--
-- 表的结构 `youbbs_leaving`
--

CREATE TABLE IF NOT EXISTS `youbbs_leaving` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `did` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_articles`
--

CREATE TABLE IF NOT EXISTS `yunbbs_articles` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ruid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `tags` tinytext NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '1',
  `comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `closecomment` tinyint(1) NOT NULL DEFAULT '0',
  `favorites` int(10) unsigned NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `isred` tinyint(1) NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL DEFAULT '0',
  `fop` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `edittime` (`edittime`),
  KEY `uid` (`uid`),
  KEY `top` (`top`),
  KEY `fop` (`fop`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_categories`
--

CREATE TABLE IF NOT EXISTS `yunbbs_categories` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `articles` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `about` text NOT NULL,
  `follow` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `articles` (`articles`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yunbbs_categories`
--

INSERT INTO `yunbbs_categories` (`id`, `name`, `articles`, `about`, `follow`) VALUES
(1, '首页隐藏', 0, '这个话题下的帖子不会在首页显示', 0),
(2, '默认话题', 0, '快速发帖时的默认话题', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_comments`
--

CREATE TABLE IF NOT EXISTS `yunbbs_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_favorites`
--

CREATE TABLE IF NOT EXISTS `yunbbs_favorites` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `articles` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_follow`
--

CREATE TABLE IF NOT EXISTS `yunbbs_follow` (
  `ID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` mediumint(8) unsigned NOT NULL,
  `ObjID` mediumint(8) unsigned NOT NULL,
  `Type` tinyint(3) unsigned NOT NULL,
  `FollowTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UserID` (`UserID`,`ObjID`,`Type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='关注表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_links`
--

CREATE TABLE IF NOT EXISTS `yunbbs_links` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yunbbs_links`
--

INSERT INTO `yunbbs_links` (`id`, `name`, `url`) VALUES
(1, 'Youbbs', 'http://youbbs.sinaapp.com'),
(2, 'EOEN', 'http://www.eoen.org/');

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_messages`
--

CREATE TABLE IF NOT EXISTS `yunbbs_messages` (
  `ID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `FromUID` mediumint(8) unsigned NOT NULL,
  `ToUID` mediumint(8) unsigned NOT NULL,
  `FromUName` varchar(20) NOT NULL,
  `ToUName` varchar(20) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` mediumtext NOT NULL,
  `IsRead` tinyint(4) NOT NULL DEFAULT '0',
  `ReadTime` int(10) unsigned DEFAULT '0',
  `AddTime` int(10) unsigned NOT NULL DEFAULT '0',
  `ReferID` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='私信表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_qqweibo`
--

CREATE TABLE IF NOT EXISTS `yunbbs_qqweibo` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `openid` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_settings`
--

CREATE TABLE IF NOT EXISTS `yunbbs_settings` (
  `title` varchar(50) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yunbbs_settings`
--

INSERT INTO `yunbbs_settings` (`title`, `value`) VALUES
('name', 'EoenYoubbs'),
('site_des', 'Proudly Powered by YouBBS'),
('site_inf', ''),
('site_create', '1451263549'),
('icp', ''),
('admin_email', ''),
('home_shownum', '10'),
('list_shownum', '10'),
('newest_node_num', '20'),
('hot_node_num', '20'),
('bot_node_num', '100'),
('article_title_max_len', '60'),
('article_content_max_len', '3000'),
('article_post_space', '2'),
('reg_ip_space', '3600'),
('comment_min_len', '4'),
('comment_max_len', '1200'),
('commentlist_num', '32'),
('comment_post_space', '20'),
('close', '0'),
('close_note', '数据调整中'),
('authorized', '0'),
('register_review', '0'),
('close_register', '0'),
('close_upload', '0'),
('ext_list', ''),
('img_shuiyin', '0'),
('show_debug', '1'),
('jquery_lib', '/static/js/jquery-1.11.3.min.js'),
('head_meta', ''),
('analytics_code', ''),
('safe_imgdomain', '192.168.3.3|127.0.0.1'),
('upyun_domain', ''),
('upyun_user', ''),
('upyun_pw', ''),
('ad_post_top', ''),
('ad_post_bot', ''),
('ad_sider_top', ''),
('ad_web_bot', ''),
('main_nodes', '1,2'),
('spam_words', ''),
('qq_scope', 'get_user_info'),
('qq_appid', '1'),
('qq_appkey', '1'),
('wb_key', '1'),
('wb_secret', '1');

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_tags`
--

CREATE TABLE IF NOT EXISTS `yunbbs_tags` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `articles` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ids` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `articles` (`articles`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_users`
--

CREATE TABLE IF NOT EXISTS `yunbbs_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `flag` tinyint(2) NOT NULL DEFAULT '0',
  `avatar` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `password` char(32) NOT NULL,
  `email` varchar(40) NOT NULL,
  `url` varchar(75) NOT NULL,
  `articles` int(10) unsigned NOT NULL DEFAULT '0',
  `replies` int(10) unsigned NOT NULL DEFAULT '0',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastposttime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastreplytime` int(10) unsigned NOT NULL DEFAULT '0',
  `about` text NOT NULL,
  `notic` text NOT NULL,
  `gauthsecret` varchar(100) DEFAULT NULL,
  `fnod` int(10) unsigned NOT NULL DEFAULT '0',
  `fuer` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yunbbs_weibo`
--

CREATE TABLE IF NOT EXISTS `yunbbs_weibo` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `openid` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
