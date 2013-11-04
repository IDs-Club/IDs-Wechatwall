/*
Navicat MySQL Data Transfer

Source Server         : sudu
Source Server Version : 50163
Source Host           : 125.64.24.59:3306
Source Database       : s554164db0

Target Server Type    : MYSQL
Target Server Version : 50163
File Encoding         : 65001

Date: 2013-09-02 10:43:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `weixin_admin`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_admin`;
CREATE TABLE `weixin_admin` (
  `user` text NOT NULL,
  `pwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_admin
-- ----------------------------
INSERT INTO `weixin_admin` VALUES ('admin', 'admin');

-- ----------------------------
-- Table structure for `weixin_flag`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_flag`;
CREATE TABLE `weixin_flag` (
  `openid` varchar(255) NOT NULL,
  `flag` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `nickname` text NOT NULL,
  PRIMARY KEY (`openid`),
  UNIQUE KEY `openid` (`openid`),
  KEY `openid_2` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_flag
-- ----------------------------

-- ----------------------------
-- Table structure for `weixin_wall`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_wall`;
CREATE TABLE `weixin_wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageid` int(11) NOT NULL,
  `fakeid` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `content` text NOT NULL,
  `nickname` text NOT NULL,
  `avatar` text NOT NULL,
  `ret` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_wall
-- ----------------------------

-- ----------------------------
-- Table structure for `weixin_wall_num`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_wall_num`;
CREATE TABLE `weixin_wall_num` (
  `num` int(11) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_wall_num
-- ----------------------------
INSERT INTO `weixin_wall_num` VALUES ('1');
