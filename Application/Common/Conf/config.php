<?php
return array(
	//'配置项'=>'配置值'

	'DOMAIN_NAME' => '127.0.0.1',

	///////// database : u_base //////////

	'DB_CONFIG1' => array(
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  '127.0.0.1', // 服务器地址
		'DB_NAME'               =>  'u_base',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  '',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  '',    // 数据库表前缀
		'DB_CHARSET'            =>  'utf8',      // 数据库编码
		'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
	),

	///////// database : u_idformed //////////

	'DB_CONFIG2' => array(
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  '127.0.0.1', // 服务器地址
		'DB_NAME'               =>  'u_idformed',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  '',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  '',    // 数据库表前缀
		'DB_CHARSET'            =>  'utf8',      // 数据库编码
		'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
	),

	///////// database : u_shared_0 //////////

	'DB_CONFIG3' => array(
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  '127.0.0.1', // 服务器地址
		'DB_NAME'               =>  'u_shard_0',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  '',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  '',    // 数据库表前缀
		'DB_CHARSET'            =>  'utf8',      // 数据库编码
		'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
	)
);