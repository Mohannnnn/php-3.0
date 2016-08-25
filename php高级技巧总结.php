<?php 
	1.php多维数组
	$sites = array 
	( 
	    "runoob"=>array 
	    ( 
	        "教程", 
	        "http://www.runoob.com" 
	    ), 
	    "google"=>array 
	    ( 
	        "Google 搜索", 
	        "http://www.google.com" 
	    ), 
	    "taobao"=>array 
	    ( 
	        "淘宝", 
	        "http://www.taobao.com" 
	    ) 
	); 
	print("<pre>"); // 格式化输出数组 
	print_r($sites); 
	print("</pre>");

	echo $sites['runoob'][0] . '地址为：' . $sites['runoob'][1];//具体输出数组中的值，
	//输出：教程地址为：http://www.runoob.com


	2.php data()函数

	例如：date("Y-m-d");
	Y:年、m:月、d:日、

	3.php包含文件，include和require
		在 PHP 中，您可以在服务器执行 PHP 文件之前在该文件中插入一个文件的内容。
		include 和 require 语句用于在执行流中插入写在其他文件中的有用的代码。
		include 和 require 除了处理错误的方式不同之外，在其他方面都是相同的：
		require 生成一个致命错误（E_COMPILE_ERROR），在错误发生后脚本会停止执行。
		include 生成一个警告（E_WARNING），在错误发生后脚本会继续执行。

		例如：
		"vars.php"
		"<?php
			$color='red';
			$car='BMW';
		?>"	

		"<?php 
			include 'vars.php';
			echo "I have a $color $car"; // I have a red BMW
		?>"

	4.php文件处理,
		fopen() 函数用于在 PHP 中打开文件,fclose() 函数用于关闭打开的文件。feof()
	函数检测是否已到达文件末尾（EOF）。在循环遍历未知长度的数据时，feof() 函数很有用。fgets()
	函数用于从文件中逐行读取文件。fgetc() 函数用于从文件中逐字符地读取文件。

		$file=fopen("welcome.txt","r");

		r	只读。在文件的开头开始。
		r+	读/写。在文件的开头开始。
		w	只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
		w+	读/写。打开并清空文件的内容；如果文件不存在，则创建新文件。
		a	追加。打开并向文件末尾进行写操作，如果文件不存在，则创建新文件。
		a+	读/追加。通过向文件末尾写内容，来保持文件内容。
		x	只写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。
		x+	读/写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。

		例如：

		$file = fopen('welcome.txt', 'r');

	 	while ( !feof($file)){
	 		
	 		echo fgets($file).'<br>';

	 		echo fgetc($file).'<br>';
	 	}

	 	fclose($file);

	 5.php文件上传
	 	// 允许上传的图片后缀
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		//explode(separator,string,limit)函数将字符串打散为数组
		echo $_FILES["file"]["size"];
		$extension = end($temp);     
		// 获取文件后缀名
		//current() - 返回数组中的当前元素的值
		// end() - 将内部指针指向数组中的最后一个元素，并输出
		// next() - 将内部指针指向数组中的下一个元素，并输出
		// prev() - 将内部指针指向数组中的上一个元素，并输出
		// reset() - 将内部指针指向数组中的第一个元素，并输出
		// each() - 返回当前元素的键名和键值，并将内部指针向前移动

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 204800)   // 小于 200 kb
		&& in_array($extension, $allowedExts)) //in_array(search,array,type)搜索数组中是否存在指定的值
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "错误：: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
				echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
				echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
				
				// 判断当前目录下的 upload 目录是否存在该文件
				// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777

				if (file_exists("upload/" . $_FILES["file"]["name"]))
				//file_exists(path)函数检查文件或目录是否存在。

				{
					echo $_FILES["file"]["name"] . " 文件已经存在。 ";
				}
				else
				{
					// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
					move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
					//move_uploaded_file(file,newloc)将上传的文件移动到新位置

					echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
				}
			}
		}
		else
		{
			echo "非法的文件格式";
		}


		6.php Cookie,cookie 常用于识别用户。

		创建cookie ：setcookie("user", "runoob", time()+3600);
		//设置名为user,并赋值runoob,设定过期时间为1小时后

		取回cookie的值
		// 输出 cookie 值
		echo $_COOKIE["user"];

		// 查看所有 cookie
		print_r($_COOKIE);

		判断是否有cookie
		if (isset($_COOKIE["user"]))//isset($_COOkIE['..'])用于判断是否有cookie
			echo "欢迎 " . $_COOKIE["user"] . "!<br>";
		else
			echo "普通访客!<br>";
 ?>